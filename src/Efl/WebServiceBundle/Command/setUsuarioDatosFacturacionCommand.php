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
class setUsuarioDatosFacturacionCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName( 'efl:ws:setUsuarioFacturacion' )->setDefinition(array());
    }

    protected function execute( InputInterface $input, OutputInterface $output )
    {
        $ws = new EflWsConnection(
            array(
                'host' => 'http://wcflibreriavirtual.local/',
                'wsdl' => 'ServiceLibreriaVirtual.svc?wsdl'
            )
        );



        print_r( $ws->setUsuarioDatosEnvio(
            array(
                'idUsuario' => 99,
                'nombre' => 'Carlitos',
                'apellido1' => 'Revillo',
                'apellido2' => 'Vidales',
                'direccion' => 'Avenida América',
                'numero' => '26',
                'dir_resto' => '6 B',
                'cp' => '24401',
                'localidad' => 'Ponferrada',
                'id_provincia' => 24,
            )
        ) );

        print_r( $ws->setUsuarioDatosFacturacion(
            array(
                'idUsuario' => 99,
                'nombre_empresa' => '',
                'nif' => '10204708E',
                'telefono' => '914401040',
                'telefono_empresa' => '',
                'telefono_movil' => '653130759',
                'fax' => '',
                'dir_tipo' => 'CALLE',
                'direccion' => 'Julián Camarillo',
                'numero' => '26',
                'dir_resto' => 'Planta 1',
                'cp' => '28037',
                'localidad' => 'Madrid',
                'id_provincia' => 28,
                'direcciones_iguales' => false,
                'observaciones' => ''
            )
        ) );

    }
}
