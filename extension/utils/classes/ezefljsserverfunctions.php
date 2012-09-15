<?php 
//
// Definition of ezsrServerFunctions class
//
// Created on: <15-Mar-2010 13:00:00 carlos.revillo@tantacom.com>
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
 * De esta forma no es necesario incluir js en sitios donde no se haga uso de ellos
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class ezEflJsServerFunctions extends ezjscServerFunctions
{
	/**
	 * Devuelve el código necesario para poder 
	 * hacer submit del formulario quiero ver
	 * segun los cambios en los select
	 * 
	 * @param array $args
	 * @return string
	 */
    function catalogohome( $args )
    {       
        $output = ' (function($) {
                jQuery(document).ready(function() { 
               
                $("#quieroVer").change(function() {
               
                    $(this).parent().submit();
                } );
                })
        })(jQuery)';        
        return $output;
    }   
}