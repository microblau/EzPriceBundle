<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 30/06/14
 * Time: 10:21
 */

namespace Efl\WebBundle\Helper;

use eZ\Publish\API\Repository\ContentService;
use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\API\Repository\SearchService;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Repository;
use Closure;
use eZ\Publish\Core\FieldType\Page\PageService;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Form\Extension\Core\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use eZ\Publish\Core\MVC\Symfony\Controller\Content\ViewController;
use CjwNewsletterSubscription;
use CjwNewsletterUser;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Routing\RouterInterface;
use eZ\Publish\API\Repository\Values\Content\Content;
use eZ\Bundle\EzPublishLegacyBundle\Routing\FallbackRouter;
use Efl\WebBundle\Exceptions\Newsletter\HashNotFoundException;
use Efl\WebBundle\Exceptions\Newsletter\HashAlreadyUsedException;
use Efl\WebBundle\Exceptions\Newsletter\NewsletterAccessDenied;

class NewsletterHelper
{
    /**
     * @var \eZ\Publish\API\Repository\Repository;
     */
    protected $repository;

    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    protected $locationService;

    /**
     * @var \eZ\Publish\API\Repository\SearchService
     */
    protected $searchService;

    /**
     * @var \eZ\Publish\API\Repository\ContentService
     */
    protected $contentService;

    /**
     * @var \eZ\Publish\Core\FieldType\Page\PageService
     */
    protected $pageService;

    /**
     * @var \eZ\Publish\Core\MVC\Symfony\Controller\Content\ViewController
     */
    protected $viewController;

    /**
     * @var Closure
     */
    protected $kernelClosure;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Symfony\Component\Templating\EngineInterface
     */
    private $templating;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var \eZ\Bundle\EzPublishLegacyBundle\Routing\FallbackRouter;
     */
    private $legacyRouter;

    /**
     * @var array
     */
    protected $newsletterConfig;

    public function __construct(
        Repository $repository,
        LocationService $locationService,
        SearchService $searchService,
        ContentService $contentService,
        PageService $pageService,
        ViewController $viewController,
        Closure $legacyKernelClosure,
        Swift_Mailer $mailer,
        EngineInterface $templating,
        RouterInterface $router,
        FallbackRouter $legacyRouter,
        array $newsletterConfig
    )
    {
        $this->repository = $repository;
        $this->locationService = $locationService;
        $this->searchService = $searchService;
        $this->contentService = $contentService;
        $this->pageService = $pageService;
        $this->viewController = $viewController;
        $this->kernelClosure = $legacyKernelClosure;
        $this->mailer = $mailer;
        $this->templating = $templating;
        $this->router = $router;
        $this->legacyRouter = $legacyRouter;
        $this->newsletterConfig = $newsletterConfig;
    }

    /**
     * @return \eZ\Publish\Core\MVC\Legacy\Kernel
     */
    protected function getLegacyKernel()
    {
        $kernelClosure = $this->kernelClosure;
        return $kernelClosure();
    }
    /**
     * Devuelve una lista con las áreas de interés susceptibles
     * de ser seleccionadas en el formulario de suscripción
     * a la newsletter
     *
     * @return ChoiceList
     */
    public function getAreasInteres()
    {
        $location = $this->locationService->loadLocation( 143 );

        $query = new LocationQuery();

        $query->query = new Criterion\LogicalAnd(
            array(
                new Criterion\Visibility( Criterion\Visibility::VISIBLE ),
                new Criterion\Location\Depth( Criterion\Operator::EQ, $location->depth + 1 ),
                new Criterion\Subtree( $location->pathString )
            )
        );

        $query->sortClauses = array( new Query\SortClause\Location\Priority() );

        $results = $this->repository->getSearchService()->findLocations( $query )->searchHits;

        $values = array();

        foreach ( $results as $result )
        {
            $values[$result->valueObject->contentInfo->id] = $result->valueObject->contentInfo->name;
        }

        return new SimpleChoiceList(  $values );
    }

    public function getEbooksRegalo()
    {
        $home = $this->contentService->loadContent( 11004 );
        $page = $home->getFieldValue( 'page' );
        $block = $page->page->zones[1]->blocks[3];
        $items = $this->pageService->getValidBlockItems( $block );
        $values = array();

        foreach ( $items as $item )
        {

            $content = $this->contentService->loadContentInfo( $item->contentId );
            if ( $content->contentTypeId == 138 )
            {
                $values[$item->contentId] = $this->viewController->viewContent(
                    $item->contentId,
                    'ebook_regalo',
                    false
                )->getContent();
            }
        }

        return new SimpleChoiceList( $values );
    }

    /**
     * Crea la suscripción a la newsletter dejándola
     * a la espera de confirmación por parte del usuario.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function createSubscription( array $data = array() )
    {
        $xmlString =   $this->getXmlDataStringForData( $data );
        return $this->getLegacyKernel()->runCallback(
            function () use ( $data, $xmlString )
            {
                $subscriptionDataArr = array();
                $subscriptionDataArr['first_name'] = $data['Subscription_FirstName'];
                $subscriptionDataArr['last_name'] = $data['Subscription_LastName'];
                $subscriptionDataArr['email'] = $data['email'];
                $subscriptionDataArr['list_array'] = array( 7943 );
                $subscriptionResultArray = CjwNewsletterSubscription::createSubscriptionByArray(
                    $subscriptionDataArr,
                    CjwNewsletterUser::STATUS_PENDING,
                    true,
                    'subscribe'
                );
                $userObject = CjwNewsletterUser::fetchByEmail( $data['email'] );
                $userObject->setAttribute( 'data_xml', $xmlString );
                $userObject->store();
                return $subscriptionResultArray;
            }
        );
    }

    /**
     * Envía el email de solicitud de confirmación al usuario
     *
     * usará swiftmailer
     *
     * @param array $subscription
     */
    public function sendSubcriptionConfirmationMail( array $subscription )
    {
        return $this->sendSubscriptionMail(
                    $subscription,
                    'EflWebBundle:newsletter:confirmation_mail.txt.twig'
        );
    }

