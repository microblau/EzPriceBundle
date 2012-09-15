<?php
//
// Created on: <Wed Apr 07 2010 11:48:05 GMT+0200 (CEST) carlos.revillo@tantacom.com>
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

$url = str_replace( '-', '_', $Params['Param1'] );
if( isset( $Params['Param2'] ) )
{
	$url.= '/' . str_replace( '-', '_', $Params['Param2'] );
}

if( isset( $Params['Param3'] ) )
{
	$url.= '/' . str_replace( '-', '_', $Params['Param3'] );
}

$param1 = $Params['Param1'];
$param2 = $Params['Param2'];
$param3 = $Params['Param3'];

$catalogini = eZINI::instance( 'catalog.ini' );
$paramtonodes = $catalogini->variable( 'Settings', 'ParamToNodes' );
$referernodes = $catalogini->variable( 'Settings', 'Referers' );
$texts = $catalogini->variable( 'Settings', 'Texts' );

// cache de 4 horas;
$options = array(
 'ttl' => 60*60*4,
);

if( !file_exists( 'var/cache/feeds' ) )
    eZDir::mkdir( 'var/cache/feeds' );
 
ezcCacheManager::createCache( 'feeds', 'var/cache/feeds/', 'ezcCacheStorageFilePlain', $options );
 
$cache = ezcCacheManager::getCache( 'feeds' );
$params = array( 'ClassFilterArray' => array( 'producto' ),
					 'ClassFilterType' => 'include',
					 'SortBy' => array( 'attribute', false, 356 ),
					 'MainNodeOnly' => true,
					 'Limit' => 10 ); 

if( $element = eZContentObjectTreeNode::fetchByURLPath( $url ) ) 
{
	
	$myId = 'feeds' . $element->NodeID;
	$nodeToFetch = 61;
	$name = $element->Name;
	
	if( (  $param2 == 'novedades' ) or (  $param2 == 'ofertas' ) )
	{
         if( $param3 == 'otros' )
         {
            
            $attr = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'Attr' );
   
         $filter = array( 'and' );
         foreach( $attr as $index => $value )
         {
             $filter[] = $index . ':' . $value;
         }

		 $solr = new eZSolr();
         $results = $solr->search( '',
                        array( 'SearchSubTreeArray' =>  array( 277, 66, 67, 68, 69, 70, 239, 71, 430 ),
                               'SearchLimit' => 10,
                               'SearchContentClassID' => array( 48, 98, 99, 101 ),
                               'Filter' => $filter,
                               'SortBy' => array( 'attr_fecha_aparicion_dt' => 'desc' ) ) );
        
         }  
         else
         {
         
         $attr = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'Attr' );
         $parent = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'ParentNode' );
         $classes = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'Classes' );


         $filter = array( 'and' );
         foreach( $attr as $index => $value )
         {
             $filter[] = $index . ':' . $value;
         }
   
		 $solr = new eZSolr();
         $results = $solr->search( '',
                        array( 'SearchSubTreeArray' => $parent ,
                               'SearchLimit' => 10,
                               'SearchContentClassID' => explode( ',', $classes ),
                               'Filter' => $filter,
                               'SortBy' => array( 'attr_fecha_aparicion_dt' => 'desc' ) ) );
        }


      
	}
    else
    {
        $solr = new eZSolr();
        $results = $solr->search( '',
                            array( 'SearchSubTreeArray' => array( $element->NodeID ),
                                   'SearchLimit' => 10,
                                   'SearchContentClassID' => array( 48, 98, 99, 101 ),
                                   'SortBy' => array( 'attr_fecha_aparicion_dt' => 'desc' ) ) );
  
    }
  

}
elseif ( isset( $paramtonodes[$param2] ) and ( $el = eZContentObjectTreeNode::fetch( $paramtonodes[$param2] ) ) )
{	

   
 
	$parentnodeurl = $el->urlAlias();
	$urltofetch = str_replace( '-', '_', $parentnodeurl . '/' . $param3 );

	$element = eZContentObjectTreeNode::fetchByURLPath( $urltofetch );
    $myId = 'feeds' . $param2 . ' - ' . $param3;

	
    $solr = new eZSolr();
    $results = $solr->search( '',
                        array( 'SearchSubTreeArray' => array( 61 ),
                               'SearchLimit' => 10,
                               'SearchContentClassID' => array( 48, 98, 99, 101 ),
                               'SortBy' => array( 'attr_fecha_aparicion_dt' => 'desc' ),
                               'Filter' => array( 'submeta_' . $param2 . '-id_si:'. $element->ContentObjectID ) ) );
  
}
else
{
    die( 'nooo' );
	switch ( $param2 )
	{
		case 'novedades':
		case 'ofertas':
				$nodeToFetch = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'ParentNode' );
				
				$NodeFrom = eZContentObjectTreeNode::fetch( $referernodes[$param2] );				
			
				$myId = 'feeds' . $param2 . ' - ' . $param3;				
				
				$filter = $extendedfilter = array();
				$name = $param2;
				
				if( $catalogini->hasVariable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'Filter' ) )
				{
					$value = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'Filter' );
					$days = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'Days' );
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
				
				if( $catalogini->hasVariable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'ExtendedFilter' ) )
				{
					$value = $catalogini->variable( $param2 . '_' . str_replace( '-', '_', $param3 ), 'ExtendedFilter' );
					
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
	 			$params['AttributeFilter'] = $filter;
	 			$params['ExtendedAttributefilter'] = $extendedfilter ;
				
				// formamos filtro
				
			break;
		
			default:			
			break;	
	}	
} 

