<?php

/**
 * Workflow que actualiza los hijos de un producto
 * 
 * @author carlos.revillo@tantacom.com
 *
 */
class seoType extends eZWorkflowEventType
{
	const WORKFLOW_TYPE_STRING = "seo";
	
	function seoType()
    {
        $this->eZWorkflowEventType( seoType::WORKFLOW_TYPE_STRING, 'Actualización de hijos de Productos' );
        $this->setTriggerTypes( array( 'content' => array( 'publish' => array( 'after' ) ) ) );
    }
    
    static function createElement( $class, $parent_node_id, $nombre )
    {
        $params = array();
        $params['parent_node_id'] = $parent_node_id;
        $params['class_identifier'] = $class;
        $params['creator_id'] = eZUser::currentUser()->id();
        $attributes = array();
        $attributes['nombre'] = $nombre;
        $params['attributes'] = $attributes;
        eZContentFunctions::createAndPublishObject( $params );
    }

    static function deleteElement( $node_id )
    {
        eZContentObjectTreeNode::removeSubtrees( array( $node_id ), false );
    }

    static function checkNeedToCreate( $node_id, $class )
    {
        $query = eZContentObjectTreeNode::subTreeByNodeId( 
                                                array( 'ClassFilterType' => 'include',
                                                       'ClassFilterArray' => array( $class ) )
    ,$node_id );
        return count( $query ) == 0;
    }

    static function checkNeedToDelete( $node_id, $class )
    {
        $query = eZContentObjectTreeNode::subTreeByNodeId( 
                                                array( 'ClassFilterType' => 'include',
                                                       'ClassFilterArray' => array( $class ) )
    ,$node_id );

        
        return ( count( $query ) > 0 ) ? $query[0]->attribute( 'node_id' ) : false;
    }

    function execute( $process, $event )
    {
        $db = eZDB::instance();
    	$parameters = $process->attribute( 'parameter_list' );    	
    	
    	$objectID = $parameters['object_id'];
    	$version = $parameters['version'];
        $object = eZContentObject::fetch( $objectID ); 
        $data =  $object->dataMap();
      
        $nodes = $object->attribute( 'assigned_nodes' );
        $node = $nodes[0];
        if( !$node->attribute( 'is_main' ) )
        {
            $node = $object->attribute( 'main_node' );
        }


 
	if( ($object->attribute( 'contentclass_id' ) == 48) or ($object->attribute( 'contentclass_id' ) == 99) ){

    if( $data['ventajas'] and $data['ventajas']->hasContent() )
	{
		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'ventajas_producto' );
        if( $needToCreate )
            self::createElement( 'ventajas_producto', $node->attribute( 'node_id' ), 'Ventajas' );		
	}
    else
    {
       
        $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'ventajas_producto' );
   
        if( $needToDelete );
            self::deleteElement( $needToDelete );
    }
        
     
	