    /**
     * Envía correo de suscripción con los datos de la misma
     * y plantilla especificada en view
     *
     * @param array $subscription Datos de la suscripción
     * @param string $view
     */
    private function sendSubscriptionMail( $subscription, $view = '' )
    {
        $message = Swift_Message::newInstance();
        $newsletterUserObject = $subscription['newsletter_user_object'];
        $message->setSubject(
            $this->newsletterConfig['subject']
        )
            ->setFrom( $this->newsletterConfig['sender'] )
            ->setTo( 'carlos.revillo@tantacom.com' )
            ->setBody(
                $this->templating->render(
                    $view,
                    array(
                        'name' => $newsletterUserObject->FirstName,
                        'configureLink' => $this->router->generate(
                            'newsletter_configure',
                            array( 'hash' => $newsletterUserObject->Hash ),
                            true
                        )
                    )
                )
            );

        $this->mailer->send( $message );
    }

    /**
     * Forma un xml con la información que el usuario
     * proporciona al suscribirse
     *
     * @param array $data
     * @return string
     */
    private function getXmlDataStringForData( array $data = array() )
    {
        $doc = new \DOMDocument( '1.0', 'utf-8' );

        $root = $doc->createElement( 'info' );
        $materias = $doc->createElement( 'about_materias' );
        $last_name2 = $doc->createElement( 'last_name', $data['Subscription_LastName_2'] );
        $cp = $doc->createElement( 'cp', $data['cp'] );
        $phone = $doc->createElement( 'phone', $data['phone'] );
        $ebook = $doc->createElement( 'ebook_seleccionado', $data['ebooks'] );
        $job = $doc->createElement( 'job', $data['job'] );

        foreach ( $data['areas'] as $val )
        {
            if ( !empty( $val ) )
            {
                $infoData = $doc->createElement( 'data', $val );
                $materias->appendChild( $infoData );
            }
        }

        $root->appendChild( $materias );
        $root->appendChild( $last_name2 );
        $root->appendChild( $cp );
        $root->appendChild( $phone );
        $root->appendChild( $ebook );
        $root->appendChild( $job );
        $doc->appendChild( $root );

        return $doc->saveXML();
    }

    /**
     * Confirma la suscripción vía hash
     *
     * @param string $hash
     */
    public function confirmSubscription( $hash = '' )
    {
        $ebookId = $this->getLegacyKernel()->runCallback(
            function () use ( $hash )
            {
                $newsletterUser = CjwNewsletterUser::fetchByHash( $hash );
                if ( !$newsletterUser )
                {
                    throw new HashNotFoundException( 'Hash', $hash );
                }

                if ( $newsletterUser->attribute( 'status' ) == CjwNewsletterUser::STATUS_CONFIRMED )
                {
                    throw new HashAlreadyUsedException( 'Hash', $hash );
                }
                // if user is blacklisted or removed do not show configure view
                switch ( $newsletterUser->attribute('status') )
                {
                    case CjwNewsletterUser::STATUS_BLACKLISTED :
                    case CjwNewsletterUser::STATUS_REMOVED_ADMIN :
                    case CjwNewsletterUser::STATUS_REMOVED_SELF :
                        throw new NewsletterAccessDenied( 'Hash', $hash );
                        break;
                }

                if ( $newsletterUser->attribute( 'is_confirmed' ) == false )
                {
                    // alle offenen subscription des users setzen
                    $confirmAllResult = $newsletterUser->confirmAll();

                    $newsletterUser = CjwNewsletterUser::fetchByHash( $hash );
                }

                $subscriptionDataArray = array( 'first_name' => '' ,
                                                'last_name' => '',
                                                'email' => '',
                                                'salutation' => '',
                                                'id_array' => array(),
                                                'list_array' => array(),
                                                'list_output_format_array' => array()
                );

                // email + userId aus formular ignorieren
                $subscriptionDataArray['email'] = $newsletterUser->attribute('email');
                $subscriptionDataArray['ez_user_id'] = $newsletterUser->attribute('ez_user_id');

                foreach ( $subscriptionDataArray['id_array'] as $listId )
                {
                    $defaultOutputFormatId = 0;
                    $subscriptionDataArray['list_output_format_array'][ $listId ] = array( $defaultOutputFormatId );
                }

                $subscriptionResultArray = CjwNewsletterSubscription::createSubscriptionByArray( $subscriptionDataArray,
                    CjwNewsletterUser::STATUS_PENDING,
                    $subscribeOnlyMode = false,
                    $context = 'configure' );

                // sacar el ebook que pidió el usuario y devolverlo al sf stack
                $xml = new \DOMDocument( '1.0', 'utf-8' );
                $xml->loadXml( $newsletterUser->attribute( 'data_xml' ) );
                $ebooks = $xml->getElementsByTagName( 'ebook_seleccionado' );
                return $ebooks->item( 0 )->nodeValue;
            }
        );

        $ebook = !empty( $ebookId ) ? $this->contentService->loadContent( $ebookId ) : null;
        return array( 'ebook' => $ebook );
    }

    public function generateDownloadLinkForEbook( Content $ebook )
    {
        $link = 'ebook/download/' . $ebook->id;

        return $this->legacyRouter->generate(
            'ez_legacy',
            array( 'module_uri' => $link ),
            true
        );
    }
}
