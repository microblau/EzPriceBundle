<?php 
/**
 * Clase encargada de controlar los métodos de pago de EFL
 * Cada método devolverá al formulario de pago una url y parámetros
 * asociados al tipo de pago que se haya seleccionad 
 * 
 * @author carlos.revillo
 * @version 0.1
 * @package efl
 *
 */
class eflPaymentMethods
{
	/**
	 * Constructor
	 * 
	 * Lee las configuraciones
	 * 
	 */
	public function __construct()
	{
		$this->PaymentINI = eZINI::instance( 'basket.ini' );
	}
	
	/**
	 * Deofuscación de la palabra clave según documentacion BBVA
	 * 
	 * @param string $pal_sec_ofuscada
	 * @param string $clave_xor
	 * @return string
	 */
    function desobfuscate($pal_sec_ofuscada,$clave_xor)
    {
        $trozos = explode (";", $pal_sec_ofuscada);
        $tope = count($trozos);
        $res="";
        for ($i=0; $i<$tope; $i++)
        {
            $x1=ord($clave_xor[$i]);
            $x2=hexdec($trozos[$i]);
            $r=$x1 ^ $x2;
            $res.=chr($r);
        }
        return($res);
    }
    
    /**
     * Devuelve un array con la url para llamar al pago por domiciliación. 
     * 
     * @param int $order_id
     * @param float $importe
     * @return array
     */
    function domiciliacion( $order_id, $importe )
    {
        $url = 'domiciliacion/complete/'  . $order_id;
        eZURI::transformURI( $url );
        return array( 'action' => $url, 
                      'fields' => array( array( 'name' => 'importe', 'value' => number_format( str_replace( ',', '.', $importe ), 2, '.', '' ) ) )  
        );
    }
    
    /**
     * Devuelve un array con la url para llamar al pago por transferencia. 
     * 
     * @param int $order_id
     * @param float $importe
     * @return array
     */
    function transferencia( $order_id, $importe )
    {
        $url = 'transferencia/complete/' . $order_id;
        eZURI::transformURI( $url );
        return array( 'action' => $url, 
                      'fields' => array( array( 'name' => 'importe', 'value' => number_format( str_replace( ',', '.', $importe ), 2, '.', '' ) ) )  
        );
    }
	
    /**
     * Devuelve un array con la url para llamar a la pasarela de pago de BBVA
     * y con el xml formado según el importe y las especificacioens del BBVA. 
     * 
     * @param int $order_id
     * @param float $importe
     * @return array
     */
	function bbva( $order_id, $importe, $idtransaccion )
	{
		$url = $this->PaymentINI->variable( 'BBVA', 'URL' );
		$codComercio = $this->PaymentINI->variable( 'BBVA', 'CodComercio' );
		$idTerminal = $this->PaymentINI->variable( 'BBVA', 'IdTerminal' );
		$secret = $this->PaymentINI->variable( 'BBVA', 'Secret' );
		$desofuscar = $this->PaymentINI->variable( 'BBVA', 'DesOfuscar' );
		$http = eZHTTPTool::instance();
		$cd_camp = $http->sessionVariable( 'cd_camp_sesion' );
		
		$cad = '<tpv>';
        $cad .= '<oppago>';
        $cad .= '<idterminal>' . $idTerminal . '</idterminal>';
        $cad .= '<idcomercio>' . $codComercio . '</idcomercio>';
        
       
        
        $cad .= '<idtransaccion>' . "$idtransaccion"  . '</idtransaccion>';
        $cad .= '<moneda>978</moneda>';
        $cad .= '<importe>' . $importe . '</importe>';
        $cad .= '<urlcomercio>http://' . $_SERVER['HTTP_HOST'] . '/tpv/notification/' . $order_id . '/' . $cd_camp . '</urlcomercio>';  
        $cad .= '<idioma>es</idioma>';  
        $cad .= '<pais>ES</pais>';  
        $cad .= '<urlredir>http://' . $_SERVER['HTTP_HOST'] . '/tpv/complete/' . $order_id . '</urlredir>';
    
        $des_key = $desofuscar. substr( $codComercio ,0,9 ) ."***";
        
        $desobfuscated=$this->desobfuscate( $secret , $des_key);
        $importetxt = (string)$importe * 100;
       
        if( ( ( $importe  * 100 ) < 100 ) and ( ( $importe * 100 ) > 10 ) )
        {
      
        	$importetxt = '0'.(string)$importetxt;
        }   
        elseif ( ( $importe * 100 ) < 10 )
        {
      
        	$importetxt = 'a00' . (string)$importetxt;
        }
      
        $datosfirma = $idTerminal .
                      $codComercio .
                      "$idtransaccion" .
                       (string)$importetxt .
                    '978' .
                    $desobfuscated;
        
        $firmatext=strtoupper(sha1($datosfirma));
       
        $cad .=  '<firma>' . strtoupper(sha1($datosfirma) ) . '</firma></oppago></tpv>';
        return array( 'action' => $url,
                      'fields' => array( array( 'name' => 'peticion', 'value' => $cad ) )  
        );
	}
	