    if( $data['sumario'] and $data['sumario']->hasContent() )
	{
		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'sumario_producto' );
        if( $needToCreate )
            self::createElement( 'sumario_producto', $node->attribute( 'node_id' ), 'Sumario' );
	}
    else
    {
       $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'sumario_producto' );
        if( $needToDelete );
            self::deleteElement( $needToDelete ); 
    }
    if( $data['contenido'] and $data['contenido']->hasContent() )
	{
        if( $node->attribute( 'parent_node_id' ) == 70 )
        {
            $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'bases_producto' );
            if( $needToCreate )
            {
                self::createElement( 'bases_producto', $node->attribute( 'node_id' ), 'Contenido base jurídica' );
            }
        }
        else
        {
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'condiciones_producto' );
        if( $needToCreate )
        {
            if( $node->attribute( 'parent_node_id' ) == 1485 )
            {
                self::createElement( 'condiciones_producto', $node->attribute( 'node_id' ), 'Contenido' );
            }
            else
            {
                
                self::createElement( 'condiciones_producto', $node->attribute( 'node_id' ), 'Condiciones' );
            }
        }
        }
	}    
    
    if( ( $data['condiciones'] and $data['condiciones']->hasContent() ) or ( $data['contenido'] and $data['contenido']->hasContent() ) )
	{
		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'condiciones_producto' );
        if( $needToCreate )
            self::createElement( 'condiciones_producto', $node->attribute( 'node_id' ), 'Condiciones' );
	}
    else
    {
       $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'condiciones_producto' );
        if( $needToDelete );
            self::deleteElement( $needToDelete ); 
    }
    
    if( $data['novedades'] and $data['novedades']->hasContent() )
	{
		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'novedades_producto' );
        if( $needToCreate )
            self::createElement( 'novedades_producto', $node->attribute( 'node_id' ), 'Novedades' );
	}

    if( $data['novedades'] and $data['novedades']->hasContent() and ( $node->attribute( 'parent_node_id' ) == 66 ) )
	{
		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'noticias_producto' );
        if( $needToCreate )
            self::createElement( 'noticias_producto', $node->attribute( 'node_id' ), 'Últimas noticias' );
	}

    if( $data['actualizaciones'] and $data['actualizaciones']->hasContent() )
	{		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'actualizaciones_producto' );
        if( $needToCreate )
            self::createElement( 'actualizaciones_producto', $node->attribute( 'node_id' ), 'Actualizaciones' );
	}
    else
    {
       $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'actualizaciones_producto' );
        if( $needToDelete );
            self::deleteElement( $needToDelete ); 
    }
    
  /*  $testimonios = eZContentObjectTreeNode::subTreeByNodeID( array( 'ClassFilterType' => 'include',
                                                                    'ClassFilterArray' => array( 'testimonio' ) ), $node->attribute( 'node_id' ) );
    if( count( $testimonios ) )
	{	
       
       
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'testimonios_producto' );
        if( $needToCreate )
            self::createElement( 'testimonios_producto', $node->attribute( 'node_id' ), 'Testimonios' );
  
	}*/

    $query = $db->arrayQuery( "SELECT * from valoraciones_productos where node_producto=". $node->attribute( 'node_id' ). " and visible=1 " );

    if( count( $query ) )
	{	
       
       
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'opiniones_clientes' );
        if( $needToCreate )
            self::createElement( 'opiniones_clientes', $node->attribute( 'node_id' ), 'Opiniones de los clientes' );

          $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'valoraciones_producto' );
        if( $needToCreate )
            self::createElement( 'valoraciones_producto', $node->attribute( 'node_id' ), 'Valoraciones' );
  
	}

     else
    {
       $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'opiniones_clientes' );
        if( $needToDelete );
            self::deleteElement( $needToDelete ); 
        $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'valoraciones_producto' );
        if( $needToDelete );
            self::deleteElement( $needToDelete ); 
    }

    
    

    if( $data['faqs_producto'] and $data['faqs_producto']->hasContent() )
	{		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'faqs_producto' );
        if( $needToCreate )
            self::createElement( 'faqs_producto', $node->attribute( 'node_id' ), 'Faqs producto' );
	}

     else
    {
       $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'faqs_producto' );
        if( $needToDelete );
            self::deleteElement( $needToDelete ); 
    }

    if( $data['notas_relacionadas'] and $data['notas_relacionadas']->hasContent() )
	{
		
        $needToCreate = self::checkNeedToCreate( $node->attribute( 'node_id' ), 'notas_relacionadas_producto' );
        if( $needToCreate )
            self::createElement( 'notas_relacionadas_producto', $node->attribute( 'node_id' ), 'Últimas noticias' );
       
	}

     else
    {
       $needToDelete = self::checkNeedToDelete( $node->attribute( 'node_id' ), 'notas_relacionadas_producto' );
        if( $needToDelete );
            self::deleteElement( $needToDelete ); 
    }
		
	
		
	}

    // vaciar cache de objeto y de sus hijos
    $children = eZContentObjectTreeNode::subTreeByNodeID( array( 'AsObject' => false ), $node->attribute( 'node_id' ) );
    $childrennodesarray = array();
    foreach( $children as $child )
    {
        $childrennodesarray[] = $child['node_id'];
    }
    eZContentCacheManager::clearObjectViewCache( $objectID, true, $childrennodesarray );

    	
    	return eZWorkflowType::STATUS_ACCEPTED;
    }
}

eZWorkflowEventType::registerEventType( seoType::WORKFLOW_TYPE_STRING, "seoType" );
