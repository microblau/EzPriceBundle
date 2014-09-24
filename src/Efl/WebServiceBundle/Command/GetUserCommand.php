<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 14:19
 */

namespace Efl\WebServiceBundle\Command;

use Efl\WebServiceBundle\Driver\EflWsConnection;
use eZ\Publish\API\Repository\Values\ContentType\ContentTypeGroupCreateStruct as CreateGroupStruct;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;

/**
 * Class Command1Command
 * @package EflWebService\WebBundle\Command
 *
 */
class GetUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:ws:getUser' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $ws = new EflWsConnection(
            array(
                'host' => 'http://wcflibreriavirtual.local/',
                'wsdl' => 'ServiceLibreriaVirtual.svc?wsdl'
            )
        );
        print_r( $ws->getUsuario(
            35
        ) );
    }
}
