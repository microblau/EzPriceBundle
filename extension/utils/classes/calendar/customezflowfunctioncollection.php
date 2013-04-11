<?php 
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 eZ Systems AS
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.
//
//
// ## END COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
//

/**
 * 
 * customEZFlowFunctionCollection es una clase con funciones para obtener 
 * información de attributos del tipo customezpage, creados para el site de 
 * Francis Lefebvre
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
*/
class customEZFlowFunctionCollection
{
	/**
	 * Devuelve los elementos válidos para el bloque pasado en $block_id
	 * 
	 * @static
	 * @param string $block_id identificador del bloque
	 * @return array
	 */
	static function customValidNodes( $block_id )
	{
		return array( 'result' => customEZFlowPool::validNodes( $block_id, false ) );
	}
	
	/**
	 * Devuelve los elementos en la cola del bloque pasado en $block_id
	 * 
	 * @static
	 * @param string $block_id identificador del bloque
	 * @return array
	 */
	static function customWaitingNodes( $block_id )
	{
		return array( 'result' => customEZFlowPool::waitingItems( $block_id ) );
	}
	
	/**
	 * Devuelve los elementos contenidos en la posición $pos del bloque $block_id
	 * con desplazamiento $offset y límite $limit
	 * 
	 * @static
	 * @param string $block_id identificador del bloque
	 * @param int $pos posición que queremos (1 o 2)
	 * @param int $offset
	 * @param int $limit
	 * @return array
	 */
	static function getElementsForBlock( $block_id, $pos = null, $offset, $limit )
	{
		return array( 'result' => customEZFlowPool::getElementsForBlock( $block_id, $pos, $offset, $limit ) );
	}
	
	/**
	 * Número total de elementos contenidos en el bloque
	 * 
	 * @static
	 * @param string $block_id
	 * @param int $pos
	 * @param int $items_per_block
	 * @return array
	 */
	static function getTotalElementsForBlock( $block_id, $pos = null, $items_per_block )
	{
		return array( 'result' => customEZFlowPool::getTotalElementsForBlock( $block_id, $pos, $items_per_block ) );
	}

    static function getPosForNodeInBlock( $block_id, $node_id )
	{
	    $db = eZDB::instance();
	   
	    $query = $db->arrayQuery( "SELECT node_id, pos FROM ezm_pool_efl WHERE block_id='$block_id' AND node_id='$node_id'" );
	    
		return array( 'result' => $query[0] );
	}
}
?>
