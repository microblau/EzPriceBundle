<?php
//
// Created on: <16-Mar-2010 15:45:15 carlos.revillo@tantacom.com>
//
// SOFTWARE NAME: eZ Publish
// SOFTWARE RELEASE: 4.2.0
// BUILD VERSION: 24182
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
require( 'kernel/common/template.php' );
$tpl = eZTemplate::factory();

$http = eZHTTPTool::instance();

$parameters = array( 'and' );

$filters = array();
$filters[] =  $http->hasPostVariable( 'quienEres' ) ? $http->postVariable( 'quienEres') : 0;
$filters[] =  $http->hasPostVariable( 'area' ) ? $http->postVariable( 'area') : 0;
$filters[] =  $http->hasPostVariable( 'formato' ) ? $http->postVariable( 'formato') : 0;

$parameters[] = array( 396, 769, 811, 883 );
$parameters[] = $http->postVariable( 'quienEres' );

$solr = new eZSolr();
$results = $solr->search( '', 
                         array( 'SearchSubTreeArray' => array( 61 ),
                                'SearchContentClassID' => array( 48, 98, 99, 101 ),
                                'SortBy' => array( 'attr_fecha_aparicion_dt' => 'desc' ),
                                'Filter' => array( 'and', 
                                                   'submeta_formato-id_si:162',
                                                   'submeta_formato-id_si:162',
                                                   'submeta_area-id_si:190' )

                         ) );
                                

print_r( $results );
//eZExecution::cleanExit();

?>
