<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 29/09/14
 * Time: 9:35
 */

namespace Efl\WebBundle\Helper;

class LeadsHelper
{
    /**
     * @var array
     */
    private $params = array();

    /**
     * @var null
     */
    private $client;

    public function __construct( $params )
    {
        $this->params = $params;
        $this->client = null;
    }

    /**
     * Manda lead de petición qmementix
     *
     * @param array $data
     */
    public function sendQMementixLead( $data )
    {
        if ( $this->client === null )
        {
            $this->connect();
        }

        $this->client->CreateLead(
            array(
                "StrLeadFirstName" => $data['nombre'],
                "StrLeadLastName1" => $data['apellido1'],
                "StrLeadLastName2" => $data['apellido2'],
                "StrLeadPostalCode" =>  $data['cp'],
                "StrLeadPhoneHome" => $data['phone'],
                "StrLeadMail" => $data['email'],
                "ArrStrProductId" => array(),
                "ArrStrProductName" => array(' QMementix' ),
                "StrBusinessAction" => '10930',
                "StrRequest" => 'Información',
                "StrSource" => 'http://www.efl.es',
                "StrObservations" => ''
            )
        );
    }


    /**
     * Manda lead de petición imemento
     *
     * @param array $data
     */
    public function sendImementoLead( $data )
    {
        if ( $this->client === null )
        {
            $this->connect();
        }

        $this->client->CreateLead(
            array(
                "StrLeadFirstName" => $data['nombre'],
                "StrLeadLastName1" => $data['apellido1'],
                "StrLeadLastName2" => $data['apellido2'],
                "StrLeadPostalCode" =>  $data['cp'],
                "StrLeadPhoneHome" => $data['phone'],
                "StrLeadMail" => $data['email'],
                "ArrStrProductId" => array(),
                "ArrStrProductName" => array('Imemento'),
                "StrBusinessAction" => '10931',
                "StrRequest" => 'Información',
                "StrSource" => 'http://www.efl.es',
                "StrObservations" => ''
            )
        );
    }

    /**
     * Manda lead de petición prueba qmemento
     *
     * @param array $data
     */
    public function sendQMementoLead( $data )
    {
        if ( $this->client === null )
        {
            $this->connect();
        }

        $this->client->CreateLead(
            array(
                "StrLeadFirstName" => $data['nombre'],
                "StrLeadLastName1" => $data['apellido1'],
                "StrLeadLastName2" => $data['apellido2'],
                "StrLeadPostalCode" =>  $data['cp'],
                "StrLeadPhoneHome" => $data['phone'],
                "StrLeadMail" => $data['email'],
                "ArrStrProductId" => array(),
                "ArrStrProductName" => array( 'Productos electrónicos - Qmemento ' ),
                "StrBusinessAction" => '10930',
                "StrRequest" => 'Demo',
                "StrSource" => 'http://www.efl.es',
                "StrObservations" => ''
            )
        );
    }

    /**
     * Conexión al webservice
     */
    private function connect()
    {
        $this->client = new \SoapClient( $this->params['host'] . $this->params['wsdl'] );
    }
}
