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
 * Clase para generar css especificos según necesidades de EFL
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class ezEflCssServerFunctions extends ezjscServerFunctions
{
    /**
     * Devuelve definición de css para decorar las pestañas
     * según los criterios escogidos en el administrador
     * 
     * @param array $args
     * @return string
     */
    function tabscss( $args )
    {    	
        $els = eZContentObjectTreeNode::subTreeByNodeId( array(
                                                            'SortBy' => array( 'priority', true ),
                                                            'ClassFilterType' => 'include',
                                                            'ClassFilterArray' => array( 'canal_rss' )
                                                           ), 554 );                                    
        $output = '';
        foreach( $els as $index => $el )
        {
            $data = $el->dataMap();
            $relatedAreaData = $data['area']->content()->dataMap();
            $output.='#categoriesTabs .cat' . (string)($index + 1) . '{background-color:#'. $relatedAreaData['color_fondo_pestana']->content() .';}' . "\n";
            $output.='#categoriesTabs .cat' . (string)($index + 1) . ' a{color:#'. $relatedAreaData['color_texto_pestana']->content() .';}' . "\n";
            $output.='#categoriesTabs .cat' . (string)($index + 1) . '.sel{background-color:#fff;}' . "\n";            
        }
    	
    	return $output;
    }   
}