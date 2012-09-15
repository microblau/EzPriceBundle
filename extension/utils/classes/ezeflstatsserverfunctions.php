<?php
//
// Definition of ezsrServerFunctions class
//
// Created on: <4-Mar-2010 00:00:00 carlos.revillo@tantacom.com>
//
// ## BEGIN COPYRIGHT, LICENSE AND WARRANTY NOTICE ##
// SOFTWARE NAME: eZ Star Rating
// SOFTWARE RELEASE: 2.x
// COPYRIGHT NOTICE: Copyright (C) 2009 eZ Systems AS
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
 * Funciones que devuelven resultados a las peticiones ajax hechas desde las portadas
 * del site. (principalmente los carruseles)
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */

class ezEflStatsServerFunctions extends ezjscServerFunctions
{
	/**
	 * Devuelve el resultado para el bloque en cuestión. 
	 * Se encargará de devolver los nuevos links y los elementos
	 * visibles en ese bloque.
	 * 
	 * @param unknown_type $args
	 * @return array
	 */
	static function bestsell( $args )
	{
		include_once( "kernel/common/template.php" );
		$tpl = templateInit();
        $start = time() - 86400 * 7;
        $products = array();
        $query = eZShopFunctionCollection::fetchBestSellList( 61, 8, 0, $start, time() );
        foreach( $query['result'] as $result )
        {
            $products[] = eZContentObject::fetch( $result->ID )->attribute( 'main_node' );
        }
        $tpl->setVariable( 'title', 'Las más compradas' );
        $tpl->setVariable( 'products', $products );
        return array( 'result' => $tpl->fetch( 'design:ajax/resultadoshome.tpl' ) );	 	
	}

    static function bestviewed( $args )
	{
		include_once( "kernel/common/template.php" );
		$tpl = templateInit();
        $start = time() - 86400 * 7;
        $products = array();
        $query = tantaStatsFunctionCollection::fetchMostViewedTopList( 48, false, false, false, false, 8 );
        foreach( $query['result'] as $result )
        {
            $products[] = $result;
        }
        $tpl->setVariable( 'title', 'Las más consultadas' );
        $tpl->setVariable( 'products', $products );
        return array( 'result' => $tpl->fetch( 'design:ajax/resultadoshome.tpl' ) );	 	
	}

    static function news( $args )
	{
		include_once( "kernel/common/template.php" );
		$tpl = templateInit();
        $start = time() - 86400 * 290;
        $products = array();
        $data = eZContentObjectTreeNode::fetch( 2 )->dataMap();
        $zones = $data['page']->content()->attribute( 'zones' );
        $blocks = $zones[1]->attribute( 'blocks' );
        $products = $blocks[1]->attribute( 'valid_nodes' ) ;
        $tpl->setVariable( 'products', $products );
        return array( 'result' => $tpl->fetch( 'design:ajax/ultimas_novedades_manual.tpl' ) );	 	
	}
	
}

?>
