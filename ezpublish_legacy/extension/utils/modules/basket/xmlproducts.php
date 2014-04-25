<?php


$options = array(
 'ttl' => 60*60*0,
);

if( !file_exists( 'var/cache/xml' ) )
    eZDir::mkdir( 'var/cache/xml' );
 
ezcCacheManager::createCache( 'xmls', 'var/cache/xml/', 'ezcCacheStorageFilePlain', $options );
 
$cache = ezcCacheManager::getCache( 'xmls' );
$myId = 'productos';
if ( ( $xml = $cache->restore( $myId ) ) === false )
{
    $nodes = eZContentObjectTreeNode::subTreeByNodeID( 
        array(
            'ClassFilterType' => 'include',
            'ClassFilterArray' => array( 48, 98, 99, 101, 112 ),
            'MainNodeOnly' => true
        ), 61
    );
    $dom = new DOMDocument();
    $dom->formatOutput = true;
    $root = $dom->createElement( 'productos' );
    foreach( $nodes as $node )
    {
        $data = $node->dataMap();
        $name = $dom->createElement( 'nombre' );
        $nametext = $dom->createCDATASection( $node->attribute( 'name' ) );
        $name->appendChild( $nametext );

        $ref = $dom->createElement( 'referencia', $data['referencia']->content() );
        $url = $dom->createElement( 'url', "http://www.efl.es/" . $node->attribute( 'url_alias' ) );
        $producto =  $dom->createElement( 'producto' );
        $producto->appendChild( $name );
        $producto->appendChild( $ref );
        $producto->appendChild( $url );
        
        $root->appendChild( $producto );
    }
    $dom->appendChild( $root );
    $xml = $dom->saveXml();
    echo $xml;
    $cache->store( $myId, $xml );    
}
else
{
    echo $xml;
}
eZExecution::cleanExit();            
                                                        

?>
