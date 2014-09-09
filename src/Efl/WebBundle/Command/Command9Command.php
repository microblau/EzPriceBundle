<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 08/09/14
 * Time: 08:31
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeUpdateStruct;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;
use Exception;

/**
 * Class Command8Command
 * @package Efl\WebBundle\Command
 *
 * Cogerá los campos about_materia y about información y los meterá en un
 * xml para así devolver la tabla a su estructura inicial
 *
 */
class Command9Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command9' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var \eZ\Publish\Core\Persistence\Database\DatabaseHandler; */
        $dbHandler = $this->getContainer()->get( 'ezpublish.api.storage_engine.legacy.dbhandler' );
        $query = $dbHandler->createSelectQuery();
        $query->select( 'id', 'about_materia', 'about_info' )
            ->from( 'cjwnl_user');

        $statement = $query->prepare();

        if( $statement->execute() )
        {
            $results = $statement->fetchAll();

            foreach( $results as $result )
            {
                $xmlString = $this->buildXmlStringForRecord( $result );
                $updateQuery = $dbHandler->createUpdateQuery();
                $updateQuery->update(
                      $dbHandler->quoteTable( "cjwnl_user" )
                )->set(
                      $dbHandler->quoteColumn( "data_xml" ),
                      $updateQuery->bindValue( $xmlString, null, \PDO::PARAM_STR )
                )
                ->where(
                    $updateQuery->expr->eq(
                        $dbHandler->quoteColumn( "id" ),
                        $updateQuery->bindValue( $result['id'], null, \PDO::PARAM_INT )
                    )
                );
                $updateQuery->prepare()->execute();
            }
        }

        // eliminar campos que ya no queremos porque ya tenemos en xml
        $dbHandler->exec(
            'ALTER table cjwnl_user DROP column about_materia'
        );
        $dbHandler->exec(
            'ALTER table cjwnl_user DROP column about_info'
        );
    }

    private function buildXmlStringForRecord( $result )
    {
        $doc = new \DOMDocument( '1.0', 'utf-8' );

        $root = $doc->createElement( 'info' );
        $info = $doc->createElement( 'about_info' );
        $materias = $doc->createElement( 'about_materias' );

        foreach ( explode( '-', $result['about_info'] ) as $val )
        {
            if ( !empty( $val ) )
            {
                $infoData = $doc->createElement( 'data', $val );
                $info->appendChild( $infoData );
            }
        }

        foreach ( explode( '-', $result['about_materia'] ) as $val )
        {
            if ( !empty( $val ) )
            {
                $infoData = $doc->createElement( 'data', $val );
                $materias->appendChild( $infoData );
            }
        }

        $root->appendChild( $info );
        $root->appendChild( $materias );

        $doc->appendChild( $root );

        return $doc->saveXML();
    }
}