if ( ( $xml = $cache->restore( $myId ) ) === false )
{	
	//$nodes = eZContentObjectTreeNode::subTreeByNodeID( $params, $nodeToFetch );
    $nodes = $results['SearchResult'];

	$feed = new ezcFeed();
	$feed->title = $name;
	$feed->description = 'Precios sin impuestos asociados';
	$feed->published = gmdate( 'D, d M Y H:i:s', time() ) .' GMT';
	$image = $feed->add( 'image' );
  	$image->link = 'http://' . $_SERVER["HTTP_HOST"];
  	$image->url = 'http://' . $_SERVER["HTTP_HOST"] . '/design/site/images/logorss.gif'; // RSS1 and RSS2 only
  	$image->title = 'Click aquí para visitar nuestra web'; // RSS1 and RSS2 only
	 
	$author = $feed->add( 'author' );
	$author->name = 'Ediciones Francis Lefebvre';
	$author->email = 'info@efl.es'; 
	 
	$link = $feed->add( 'link' );
	$link->href = 'http://www.efl.es/'; 
	 
	foreach ( $nodes as $node )
	{
		$data = $node->dataMap();
	 
	    //sacamos el título
	    $title = $data["nombre"]->content();
	 
	    //sacamos el cuerpo
	    //print_r( $data["precio"]->content() );
	    $precio = $data["precio"]->content()->Price;
	    $precio_oferta = $data["precio_oferta"]->content()->Price;    
	  
	    //creamos y añadimos el elemnto al rss
	    $item = $feed->add( 'item' ); 
	    $item->title = $title;
	    
	    $item->description = '';
	    
	    if( $data['imagen']->hasContent() )
	    {
	    	$images = $data['imagen']->content();	    	
	    	$dataimg = eZContentObject::fetch( $images['relation_browse'][0]['contentobject_id'] )->dataMap();
	    	$img = $dataimg['image']->content();	
	    		
	    	$imgAlias = $img->imageAlias( 'block_bestsell' );	
	    	    	
	    	$imgpath = $imgAlias['url'];	
	    	    	
	    	$item->description .= '<img src="http://' . $_SERVER["HTTP_HOST"]. "/" . $imgpath . '" />';
	    }
	    $item->description .= '<p>' . $data['subtitulo']->content() . '</p>
	    <p>';
	  	if( $data['precio']->content()->DiscountPercent > 0 )
	    {
	    	$item->description .= '<s>';
	    }
	    $item->description.= number_format( $precio, 2, ',', '.' );
	  	if( $data['precio']->content()->DiscountPercent > 0 )
	    {
	    	$item->description .= '</s>';
	    }
	    
		if( $data['precio']->content()->DiscountPercent > 0 )
	    {
	    	$a = $precio - $precio * (  $data["precio"]->content()->DiscountPercent / 100 );
	    	//$a = $a + $a * ( $data["precio"]->content()->VATType->Percentage / 100 ); 
	    	$item->description .= ' ' . number_format( $a, 2, ',', '.' ) ;
	    }
	    
	    $item->description .= ' € </p>';      
	 
	    $link = $item->add( 'link' );
	    $link->href = "http://" . $_SERVER["HTTP_HOST"]. "/" . $node->urlAlias(); 
	}
	$xml = $feed->generate( 'rss2' );
	//$cache->store( $myId, $xml );
}



header( 'Content-Type: text/xml; charset=utf-8' );
header( 'Content-Length: '.strlen( $xml ) );

print $xml;
eZExecution::cleanExit( );

?>
