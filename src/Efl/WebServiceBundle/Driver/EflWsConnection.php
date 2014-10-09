<?php

namespace Efl\WebServiceBundle\Driver;

use Psr\Log\LoggerInterface;

class EflWsConnection implements  EflWsConnectionInterface
{
    /**
     * @var array
     */
    private $params = array();

    /**
     * @var \Psr\Log\Test\LoggerInterface
     */
    private $logger;

    /**
     * @var \Soapclient
     */
    private $ws_res;

    public function __construct(array $params, LoggerInterface $logger = null)
    {
        $this->params = $params;
        $this->logger = $logger;
        $this->ws_res = NULL;
    }

    public function validaUsuario( $email, $password )
    {
        if ($this->ws_res ===  NULL) {
            $this->connect();
        }
        if (!$email) {
            $this->logger->info('Email not given');

            return false;
        }

        if (!$password) {
            $this->logger->info('Password not given');
            return false;
        }

        $validaUsuario = $this->ws_res->ValidaUsuario(
            array(
                'p_StrEmail' => $email,
                'p_StrPass' =>  $password
            )
        );

        return is_object( $validaUsuario->ValidaUsuarioResult->data )
            ? $validaUsuario->ValidaUsuarioResult->data
            : false;
    }

    /**
     *
     * @param array $data
     *
     * @return mixed
     */
    public function nuevoUsuario( array $data )
    {
        if ( $this->ws_res ===  NULL)
        {
            $this->connect();
        }

        $nuevoUsuario = $this->ws_res->NuevoUsuario(
            array(
                'p_StrEmail' => $data['email'],
                'p_StrPass' => $data['password'],
                'p_StrNombre' => $data['nombre'],
                'p_StrApellido1' => $data['apellido1'],
                'p_StrApellido2' => $data['apellido2'],
                'p_StrDirIdPais' => $data['pais'],
                'p_IntIdTipoUsuario' => $data['tipo_usuario']
            )
        );

        return $nuevoUsuario->NuevoUsuarioResult;
    }

    /**
     * Nos dice si el usuario con el email dado existe en el webservice
     *
     * @param $email
     *
     * @return bool
     * @throws \Exception
     */
    public function existeUsuario( $email )
    {
        if ( $this->ws_res === null )
        {
            $this->connect();
        }

        $userExists = $this->ws_res->ExisteUsuario(
            array(
                'p_StrEmail' => $email
            )
        );

        if ( $userExists->ExisteUsuarioResult != 1) {
            //throw new \Exception( 'User not found' );
        }

        return $userExists->ExisteUsuarioResult == 1;
    }

    /**
     * Obtener datos de usuario guardados en ws
     *
     * @param $idUsuario
     */
    public function getUsuario( $idUsuario )
    {
        if ( $this->ws_res === null )
        {
            $this->connect();
        }

        $usuario = $this->ws_res->GetUsuario(
            array(
                'p_IntIdUsuarioLv' => $idUsuario
            )
        );

        return $usuario;
    }

    /**
     * Setea los datos de facturación del usuario
     *
     * @param $idUsuario
     */
    public function setUsuarioDatosFacturacion( $data )
    {
        if ( $this->ws_res === null )
        {
            $this->connect();
        }

        $usuario = $this->ws_res->SetUsuarioDatosFacturacion(
            array(
                'p_IntIdUsuarioLv' => $data['idUsuario'],
                'p_StrNombreEmpresa' => $data['nombre_empresa'],
                'p_StrCifNif' => $data['nif'],
                'p_StrTlf' => $data['telefono'],
                'p_StrTlfEmpresa' => $data['telefono_empresa'],
                'p_StrTlfMovil' => $data['telefono_movil'],
                'p_StrFax' => $data['fax'],
                'p_StrDirTipo' => $data['dir_tipo'],
                'p_StrDirNombre' => $data['direccion'],
                'p_StrDirNumero' => $data['numero'],
                'p_StrDirResto' => $data['dir_resto'],
                'p_StrDirCpostal' => $data['cp'],
                'p_StrDirLocalidad' => $data['localidad'],
                'p_StrDirProvincia' => $data['provincia'],
                'p_IntDirFactIgualEnvio' => (int)$data['direcciones_iguales'],
                'p_StrObservaciones' => $data['observaciones']
            )
        );

        return $usuario;
    }

    public function recuperarPreciosProducto( $cod )
    {
        if ( $this->ws_res === null )
        {
            $this->connect();
        }

        $data = $this->ws_res->RecuperarProductosPrecio(
            array(
                'StrIdProducto' => $cod
            )
        );

        if ( isset( $data->RecuperarProductosPrecioResult->data->Producto ) )
            return (float)$data->RecuperarProductosPrecioResult->data->Producto->precioBase;
    }

    /**
     * conexión al ws
     */
    private function connect()
    {
        $this->ws_res = new \SoapClient( $this->params['host'] . $this->params['wsdl'] );
    }
}
