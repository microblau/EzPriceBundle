<?php 
/**
 * Clase con las funciones que devolverán el resultado a las peticiones 
 * ajax relacionadas con los distintos plazos
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class ezEflPagosServerFunctions extends ezjscServerFunctions
{
	/**
	 * En función del importe devolverá un html con 
	 * a) el importe a pagar en primer plazo
	 * b) un combo con las distintas opciones
	 * 
	 * @author carlos.revillo@tantacom.com
	 * @param $args
	 * @return unknown_type
	 */
	function getplazos( $args )
	{
		$basket = eZBasket::currentBasket();
		$output = '<li id="infopago">';
		$plazos = tantaBasketFunctionCollection::getPlazos( $basket->totalIncVAT() );
		$output .= '<select id="npagos" name="npagos" style="width:250px">';
		$output .= '<option value="0">Selecciona número de plazos</option>';
		if( count( $plazos ) > 0 )
		{
			foreach( $plazos as $plazo )
			{
				$output.= '<option value="' . $plazo->ContentObjectID . '">' . $plazo->Name . '</option>';
			}
		}
		$output .= '</select>';
		$output.= '</li>';

		return array( 'result' => $output );
	}

	function showplazos( $args )
	{
		$basket = eZBasket::currentBasket();
		$http = eZHTTPTool::instance();
	
		if( $http->postVariable( 'node_id' ) == 0 )
		{
			return array( 'importe' => $basket->totalIncVAT(), 'text' => '' );
		}
		else
		{
			$info = eZContentObject::fetch( $http->postVariable( 'node_id' ) );
			$data = $info->dataMap();
			$plazos = tantaBasketFunctionCollection::getPlazos( $basket->totalIncVAT() );
			$precio = '<div id="informacionpago">' . $data['cantidad_primera_cuota']->content()->attribute( 'inc_vat_price' );
			$output = '<div id="infopagando" style="margin-top:20px">';
			$output .= $data['texto_plazos']->attribute( 'content' )->attribute( 'output' )->attribute( 'output_text' );
			$output .= '<table cellspacing="0" summary="" width="70%">
                                                    		<colgroup>
                                                    			<col width="15%" />
                                                    			<col width="40%" />
                                                    			<col width="15%" />
                                                    		</colgroup>

                                                    		<thead>
                                                    			<tr>
                                                    				<th>Pago Nº</th>
                                                    				<th>Fecha</th>
                                                    				<th>Importe</th>
                                                    			</tr>
                                                    		</thead>

                                                    		<tfoot>
                                                    			<tr>
                                                    				<th colspan="2">TOTAL</th>
                                                    				<td>'. number_format( $basket->totalIncVAT(), 2, '.', '.' ) .' €</td>
                                                    			</tr>
                                                    		</tfoot>
                                                    		<tbody>
                                                    			<tr>
                                                    				<td>Pago 1</td>
                                                    				<td>' . date( 'd-m-Y' ) . '</td>
                                                    				<td id="impplazo1">' . number_format( $basket->totalIncVAT() / $data['plazos']->content(), 2, '.', '.' ) . ' €</td>
                                                    			</tr>
                                                    			
                                                    		</tbody>
                                                    		</table></div>';
			return array( 'importe' => (string)( $basket->totalIncVAT() / $data['plazos']->content() ), 'plazos'=> $data['plazos']->content(), 'text' => $output );
		}
	}
}

?>