	/**
	 * Devuelve la url de pago de paypal y los parámetros necesarios 
	 * para poder formar un pedido dividido en productos.
	 * 
	 * @param int $order_id
	 * @param float $importe
         * @param int $gastosEnvio gastos Aplicados
	 * @return array
	 */
	
	function paypal( $order_id, $importe, $aplazado = 0, $gastosEnvio )
	{
		$url = $this->PaymentINI->variable( 'Paypal', 'ServerName' );
		$cgi = $this->PaymentINI->variable( 'Paypal', 'RequestURI' );
		$business = $this->PaymentINI->variable( 'Paypal', 'Business' );
		$order = ezEflUtils::getOrderInfo( $order_id );
		$http = eZHTTPTool::instance();
		$cd_camp = $http->sessionVariable( 'cd_camp_sesion' );
		
		if( $aplazado == 0 )
		{
			$fields = array();		
		
			$fields[] = array( 'name' => "cmd", 'value'=>"_cart" );
			$fields[] = array( 'name' => "charset", 'value'=>"utf-8" );
			$fields[] = array( 'name' => "notify_url", 'value'=>"https://" . $_SERVER['HTTP_HOST'] . "/paypal/ipn/" . $order_id . "?cd_camp=" . $cd_camp );
			$fields[] = array( 'name' => "cancel_return", 'value'=>"https://" . $_SERVER['HTTP_HOST'] .  "/paypal/cancel" );
			$fields[] = array( 'name' => "no_note", 'value'=>"1" );
			$fields[] = array( 'name' => "no_shipping", 'value'=>"1" );

                        $fields[] = array( 'name' => "currency_code", 'value'=>"EUR" );
			$fields[] = array( 'name' => "return", 'value'=>"https://" . $_SERVER['HTTP_HOST'] .  "/paypal/complete/" . $order_id );
			$fields[] = array( 'name' => "rm", 'value'=>"2" );
			$fields[] = array( 'name' => "invoice", 'value'=> $order_id );
			$fields[] = array( 'name' => "business", 'value'=> $business );
			$fields[] = array( 'name' => "upload", 'value'=>"1" );
			$fields[] = array( 'name' => "lc", 'value'=>"ES" );
			$fields[] = array( 'name' => "address1", 'value'=> $order['result']['tipovia'] . '/' . $order['result']['dir1'] . ', ' . $order['result']['num'] . '. ' . $order['result']['complemento'] );
			$fields[] = array( 'name' => "city", 'value'=> $order['result']['localidad'] );
			$fields[] = array( 'name' => "country", 'value'=> $order['result']['pais'] );
			$fields[] = array( 'name' => "email", 'value'=> $order['result']['email'] );
			$fields[] = array( 'name' => "first_name", 'value'=>"Carlos" );
			$fields[] = array( 'name' => "last_name", 'value'=>"Revillo" );
			$fields[] = array( 'name' => "state", 'value'=>$order['result']['provincia']);
			$fields[] = array( 'name' => "address_override", 'value'=>"1" );
                        
			$basket = eZBasket::currentBasket();
			$products = tantaBasketFunctionCollection::getProductsInBasket( $basket->attribute( 'productcollection_id' ) );
            $items = $products['result'];
            $productscount = count( $items ) ;
			$tax = 0;
			for( $i = 1; $i <= count( $items ); $i++ )
			{
             
				$data = $items[$i-1]['item_object']->ContentObject->dataMap();
			
				$fields[] = array( 'name' => "amount_$i", 'value'=> number_format( ( $items[$i-1]['total_price_ex_vat'] / $items[$i-1]['item_count'] ), 2 )   );
				$fields[] = array( 'name' => "item_name_$i", 'value'=> strip_tags( $items[$i-1]['object_name'] ) );
				if ( $data['referencia'] )
				{
				$fields[] = array( 'name' => "item_number_$i", 'value'=> $data['referencia']->content() );
				}
				$fields[] = array( 'name' => "quantity_$i", 'value'=> $items[$i-1]['item_count'] );
				$tax += $items[$i-1]['total_price_inc_vat'] - $items[$i-1]['total_price_ex_vat'];  
			}

            $products = tantaBasketFunctionCollection::getTrainingInBasket( $basket->attribute( 'productcollection_id' ) );
            $items = $products['result'];
            $cursoscount = count( $items );
		
            $j = 0;
			for( $i = ( 1 + $productscount ); $i <= count( $items ) + $productscount ; $i++ )
			{

                
				$data = $items[$j]['item_object']->ContentObject->dataMap();
			
				$fields[] = array( 'name' => "amount_$i", 'value'=> number_format( ( $items[$j]['total_price_ex_vat'] / $items[$j]['item_count'] ), 2 )   );
				$fields[] = array( 'name' => "item_name_$i", 'value'=> strip_tags( $items[$j]['object_name'] ) );
				if ( $data['referencia'] )
				{
				$fields[] = array( 'name' => "item_number_$i", 'value'=> $data['referencia']->content() );
				}
				$fields[] = array( 'name' => "quantity_$i", 'value'=> $items[$j]['item_count'] );
				$tax += $items[$j]['total_price_inc_vat'] - $items[$j]['total_price_ex_vat'];  
                   $j++;
			}
			
			$fields[] = array( 'name' => "tax_cart", 'value'=> number_format( $tax, 2 ) );
                        
                        $n =  $productscount + $cursoscount + 1;
                        $fields[] = array( 'name' => "amount_$n", 'value'=> number_format( $gastosEnvio, 2 )   );
                        $fields[] = array( 'name' => "item_name_$n", 'value'=> 'Gastos de Envío' );
                        $fields[] = array( 'name' => "quantity_$n", 'value'=> 1 );
				
		}
		else
		{
			$fields[] = array( 'name' => "cmd", 'value'=>"_xclick" );
			$fields[] = array( 'name' => "charset", 'value'=>"utf-8" );
			$fields[] = array( 'name' => "notify_url", 'value'=>"http://" . $_SERVER['HTTP_HOST'] . "/paypal/ipn/" . $order_id . "?cd_camp=" . $cd_camp );
			$fields[] = array( 'name' => "cancel_return", 'value'=>"http://" . $_SERVER['HTTP_HOST'] .  "/paypal/cancel" );
			//$fields[] = array( 'name' => "no_note", 'value'=>"1" );
			$fields[] = array( 'name' => "no_shipping", 'value'=>"1" );
			$fields[] = array( 'name' => "currency_code", 'value'=>"EUR" );
			$fields[] = array( 'name' => "return", 'value'=>"http://" . $_SERVER['HTTP_HOST'] .  "/paypal/complete/" . $order_id );
			//$fields[] = array( 'name' => "rm", 'value'=>"2" );
			//$fields[] = array( 'name' => "invoice", 'value'=> $order_id );
			$fields[] = array( 'name' => "business", 'value'=> $business );
			//$fields[] = array( 'name' => "upload", 'value'=>"1" );
			//$fields[] = array( 'name' => "lc", 'value'=>"ES" );
			//$fields[] = array( 'name' => "address1", 'value'=> $order['result']['tipovia'] . '/' . $order['result']['dir1'] . ', ' . $order['result']['num'] . '. ' . $order['result']['complemento'] );
			//$fields[] = array( 'name' => "city", 'value'=> $order['result']['localidad'] );
			//$fields[] = array( 'name' => "country", 'value'=> $order['result']['pais'] );
			$fields[] = array( 'name' => "email", 'value'=> $order['result']['email'] );
			//$fields[] = array( 'name' => "first_name", 'value'=>"Carlos" );
			//$fields[] = array( 'name' => "last_name", 'value'=>"Revillo" );
			//$fields[] = array( 'name' => "state", 'value'=>$order['result']['provincia']);
			//$fields[] = array( 'name' => "address_override", 'value'=>"1" );						
			$fields[] = array( 'name' => "amount", 'value'=>number_format( $importe, 2, '.', '' ) );
			$fields[] = array( 'name' => "item_name", 'value'=> 'Primer plazo de compra. Pedido nº ' .  $order_id );
			
		
		}
		
		return array( 'action' => $url . $cgi, 
                      'fields' => $fields );
		
	}
	
	var $PaymentINI;
	
}
?>
