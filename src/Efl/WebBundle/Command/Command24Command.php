<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 08/09/14
 * Time: 08:31
 */

namespace Efl\WebBundle\Command;

use eZ\Publish\Core\Repository\Values\ContentType\ContentTypeCreateStruct as CreateTypeStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\API\Repository\Values\Content\Query\Criterion;
use eZ\Publish\API\Repository\Values\ContentType\FieldDefinitionCreateStruct;


/**
 * Class Command24Command
 * @package Efl\WebBundle\Command
 *
 * Borrar tablas no necesarias
 *
 */
class Command24Command extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:web:command24' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        /** @var \eZ\Publish\Core\Persistence\Database\DatabaseHandler; */
        $dbHandler = $this->getContainer()->get( 'ezpublish.api.storage_engine.legacy.dbhandler' );
        $dbHandler->exec(
            'DROP TABLE `ezxmlexport_available_contentclasses` ;
            DROP TABLE `ezxmlexport_available_contentclass_attributes`;
            DROP TABLE `ezxmlexport_customers`;
            DROP TABLE `ezxmlexport_exports`;
            DROP TABLE `ezxmlexport_export_object_log`;
            DROP TABLE `ezxmlexport_process_logs`'
        );
    }
}
