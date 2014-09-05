<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 15:22
 */

namespace Efl\WebBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\Content\LocationUpdateStruct;

/**
 * Class Command6Command
 * @package Efl\WebBundle\Command
 *
 * Además moverá algunas localizaciones a esa zona para así
 * poder formar el menú de 'Grupo Francis Lefebvre'
 * y cambiará el nombre de la carpeta 'Grupo Francis Lefebvre'
 *
 */
class Command7Command extends ContainerAwareCommand
{
    /** @var \eZ\Publish\API\Repository\Repository */
    protected $repository;

    /**
     * @var \eZ\Publish\API\Repository\LocationService
     */
    protected $locationService;

    protected $contentService;

    protected $contentTypeService;

    /**
     * @var \eZ\Publish\API\Repository\SearchService
     */
    protected $searchService;


    protected function configure()
    {
        $this->setName( 'efl:web:command7' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $this->repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $this->contentService = $this->repository->getContentService();
        $this->locationService = $this->repository->getLocationService();
        $this->contentTypeService = $this->repository->getContentTypeService();
        $this->searchService = $this->repository->getSearchService();
        $this->repository->setCurrentUser( $this->repository->getUserService()->loadUser( 14 ) );

        try
        {
            $location = $this->locationService->loadLocation( 63 );

            $grupoLocation = $this->locationService->loadLocation( 89 );
            $this->locationService->moveSubtree( $grupoLocation, $location );

            $rrhhLocation = $this->locationService->loadLocation( 91 );
            $this->locationService->moveSubtree( $rrhhLocation, $location );

            $sistemaMementoLocation = $this->locationService->loadLocation( 1464 );

            $contentInfo = $this->contentService->loadContentInfo(
                $grupoLocation->contentInfo->id
            );
            $contentDraft =  $this->contentService->createContentDraft( $contentInfo );

            $contentUpdateStruct = $this->contentService->newContentUpdateStruct();
            $contentUpdateStruct->initialLanguageCode = 'esl-ES'; // set language for new version
            $contentUpdateStruct->setField( 'name', 'El grupo' );

            // update and publish draft
            $contentDraft =  $this->contentService->updateContent( $contentDraft->versionInfo, $contentUpdateStruct );

            $content =  $this->contentService->publishVersion( $contentDraft->versionInfo );

            // sistema memento
            $contentInfo = $this->contentService->loadContentInfo(
                $sistemaMementoLocation->contentInfo->id
            );
            $contentDraft =  $this->contentService->createContentDraft( $contentInfo );

            $contentUpdateStruct = $this->contentService->newContentUpdateStruct();
            $contentUpdateStruct->initialLanguageCode = 'esl-ES'; // set language for new version
            $contentUpdateStruct->setField( 'name', 'Sistema Memento' );

            // update and publish draft
            $contentDraft =  $this->contentService->updateContent( $contentDraft->versionInfo, $contentUpdateStruct );
            $content =  $this->contentService->publishVersion( $contentDraft->versionInfo );

            // actualizamos prioridades
            $this->locationService->updateLocation(
                $grupoLocation,
                new LocationUpdateStruct(
                    array(
                        'priority' => 1
                    )
                )
            );

            // actualizamos prioridades
            $this->locationService->updateLocation(
                $sistemaMementoLocation,
                new LocationUpdateStruct(
                    array(
                        'priority' => 2
                    )
                )
            );

            // actualizamos prioridades
            $this->locationService->updateLocation(
                $rrhhLocation,
                new LocationUpdateStruct(
                    array(
                        'priority' => 3
                    )
                )
            );

            $this->locationService->updateLocation(
                $this->locationService->loadLocation( 83 ),
                new LocationUpdateStruct(
                    array(
                        'priority' => 4
                    )
                )
            );

            $this->locationService->updateLocation(
                                  $this->locationService->loadLocation( 82 ),
                                      new LocationUpdateStruct(
                                          array(
                                              'priority' => 5
                                          )
                                      )
            );

            $this->locationService->updateLocation(
                                  $this->locationService->loadLocation( 81 ),
                                      new LocationUpdateStruct(
                                          array(
                                              'priority' => 6
                                          )
                                      )
            );


        }
        catch ( Exception $e )
        {
            print_r( $e );
            $output->writeln( $e->getMessage() );
        }
    }

}
