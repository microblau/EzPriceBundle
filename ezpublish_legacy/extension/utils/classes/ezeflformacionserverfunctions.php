<?php
//
// Definition of ezsrServerFunctions class
//
// Created on: <13-Abril-2010 13:07:00 andres.cuervo@tantacom.com>
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
 * Clase para rellenar combos en destacados de formacion
 *
 *
 */

class ezEflFormacionServerFunctions extends ezjscServerFunctions
{
    /**
     * Devuelve el codigo html necesario para construir el combo
     * de aras segun el tipo seleccionado (enviado por parametro)
     *
     * @author andres.cuervo@tantacom.com
     * @version 1.0
     * @package efl
     */

    static function comboArea($args)
    {
        if ( isset ($args[0]))
        {
            include_once ("kernel/common/template.php");
            $tpl = eZTemplate::factory();
            if ($args[0] != "-1")
            {
                $node = eZContentObjectTreeNode::fetch($args[0]);
                $data = $node->dataMap();
                $tpl->setVariable('avernode', $node);
                $results = $tpl->fetch('design:ajax/comboArea.tpl');
                return $results;
                //return array( array( 'contenido' => array( 'cont' => $results, 'title' => $data['subtitulo']->content() ) ) );
            } else
            {

                $results = $tpl->fetch('design:ajax/comboArea.tpl');
                return $results;
            }
        }

    }

}
?>
