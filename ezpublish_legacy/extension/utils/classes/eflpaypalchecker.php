<?php 
/**
 * clase que recibe las notificaciones de paypal. 
 * Actualizará el estado de los pagos.
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */

class eflPaypalChecker extends eZPaymentCallbackChecker
{
   /**
    * Constructor. Lee las configuraciones el ini dado
    * 
    * @param $iniFile
    * @return void
    */
    function eflPaypalChecker( $iniFile )
    {
        $this->eZPaymentCallbackChecker( $iniFile );
        $this->logger = eZPaymentLogger::CreateForAdd( 'var/log/eZPaypalChecker.log' );    
    }

   /**
    * (non-PHPdoc)
    * @see kernel/shop/classes/eZPaymentCallbackChecker#requestValidation()
    */
    function requestValidation()
    {
        $server     = $this->ini->variable( 'Paypal', 'ServerName');
        //$serverPort = $this->ini->variable( 'ServerSettings', 'ServerPort');
        $serverPort = 80;
        $requestURI = $this->ini->variable( 'Paypal', 'RequestURI');
        $request    = $this->buildRequestString();
        $response   = $this->sendPOSTRequest( $server, $serverPort, $requestURI, $request);

        $this->logger->writeTimedString( $response, 'requestValidation. response from server is' );
       
        if( $response && strcasecmp( $response, 'VERIFIED' ) == 0 )
        {
            return true;
        }
      
        $this->logger->writeTimedString( 'invalid response' );
        return false;
    }

    /**
     * Comprueba el estado de un pago
     * @return bool
     */
    function checkPaymentStatus()
    {
        if( $this->checkDataField( 'payment_status', 'Completed' ) )
        {
            return true;
        }

        $this->logger->writeTimedString( 'checkPaymentStatus faild' );
        return false;
    }

    /**
     * (non-PHPdoc)
     * @see kernel/shop/classes/eZPaymentCallbackChecker#buildRequestString()
     */
    function buildRequestString()
    {
        $request = "cmd=_notify-validate";
        foreach( $this->callbackData as $key => $value )
        {
            $request .= "&$key=".urlencode( $value );
        }
        return $request;
    }
    
    /**
     * (non-PHPdoc)
     * @see kernel/shop/classes/eZPaymentCallbackChecker#handleResponse($socket)
     */
    function handleResponse( $socket )
    {
        if( $socket )
        {
            while ( !feof( $socket ) )
            {
                $response = fgets ( $socket, 1024 );
            }
      
            fclose( $socket );
            return $response;
        }

        $this->logger->writeTimedString( "socket = $socket is invalid.", 'handlePOSTResponse faild' );
        return null;
    }
    
    /**
     * (non-PHPdoc)
     * @see kernel/shop/classes/eZPaymentCallbackChecker#setupOrderAndPaymentObject($orderID)
     */
	function setupOrderAndPaymentObject( $orderID )
    {
        if ( isset( $orderID ) && $orderID > 0 )
        {
            $this->paymentObject = eflPaymentObject::fetchByOrderID( $orderID );
            $this->logger->writeTimedString( serialize( $this->paymentObject ) );
            if ( isset( $this->paymentObject ) )
            {
                $this->order = eZOrder::fetch( $orderID );
                if ( isset( $this->order ) )
                {
                    return true;
                }
                $this->logger->writeTimedString( "Unable to fetch order object with orderID=$orderID", 'setupOrderAndPaymentObject failed' );
                return false;
            }
            $this->logger->writeTimedString( "Unable to fetch payment object with orderID=$orderID", 'setupOrderAndPaymentObject failed' );
            return false;
        }
        $this->logger->writeTimedString( "Invalid orderID=$orderID", 'setupOrderAndPaymentObject failed' );
        return false;
    }
    
	function approvePayment()
    {
        if( $this->paymentObject )
        {
        	$this->logger->writeTimedString( $this->paymentObject->OrderID );
        	$this->logger->writeTimedString( serialize( $this->paymentObject ) );
            $this->paymentObject->approve();
            $this->paymentObject->store();

            $this->logger->writeTimedString( 'payment was approved' );

            return true;
        }

        $this->logger->writeTimedString( "payment object is not set", 'approvePayment failed' );
        return null;
    }
}
?>