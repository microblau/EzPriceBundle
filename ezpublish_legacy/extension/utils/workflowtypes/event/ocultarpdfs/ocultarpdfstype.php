<?php

/**
 * Este workflow ocultará los pdfs asociados a los productos que se oculten 
 * en el administrador. De esta forma no saldrán en la búsqueda 
 *
 * De igual forma, los volverá a enseñar si la acción es mostrar el producto. 
 *
 * @author victor.aranda@tantacom.com
 *
 */
class ocultarpdfsType extends eZWorkflowEventType
{
	const WORKFLOW_TYPE_STRING = "ocultarpdfs";
	
	function ocultarpdfsType()
    {
        $this->eZWorkflowEventType( ocultarpdfsType::WORKFLOW_TYPE_STRING, 'Ocultar PDFS' );
        $this->setTriggerTypes( array( 'content' => array( 'hide' => array( 'after' ) ) ) );
    }
    
    function execute( $process, $event )
    {
	
        $parameters = $process->attribute( 'parameter_list' );
       	$node_id = $parameters['node_id'];
        $node = eZContentObjectTreeNode::fetch( $node_id );
        $relateds = eZContentObjectTreeNode::fetch( $node_id )->attribute( 'object' )->relatedContentObjectList( false, false, 0, false, array( 'AllRelations' => true ) );
        foreach ( $relateds as $related )
        {
            
            
            if ( $related->attribute( 'contentclass_id' ) == 28 )
            {
                
                $action = 'hide';

                $curNode = $related->attribute( 'main_node' );
               
                if ( is_object( $curNode ) )
                {
                    
                    if ( $node->attribute( 'is_hidden' ) )
                    {
                        eZContentObjectTreeNode::hideSubTree( $curNode );
                        $action = 'show';
                    }
                    else
                        eZContentObjectTreeNode::unhideSubTree( $curNode );
                }

                //call appropriate method from search engine
                eZSearch::updateNodeVisibility( $related->attribute( 'main_node' )->attribute( 'node_id' ), $action );  
            }      
           
        }
    
    	return eZWorkflowType::STATUS_ACCEPTED;
    }
}

eZWorkflowEventType::registerEventType( ocultarpdfsType::WORKFLOW_TYPE_STRING, "ocultarpdfsType" );
