<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 13:07
 */

namespace Efl\WebBundle\Menu\Footer\RRSS;

use eZ\Publish\API\Repository\LocationService;
use eZ\Publish\Core\MVC\ConfigResolverInterface;
use eZ\Publish\API\Repository\Values\Content\Query;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;
use eZ\Publish\Core\Helper\TranslationHelper;

/**
 * A simple eZ Publish menu provider.
 */
class Builder
{
    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ConfigResolverInterface
     */
    private $configResolver;

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * @var TranslationHelper
     */
    private $translationHelper;

    /**
     * @var array Con la info de las redes
     */
    private $rrss;

    public function __construct(
        FactoryInterface $factory,
        RouterInterface $router,
        ConfigResolverInterface $configResolver,
        LocationService $locationService,
        TranslationHelper $translationHelper,
        array $rrss
    )
    {
        $this->factory = $factory;
        $this->router = $router;
        $this->configResolver = $configResolver;
        $this->locationService = $locationService;
        $this->translationHelper = $translationHelper;
        $this->rrss = $rrss;
    }

    /**
     * Forma el menú principal
     *
     * @param Request $request
     * @return ItemInterface
     */
    public function createMenu( Request $request )
    {
        $menu = $this->factory->createItem( 'root' );

        foreach ( $this->rrss as $rrss )
        {
            $menu->addChild(
                 $rrss['class'],
                array(
                    'label' => $rrss['literal'],
                    'uri' => $rrss['url'],
                    'linkAttributes' => array( 'class' => $rrss['class'] )
                )
            );
        }

        $menu->setChildrenAttribute( 'class', 'icons' );

        return $menu;
    }
}
