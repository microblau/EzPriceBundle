<?php


//
// Created on: <18-Feb-2010 11:47:15 carlos.revillo@tantacom.com> 
//
// Modified on: <01-Mar-2010 18:29:00 andres.cuervo@tantacom.com>
//
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

// El módulo contará todas las búsquedas del catálogo. 
// Tomará el control cuando el nodo no exista para la url

require_once( 'kernel/common/template.php' );

$http = eZHTTPTool::instance();

$tpl = eZTemplate::factory();

$param1 = $Params['Param1'];
$param2 = $Params['Param2'];
$param3 = $Params['Param3'];


$ViewMode = 'formacion';
$LanguageCode = $Params['Language'];
$Offset = $Params['Offset'];
$Year = $Params['Year'];
$Month = $Params['Month'];
$Day = $Params['Day'];

$catalogini = eZINI::instance( 'formacion.ini' );
$paramtonodes = $catalogini->variable( 'Settings', 'ParamToNodes' );
$referernodes = $catalogini->variable( 'Settings', 'Referers' );

//nos servirá en el paginador
$tpl->setVariable( 'param1', $param1 );
$tpl->setVariable( 'param2', $param2 );
$tpl->setVariable( 'param3', $param3 );

 
if ( isset( $paramtonodes[$param2] ) and ( $node = eZContentObjectTreeNode::fetch( $paramtonodes[$param2] ) ) )
{
    $attributes = $catalogini->variable( 'Settings', 'AttributesToFilter' );
    $texts = $catalogini->variable( 'Settings', 'Texts' );
    
    $parentnodeurl = $node->urlAlias();
    $urltofetch = str_replace( '-', '_', $parentnodeurl . '/' . $param2 );
	$tpl->setVariable( 'urltofetch', $urltofetch);
    $node = eZContentObjectTreeNode::fetchByURLPath( $urltofetch );
    $NodeID = $node->NodeID;
    
    // calculamos en qué apartado estamos
    $NodeFrom = eZContentObjectTreeNode::fetch( $referernodes[$param1] );
    $tpl->setVariable( 'nodefrom', $NodeFrom );
    $tpl->setVariable( 'actualnode', $NodeID );
        
    // seteamos el atributo para el que filtrar
    $tpl->setVariable( 'attribute', $attributes[$param2] );
    
    // seteamos el texto a mostrar en resultados
    $tpl->setVariable( 'text', $texts[$param2] );
    
    // UNA VEZ SABEMOS CON QUE NODO TRABAJAMOS
    // DUPLICAMOS EL CÓDIGO DE content/view
        
        
    // Check if we should switch access mode (http/https) for this node.
    eZSSLZone::checkNodeID( 'content', 'view', $NodeID );
        
    if ( isset( $Params['UserParameters'] ) )
    {
        $UserParameters = $Params['UserParameters'];
    }
    else
    {
        $UserParameters = array();
    }
    
    if ( $Offset )
        $Offset = (int) $Offset;
    if ( $Year )
        $Year = (int) $Year;
    if ( $Month )
        $Month = (int) $Month;
    if ( $Day )
        $Day = (int) $Day;
    
    if ( $NodeID < 2 )
        $NodeID = 2;
        
    if ( !is_numeric( $Offset ) )
        $Offset = 0;
        
    $ini = eZINI::instance();
    $viewCacheEnabled = ( $ini->variable( 'ContentSettings', 'ViewCaching' ) == 'enabled' );
    
    if ( isset( $Params['ViewCache'] ) )
    {
        $viewCacheEnabled = $Params['ViewCache'];
    }
    elseif ( $viewCacheEnabled && !in_array( $ViewMode, $ini->variableArray( 'ContentSettings', 'CachedViewModes' ) ) )
    {
        $viewCacheEnabled = false;
    }
    
    if ( $viewCacheEnabled && $ini->hasVariable( 'ContentSettings', 'ViewCacheTweaks' ) )
    {
        $viewCacheTweaks = $ini->variable( 'ContentSettings', 'ViewCacheTweaks' );
        if ( isset( $viewCacheTweaks[$NodeID] ) && strpos( $viewCacheTweaks[$NodeID], 'disabled' ) !== false )
        {
            $viewCacheEnabled = false;
        }
    }
        
    $collectionAttributes = false;
    if ( isset( $Params['CollectionAttributes'] ) )
        $collectionAttributes = $Params['CollectionAttributes'];
        
    $validation = array( 'processed' => false,
                         'attributes' => array() );
    if ( isset( $Params['AttributeValidation'] ) )
        $validation = $Params['AttributeValidation'];
    
    $res = eZTemplateDesignResource::instance();
    $keys = $res->keys();
    if ( isset( $keys['layout'] ) )
        $layout = $keys['layout'];
    else
        $layout = false;
    
    $viewParameters = array( 'offset' => $Offset,
                             'year' => $Year,
                             'month' => $Month,
                             'day' => $Day,
                             'namefilter' => false );
    $viewParameters = array_merge( $viewParameters, $UserParameters );
        
    $user = eZUser::currentUser();
        
    eZDebugSetting::addTimingPoint( 'kernel-content-view', 'Operation start' );
        
    $operationResult = array();
        
    if ( eZOperationHandler::operationIsAvailable( 'content_read' ) )
    {
        $operationResult = eZOperationHandler::execute( 'content', 'read', array( 'node_id' => $NodeID,
                                                                                  'user_id' => $user->id(),
                                                                                  'language_code' => $LanguageCode ), null, true );
    }
    
    if ( ( array_key_exists(  'status', $operationResult ) && $operationResult['status'] != eZModuleOperationInfo::STATUS_CONTINUE ) )
    {
        switch( $operationResult['status'] )
        {
            case eZModuleOperationInfo::STATUS_HALTED:
            {
                if ( isset( $operationResult['redirect_url'] ) )
                {
                    $Module->redirectTo( $operationResult['redirect_url'] );
                    return;
                }
                else if ( isset( $operationResult['result'] ) )
                {
                    $result = $operationResult['result'];
                    $resultContent = false;
                    if ( is_array( $result ) )
                    {
                        if ( isset( $result['content'] ) )
                        {
                            $resultContent = $result['content'];
                        }
                        if ( isset( $result['path'] ) )
                        {
                            $Result['path'] = $result['path'];
                        }
                    }
                    else
                    {
                        $resultContent = $result;
                    }
                    $Result['content'] = $resultContent;
                }
            } break;
            case eZModuleOperationInfo::STATUS_CANCELLED:
            {
                $Result = array();
                $Result['content'] = "Content view cancelled<br/>";
            } break;
        }
        return $Result;
    }
    else
    {
        $localVars = array( "cacheFileArray", "NodeID",   "Module", "tpl",
                            "LanguageCode",   "ViewMode", "Offset", "ini",
                            "cacheFileArray", "viewParameters",  "collectionAttributes",
                            "validation" );
        if ( $viewCacheEnabled )
        {
            $user = eZUser::currentUser();
    
            $cacheFileArray = eZNodeviewfunctions::generateViewCacheFile( $user, $NodeID, $Offset, $layout, $LanguageCode, $ViewMode, $viewParameters, false );
    
            $cacheFilePath = $cacheFileArray['cache_path'];
    
            $cacheFile = eZClusterFileHandler::instance( $cacheFilePath );
            $args = compact( $localVars );
            $Result = $cacheFile->processCache( array( 'eZNodeviewfunctions', 'contentViewRetrieve' ),
                                                array( 'eZNodeviewfunctions', 'contentViewGenerate' ),
                                                null,
                                                null,
                                                $args );
            return $Result;
        }
        else
        {
            $cacheFileArray = array( 'cache_dir' => false, 'cache_path' => false );
            $args = compact( $localVars );
            $data = eZNodeviewfunctions::contentViewGenerate( false, $args ); // the false parameter will disable generation of the 'binarydata' entry
            return $data['content']; // Return the $Result array
        }
    }   
}
else
{
    switch ( $param1 )
    {
        case 'novedades':
        case 'ofertas':
                $NodeFrom = eZContentObjectTreeNode::fetch( $referernodes[$param1] );               
                $tpl->setVariable( 'nodefrom', $NodeFrom );
                $NodeID = $NodeFrom->NodeID;
                
                $tpl->setVariable( 'parentnode', $catalogini->variable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'ParentNode' ) );
                
                $filter = $extendedfilter = array();
                
                if( $catalogini->hasVariable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'Filter' ) )
                {
                    $value = $catalogini->variable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'Filter' );
                    $days = $catalogini->variable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'Days' );
                    $items = array();
                    if ( is_array( $value ) )
                    {
                        foreach( $value as $el )
                        {
                            $el = explode( ';', $el );
                                            
                            if( count($el) > 1 )
                            {
                                $el[2] = str_replace( '<currentdate>', time(), $el[2] );
                                if( strpos( $el[2], ',' ) != false )
                                {
                                    $el[2] = explode( ',', $el[2] );    
                                    if( $days < 0 )
                                        $el[2][0] = (int)$el[2][0] + $days * 86400;
                                    else
                                        $el[2][1] = (int)$el[2][1] + $days * 86400;
                                }                               
                                $items[] = $el;
                            }
                            else
                            {
                                $items[] = $el[0];
                            }                               
                        }
                        
                        $filter = $items ;                  
                    }
                    else
                    {
                        $aux = explode( ';', $value );
                        $aux[2] = str_replace( '<currentdate>', time(), $aux[2] );                  
                        if( strpos( $aux[2], ',' ) != false )
                        {
                            $aux[2] = explode( ',', $aux[2] );  
                            if( $days < 0 )
                                $aux[2][0] = (int)$aux[2][0] + $days * 86400;
                            else
                                $aux[2][1] = (int)$aux[2][1] + $days * 86400;                   
                        }
                        $filter[] = $aux;
                    }
                }
                
                if( $catalogini->hasVariable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'ExtendedFilter' ) )
                {
                    $value = $catalogini->variable( $param1 . '_' . str_replace( '-', '_', $param2 ), 'ExtendedFilter' );
                    
                    foreach( $value as $index => $el )
                    {                       
                        if( strpos( $el, ';' ) != false )
                        {
                            $el = explode( ';', $el );
                            
                            if( $index != 'params')
                                $extendedfilter['params'][$index] = $el;
                            else                            
                            {
                                if( strpos( $el[1], '%' ) != false )
                                {
                                    
                                    $el[1] = explode( '%', $el[1] );
                                }
                                $extendedfilter['params'] = $el;
                            }
                        }
                        else
                        {
                            $extendedfilter[$index] = $el;      
                        }                       
                    }                   
                }               
                $tpl->setVariable( 'filter', $filter );
                $tpl->setVariable( 'extendedfilter', $extendedfilter );
                $Result['content'] = $tpl->fetch( 'design:catalog/list.tpl' );              

                // formamos filtro
                
            break;
        
            default:
            $moduleResult = $Params['Module']->handleError( eZError::KERNEL_NOT_FOUND, 'kernel' );  
            $Result['content'] = $moduleResult['content'];
            return;
            break;  
    }   
}
    

?>