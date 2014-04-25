<?php

/**
 * Workflow que actualiza la categoría del producto antes de su publicacion final
 * 
 * @author victor.aranda@tantacom.com
 *
 */
class setcategoriaType extends eZWorkflowEventType
{
	const WORKFLOW_TYPE_STRING = "setcategoria";
	
	function setcategoriaType()
    {
        $this->eZWorkflowEventType( setcategoriaType::WORKFLOW_TYPE_STRING, 'Actualización de Categoria de Productos' );
        $this->setTriggerTypes( array( 'content' => array( 'publish' => array( 'after' ) ) ) );
    }
    
    function execute( $process, $event )
    {
    	$parameters = $process->attribute( 'parameter_list' );    	
    	
    	$objectID = $parameters['object_id'];
    	$version = $parameters['version'];
        $object = eZContentObject::fetch( $objectID );     

	if( ($object->attribute( 'contentclass_id' ) == 48) || ($object->attribute( 'contentclass_id' ) == 28)){

		
		
		$ParentNodeID = $object->attribute( 'main_node' )->attribute( 'parent' )->NodeID;
		$object_padre = eZContentObject::fetchByNodeID( $ParentNodeID ); 
		$estados = $object_padre->stateIDArray();
		eZContentOperationCollection::updateObjectState(  $object->attribute( 'id' ), array( $estados['3'] ) );
		
	}
    	
    	return eZWorkflowType::STATUS_ACCEPTED;
    }
}

eZWorkflowEventType::registerEventType( setcategoriaType::WORKFLOW_TYPE_STRING, "setcategoriaType" );
