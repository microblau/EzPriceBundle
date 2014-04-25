<?php 
/**
 * Obtención de datos de nuestro tipo de datos customezpage
 * necesario para uno de los módulos específicos de las homes
 * de EFL
 * 
 * @author carlos.revillo@tantacom.com
 * @version 1.0
 * @package efl
 *
 */
class customEZFlowPool
{
    /**
     * Return waiting items for block with given $blockID
     * 
     * @static
     * @param string $blockID
     * @return array
     */
    static function waitingItems( $blockID )
    {
        $db = eZDB::instance();
        $queue = $db->arrayQuery( "SELECT *
                                   FROM ezm_pool, ezm_pool_efl
                                   WHERE ezm_pool.block_id='$blockID'
                                     AND ts_visible=0
                                     AND ts_hidden=0
                                     AND ezm_pool.block_id = ezm_pool_efl.block_id
                                     AND ezm_pool.object_id = ezm_pool_efl.object_id
                                   ORDER BY ts_publication ASC, priority ASC" );
        return $queue;
    }

    /**
     * Return valid items for block with given $blockID
     * 
     * @static
     * @param string $blockID
     * @return array
     */
    static function validItems( $blockID )
    {
        $db = eZDB::instance();
        $valid = $db->arrayQuery( "SELECT *
                                   FROM ezm_pool, ezm_pool_efl
                                   WHERE ezm_pool.block_id='$blockID'
                                     AND ts_visible>0
                                     AND ts_hidden=0
                                     AND ezm_pool.block_id = ezm_pool_efl.block_id
                                     AND ezm_pool.object_id = ezm_pool_efl.object_id
                                     AND ezm_pool.node_id = ezm_pool_efl.node_id
                                   ORDER BY priority DESC" );
        return $valid;
    }

    /**
     * Return valid items for block with given $blockID
     * 
     * @static
     * @param string $blockID
     * @param bool $asObject
     * @return array(eZContentObjectTreeNode)
     */
    static function validNodes( $blockID, $asObject = true )
    {
        if ( isset( $GLOBALS['eZFlowPool'] ) === false )
            $GLOBALS['eZFlowPool'] = array();

        if ( isset( $GLOBALS['eZFlowPool'][$blockID] ) )
            return $GLOBALS['eZFlowPool'][$blockID];

        $db = eZDB::instance();
        $validNodes = $db->arrayQuery( "SELECT *
                                        FROM ezm_pool, ezcontentobject_tree, ezm_pool_efl
                                        WHERE ezm_pool.block_id='$blockID'
                                          AND ezm_pool.ts_visible>0
                                          AND ezm_pool.ts_hidden=0
                                          AND ezcontentobject_tree.node_id = ezm_pool.node_id
                                          AND ezm_pool.block_id = ezm_pool_efl.block_id
                                   		  AND ezm_pool.object_id = ezm_pool_efl.object_id
                                     	  AND ezm_pool.node_id = ezm_pool_efl.node_id
                                        ORDER BY ezm_pool_efl.pos, ezm_pool.priority DESC" );
		
        if ( $asObject && count( $validNodes ) > 0 )
        {
            $validNodesObjects = array();

            foreach( $validNodes as $node )
            {
                $nodeID = $node['node_id'];
                $validNodesObjects[] = eZContentObjectTreeNode::fetch( $nodeID );
            }

            $GLOBALS['eZFlowPool'][$blockID] = $validNodesObjects;			
            return $validNodesObjects;
        }
        else
        {
            return $validNodes;
        }
    }

    /**
     * Return archived items for block with given $blockID
     * 
     * @static
     * @param string $blockID
     * @return array
     */
    static function archivedItems( $blockID )
    {
        $db = eZDB::instance();
        $archived = $db->arrayQuery( "SELECT *
                                      FROM ezm_pool
                                      WHERE block_id='$blockID'
                                        AND ts_hidden>0
                                      ORDER BY ts_hidden ASC" );
        return $archived;
    }
    
    static function getElementsForBlock( $block_id, $pos, $offset, $limit )
    {
        
    	if( $pos != null )
    	{
    	   $db = eZDB::instance();
    	
    	   $elements = $db->arrayQuery( "SELECT *
                                        FROM ezm_pool, ezcontentobject_tree, ezm_pool_efl
                                        WHERE ezm_pool.block_id='$block_id'
                                          AND ezm_pool.ts_visible>0
                                          AND ezm_pool.ts_hidden=0
                                          AND ezcontentobject_tree.node_id = ezm_pool.node_id
                                          AND ezm_pool.block_id = ezm_pool_efl.block_id
                                   		  AND ezm_pool.object_id = ezm_pool_efl.object_id
                                     	  AND ezm_pool.node_id = ezm_pool_efl.node_id
                                     	  AND pos = $pos
                                          ORDER BY ezm_pool.priority DESC 
                                          LIMIT $offset, $limit");	
    
    	   return  $elements;
    	}
    	else
    	{
    		$db = eZDB::instance();
        
           $elements = $db->arrayQuery( "SELECT *
                                        FROM ezm_pool, ezcontentobject_tree
                                         WHERE ezm_pool.block_id='$block_id'
                                          AND ezm_pool.ts_visible>0
                                          AND ezm_pool.ts_hidden=0
                                          AND ezcontentobject_tree.node_id = ezm_pool.node_id
                                         
                                          
                                        
                                          ORDER BY ezm_pool.priority DESC 
                                          LIMIT $offset, $limit");  
       
           return  $elements;
    	}
    }
    
	static function getTotalElementsForBlock( $block_id, $pos, $items_per_block )
    {
    	if( $pos != null )
    	{
	    	$db = eZDB::instance();
	    	$count = $db->arrayQuery( "SELECT COUNT(*) AS total
	                                        FROM ezm_pool, ezcontentobject_tree, ezm_pool_efl
	                                        WHERE ezm_pool.block_id='$block_id'
	                                          AND ezm_pool.ts_visible>0
	                                          AND ezm_pool.ts_hidden=0
	                                          AND ezcontentobject_tree.node_id = ezm_pool.node_id
	                                          AND ezm_pool.block_id = ezm_pool_efl.block_id
	                                   		  AND ezm_pool.object_id = ezm_pool_efl.object_id
	                                     	  AND ezm_pool.node_id = ezm_pool_efl.node_id
	                                     	  AND pos = $pos                                          
	                                          ");	
	    	return ceil( $count[0]['total'] / $items_per_block );
    	}
    	else
    	{
    		$db = eZDB::instance();
    		$count = $db->arrayQuery( "SELECT COUNT(*) AS total
                                        FROM ezm_pool, ezcontentobject_tree
                                        WHERE ezm_pool.block_id='$block_id'
                                          AND ezm_pool.ts_visible>0
                                          AND ezm_pool.ts_hidden=0
                                          AND ezcontentobject_tree.node_id = ezm_pool.node_id
                                         " );                                        
           return ceil( $count[0]['total'] / $items_per_block );
    	}
    }
}
?>