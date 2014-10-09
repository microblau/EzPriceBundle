<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 4/10/14
 * Time: 8:58
 */

namespace Efl\BasketBundle\Command;

use Efl\WebBundle\eZ\Publish\Core\FieldType\WsProduct\Value as WsProductValue;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value as CategoryValue;
use EzSystems\EzPriceBundle\eZ\Publish\Core\FieldType\Price\Value as PriceValue;
use eZ\Publish\API\Repository\Repository;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\LocationQuery;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;

class CreateFormatsCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:basket:create_formats' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var \eZ\Publish\API\Repository\Repository $repository */
        $repository = $this->getContainer()->get( 'ezpublish.api.repository' );
        $dbHandler = $this->getContainer()->get( 'ezpublish.api.storage_engine.legacy.dbhandler' );
        $repository->setCurrentUser( $repository->getUserService()->loadUser( 3370 ) );
        $referencias = $this->getReferencesArrayInDB( $repository );

        foreach ( $referencias as $key => $referencia )
        {
            $correspondencias = $this->getCorrespondencias( $dbHandler, $referencia );
            if ( $correspondencias !== null )
            {
                if ( !empty( $correspondencias['COD_NAVISION_PAPEL'] ) )
                {
                    $this->createChild( $repository, $key, $correspondencias['COD_NAVISION_PAPEL'], 'papel', 1, $output );
                }
                if ( !empty( $correspondencias['COD_NAVISION_IMEMENTO'] ) )
                {
                    $this->createChild( $repository, $key, $correspondencias['COD_NAVISION_PAPEL'], 'ipad', 2, $output  );
                }
                if ( !empty( $correspondencias['COD_NAVISION_ELECTRONICO'] ) )
                {
                    $this->createChild( $repository, $key, $correspondencias['COD_NAVISION_PAPEL'], 'internet', 2, $output  );
                }
            }
        }
    }

    private function getReferencesArrayInDB( Repository $repository )
    {
        $query = new LocationQuery();
        $query->query = new Criterion\ContentTypeIdentifier( 'producto' );

        $results = $repository->getSearchService()->findLocations( $query )->searchHits;
        $refs = array();

        foreach ( $results as $result )
        {
            $content = $repository->getContentService()->loadContent( $result->valueObject->contentInfo->id );
            $refs[$result->valueObject->id] = $content->getFieldValue( 'referencia' )->text;
        }

        return $refs;
    }

    private function getCorrespondencias( DatabaseHandler $dbHandler, $referencia )
    {
        $query = $dbHandler->createSelectQuery();
        $query->select( 'COD_NAVISION_PAPEL', 'COD_NAVISION_IMEMENTO', 'COD_NAVISION_ELECTRONICO' )
            ->from( 'correspondencia_productos' )
            ->where(
                $query->expr->eq(
                    $dbHandler->quoteColumn( "COD_LV" ),
                    $query->bindValue( $referencia, null, \PDO::PARAM_STR )
            )
        );

        $statement = $query->prepare();

        if( $statement->execute() )
        {
            $row = $statement->fetch();
            return $row ? $row : null;
        }
    }

    private function createChild( Repository $repository, $locationId, $ref, $format, $category, OutputInterface $output )
    {
        try
        {
            $contentType = $repository->getContentTypeService()->loadContentTypeByIdentifier("formato_$format");
            $contentCreateStruct = $repository->getContentService()->newContentCreateStruct($contentType, 'esl-ES');
            $contentCreateStruct->setField('producto', new WsProductValue($ref));
            $contentCreateStruct->setField('categoria', new CategoryValue($category));
            $price = $this->getContainer()->get('efl_auth.ws_manager.default')->recuperarProductosPrecio($ref);
            $contentCreateStruct->setField( 'precio', new PriceValue( $price, false, -1 ) );
            $contentCreateStruct->setField( 'precio_oferta', new PriceValue( 0.0, false, -1 ) );

            $locationCreateStruct = $repository->getLocationService()->newLocationCreateStruct($locationId);
            // create a draft using the content and location create struct and publish it
            $draft = $repository->getContentService()->createContent($contentCreateStruct, array($locationCreateStruct));
            $repository->getContentService()->publishVersion($draft->versionInfo);
            $location = $repository->getLocationService()->loadLocation( $locationId );
            $output->writeln( "Creando $format bajo " . $location->contentInfo->name );
        }
        catch( \Exception $e )
        {
            $output->writeln( '<bg=red;options=bold>' . $e->getMessage() . '</bg=red;options=bold>' );
            $output->writeln( '<bg=red;options=bold>No hemos encontrado precio para ' . $ref . '</bg=red;options=bold>' );
            $output->writeln('');
        }

    }

}
