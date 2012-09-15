<?php
//
// Definition of tantaStatsFunctionCollection class
//
// Created on: <22-Feb-2010 15:38:21 carlos.revillo@tantacom.com>
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

/**
 * Clase para sacar estadísticas según las necesidades de EFL
 * Parte de funciones del modulo shop y del modulo content (topviewlist)
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */

class tantaStatsFunctionCollection
{
    /**
     * Constructor. No hace nada en especial
     * 
     */
    function tantaStatsFunctionCollection()
    {
    }
  	
    /**
     * Devuelve los productos más vendidos según los criterios especificados
     * 
     * @static 
     * @param int $classID
     * @param int $sectionID
     * @param array $attribute_filter
     * @param array $extended_attribute_filter
     * @param int $offset
     * @param int $limit
     * @return array
     */
    static public function fetchMostViewedTopList( $classID, $sectionID, $attribute_filter, $extended_attribute_filter, $offset, $limit )
    {
    	$topList = self::fetchTopList( $classID, $sectionID, $attribute_filter, $extended_attribute_filter, $offset, $limit );
        $contentNodeList = array();
        foreach ( array_keys ( $topList ) as $key )
        {
            $nodeID = $topList[$key]['node_id'];
            $contentNode = eZContentObjectTreeNode::fetch( $nodeID );
            if ( $contentNode === null )
                return array( 'error' => array( 'error_type' => 'kernel',
                                            'error_code' => eZError::KERNEL_NOT_FOUND ) );
            $contentNodeList[] = $contentNode;
        }
        return array( 'result' => $contentNodeList );
    }
    
    
    /**
     * Devuelve los productos más vistos según los criterios especificados
     * 
     * @static
     * @param int|bool $classID id de la clase a consultar. falso si queremos todasi
     * @param int|bool $sectionID id de la sección a consultar. falso si queeremos todas. 
     * @param array $attribute_filter
     * @param array $extended_attribute_filter
     * @param int $offset
     * @param int $limit
     * @return array
     */
    static function fetchTopList( $classID = false, $sectionID = false, $attribute_filter = false, $extended_attribute_filter = false, $offset = false, $limit = false )
    {
        if ( !$classID && !$sectionID )
        {

            return  eZPersistentObject::fetchObjectList( eZViewCounter::definition(),
                                                         null,
                                                         null,
                                                         null,
                                                         array( 'length' => $limit, 'offset' => $offset ),
                                                         false );
        }

        $queryPart = "";
        if ( $classID != false )
        {
            $classID = (int)$classID;
            $queryPart .= "ezcontentobject.contentclass_id=$classID AND ";
        }

        if ( $sectionID != false )
        {
            $sectionID = (int)$sectionID;
            $queryPart .= "ezcontentobject.section_id=$sectionID AND ";
        }
        
        if( $attribute_filter != false )
        {        	
        	$attributeFilterParam = isset( $attribute_filter ) ? $attribute_filter : false;               
        	$attributeFilter = eZContentObjectTreeNode::createAttributeFilterSQLStrings( $attributeFilterParam );
        	
        	if ( $attributeFilter === false )
        	{
            	return null;
        	}
        	if( $attributeFilter[from] != '' )
        	{
	        	$attributeFilter[from] = ', ezcontentobject_name ' . $attributeFilter[from];
	        	$attributeFilter[where] = ' ezcontentobject_tree.contentobject_version = ezcontentobject_name.content_version AND
											ezcontentobject_name.name = ezcontentobject.name AND			
	        	' . $attributeFilter[where];	        	
        	}
        }
        
        if ( $extended_attribute_filter != false )
        	$extendedAttributeFilter = eZContentObjectTreeNode::createExtendedAttributeFilterSQLStrings( $extended_attribute_filter );
		

        $db = eZDB::instance();
        $query = "SELECT ezview_counter.*
                  FROM
                         ezcontentobject_tree,
                         ezcontentobject,
                         ezview_counter
                         $attributeFilter[from]
                         $extendedAttributeFilter[tables]
                  WHERE  $extendedAttributeFilter[joins]
                  		 $attributeFilter[where]     
                         ezview_counter.node_id=ezcontentobject_tree.node_id AND
                         $queryPart
                         ezcontentobject_tree.contentobject_id=ezcontentobject.id AND ezcontentobject_tree.is_hidden = 0
                  ORDER BY ezview_counter.count DESC";

        if ( !$offset && !$limit )
        {
            $countListArray = $db->arrayQuery( $query );
        }
        else
        {
            $countListArray = $db->arrayQuery( $query, array( "offset" => $offset,
                                                               "limit" => $limit ) );
        }
        return $countListArray;
    }
}
