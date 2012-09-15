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

class ezEflPortadasServerFunctions extends ezjscServerFunctions
{
	/**
	 * Devuelve el resultado para el bloque en cuestión. 
	 * Se encargará de devolver los nuevos links y los elementos
	 * visibles en ese bloque.
	 * 
	 * @param unknown_type $args
	 * @return array
	 */
	static function bloque( $args )
	{
		include_once( "kernel/common/template.php" );
		$tpl = templateInit();
				
		if ( isset( $args[3] ) )
		{
			$urlprev = 'ezjscore/call/portadas::bloque::' . $args[0] . '::' .  (string)( $args[1] - $args[2] ) . '::' . $args[2]  . '::' . $args[3] ;
			$urlnext = 'ezjscore/call/portadas::bloque::' . $args[0] . '::' .  (string)( $args[1] + $args[2] ) . '::' . $args[2]  . '::' . $args[3] ;
            eZURI::transformURI( $urlnext );
            eZURI::transformURI( $urlprev );
			$elements = customEZFlowPool::getElementsForBlock( $args[0], $args[3], $args[1], $args[2] );
			$tpl->setVariable( 'products', $elements );
			$results = $tpl->fetch( 'design:ajax/bloquescatalogo.tpl' );
			
			$total = customEZFlowPool::getTotalElementsForBlock( $args[0], $args[3], $args[2] );
	
			if( $args[1] == 0 )
			{								
				$links = '<span class="prev reset">anterior</span><a class="next" href='. $urlnext . '>siguiente</a>';
			}
			elseif( ( ( $args[1] + $args[2] ) / 2 ) >= $total )
			{
				$links = '<a class="prev" href="' . $urlprev . '">anterior</a><span class="next reset">siguiente</span>';
			}
			else
			{
				
				$links = '<a class="prev" href="' . $urlprev . '">anterior</a><a class="next" href='. $urlnext . '>siguiente</a>';
			}
			//print_r( array( "results" => $results, "links" => $links ) );
			return array( 'results' => $results, 
						  'links' => $links,
                          'block_id' => $args[0],
			              'pos' => $args[3],
			              'pag' => ( $args[1] + $args[2] ) / 2
			) ;			
		}
		else
		{
			$urlprev = 'ezjscore/call/portadas::bloque::' . $args[0] . '::' .  (string)( $args[1] - $args[2] ) . '::' . $args[2];
            $urlnext = 'ezjscore/call/portadas::bloque::' . $args[0] . '::' .  (string)( $args[1] + $args[2] ) . '::' . $args[2];
            eZURI::transformURI( $urlnext );
            eZURI::transformURI( $urlprev );
            $elements = customEZFlowPool::getElementsForBlock( $args[0], null, $args[1], $args[2] );
            $tpl->setVariable( 'products', $elements );
            $results = $tpl->fetch( 'design:ajax/bloquescatalogo.tpl' );
            
            $total = customEZFlowPool::getTotalElementsForBlock( $args[0], null, $args[2] );
            if( $args[1] == 0 )
            {                               
                $links = '<span class="prev reset">anterior</span><a class="next" href='. $urlnext . '>siguiente</a>';
            }
            elseif( ( ( $args[1] + $args[2] ) / $args[2] ) >= $total )
            {
                $links = '<a class="prev" href="' . $urlprev . '">anterior</a><span class="next reset">siguiente</span>';
            }
            else
            {
                
                $links = '<a class="prev" href="' . $urlprev . '">anterior</a><a class="next" href='. $urlnext . '>siguiente</a>';
            }
            //print_r( array( "results" => $results, "links" => $links ) );
            return array( 'results' => $results, 
                          'links' => $links,
                          'block_id' => $args[0],                       
                          'pag' => ( $args[1] + $args[2] ) / $args[2]
            ); 
		}
		
		
	}
	
	/**
	 * Devuelve los resultados para las peticiones del bloque 
	 * con los rss según las categorías
	 * 
	 * @static
	 * @param array $args
	 * @return array
	 */
	static function mementum( $args )
	{
		include_once( "kernel/common/template.php" );
        $tpl = templateInit();
		$items = eZContentObjectTreeNode::subTreeByNodeId(
		                                  array( 'SortBy' => array( 'published', false ), 
		                                         'Limit' => 5
		                                  )
		                                  
		                                  , $args[0] );
		$tpl->setVariable( 'items', $items );
		$results = $tpl->fetch( 'design:ajax/actummementum.tpl' );
		return array( array( 'contenido' => array( 'cont' => $results ) ) );
	}
	
	/**
	 * Devuelve los resultados para las peticiones del bloque 
	 * con los rss del apartado formación
	 * 
	 * @static
	 * @param array $args
	 * @return array
	 */
    static function formacion( $args )
    {
    	include_once( "kernel/common/template.php" );
        $tpl = templateInit();
        $attr = eZContentObjectAttribute::fetch( $args[1], $args[2] );
        $block = eZPageBlock::fetch( $args[0] );
        $els = simplexml_load_string( $attr->attribute( 'data_text' ) );

        $find =  $els->xpath( '///block[@id="id_'. $args[0] .'"]/custom_attributes');
      
               
        $tpl->setVariable( 'block', eZPageBlock::fetch( $args[0] ) );
        
        $tpl->setVariable( 'att1', $find[0]->titulo_pestana );
        $tpl->setVariable( 'att2', (string)$find[0]->titulo_bloque );
        $tpl->setVariable( 'att3', (string)$find[0]->texto_enlace );
        $tpl->setVariable( 'att4', (string)$find[0]->enlace );
        $results = $tpl->fetch( 'design:ajax/formacion.tpl' );
        return array( array( 'contenido' => array( 'cont' => $results ) ) );
    }
    
    /**
	 * Devuelve los resultados para las peticiones del bloque 
	 * con los rss del apartado promociones primarias
	 * 
	 * @static
	 * @param array $args
	 * @return array
	 */
    static function promos( $args )
    {
    	include_once( "kernel/common/template.php" );
        $tpl = templateInit();
        $node = eZContentObjectTreeNode::fetch( $args[0] );
        $data = $node->dataMap();
        $tpl->setVariable( 'node', $node );
        if( $args[1] and $args[1] == 2 ) 
            $results = $tpl->fetch( 'design:ajax/promoprimaria_new.tpl' );
        else
            $results = $tpl->fetch( 'design:ajax/promoprimaria.tpl' );
        return array( array( 'contenido' => array( 'cont' => $results, 'title' => $data['subtitulo']->content() ) ) );
        
    }
}
?>
