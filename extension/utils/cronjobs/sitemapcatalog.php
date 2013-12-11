<?php
$cli = eZCLI::instance();

$ini = eZINI::instance();
// Get user's ID who can remove subtrees. (Admin by default with userID = 14)
$userCreatorID = $ini->variable( "UserSettings", "UserCreatorID" );
$user = eZUser::fetch( $userCreatorID );
if ( !$user )
{
    $cli->error( "Subtree remove Error!\nCannot get user object by userID = '$userCreatorID'.\n(See site.ini[UserSettings].UserCreatorID)" );
    $script->shutdown( 1 );
}
eZUser::setCurrentlyLoggedInUser( $user, $userCreatorID );

$xml = new DOMDocument();
$xml->formatOutput = true;
$root = $xml->createElement( 'urlset' );

// home
$url = $xml->createElement( 'url' );
$loc = $xml->createElement( 'loc', 'http://www.efl.es' );
$lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', eZContentObjectTreeNode::fetch( 2 )->attribute( 'object' )->attribute( 'modified' ) ) );
$changefreq = $xml->createElement( 'changefreq', 'monthly' );
$priority = $xml->createElement( 'priority', '1.00' );
$url->appendChild( $loc );
$url->appendChild( $lastmod );
$url->appendChild( $changefreq );
$url->appendChild( $priority );
$root->appendChild( $url );

// mapaweb
$url = $xml->createElement( 'url' );
$loc = $xml->createElement( 'loc', 'http://www.efl.es/mapaweb' );
$lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', eZContentObjectTreeNode::fetch( 2 )->attribute( 'object' )->attribute( 'modified' ) ) );
$changefreq = $xml->createElement( 'changefreq', 'monthly' );
$priority = $xml->createElement( 'priority', '0.50' );
$url->appendChild( $loc );
$url->appendChild( $lastmod );
$url->appendChild( $changefreq );
$url->appendChild( $priority );
$root->appendChild( $url );

//catalogo
$url = $xml->createElement( 'url' );
$loc = $xml->createElement( 'loc', 'http://www.efl.es/catalogo' );
$lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', eZContentObjectTreeNode::fetch( 2 )->attribute( 'object' )->attribute( 'modified' ) ) );
$changefreq = $xml->createElement( 'changefreq', 'monthly' );
$priority = $xml->createElement( 'priority', '0.50' );
$url->appendChild( $loc );
$url->appendChild( $lastmod );
$url->appendChild( $changefreq );
$url->appendChild( $priority );
$root->appendChild( $url );

// menú catálogo
$folders = eZContentObjectTreeNode::subTreeByNodeID(
     array(
         'ClassFilterType' => 'include',
         'ClassFilterArray' => array( 'subhome', 'folder' ),
     ),
     61
);

foreach( $folders as $folder )
{
    $url = $xml->createElement( 'url' );
    $loc = $xml->createElement( 'loc', 'http://www.efl.es/' . $folder->urlAlias() );
    $lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', $folder->attribute( 'object' )->attribute( 'modified' ) ) );
    $changefreq = $xml->createElement( 'changefreq', 'monthly' );
    $priority = $xml->createElement( 'priority', '0.50' );
    $url->appendChild( $loc );
    $url->appendChild( $lastmod );
    $url->appendChild( $changefreq );
    $url->appendChild( $priority );
    $root->appendChild( $url );
}

// areas de interés
$areas = eZContentObjectTreeNode::subTreeByNodeID(
     array(
         'ClassFilterType' => 'include',
         'ClassFilterArray' => array( 'area_interes' ),
         'AttributeFilter' => array( array( 'priority', '>', 0 ) )
     ),
     143
);

foreach( $areas as $area )
{
    $url = $xml->createElement( 'url' );
    $loc = $xml->createElement( 'loc',  'http://www.efl.es/' . str_replace( 'auxiliar/areas-de-interes', 'catalogo/area', $area->urlAlias() ) );
    $lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', $area->attribute( 'object' )->attribute( 'modified' ) ) );
    $changefreq = $xml->createElement( 'changefreq', 'monthly' );
    $priority = $xml->createElement( 'priority', '0.50' );
    $url->appendChild( $loc );
    $url->appendChild( $lastmod );
    $url->appendChild( $changefreq );
    $url->appendChild( $priority );
    $root->appendChild( $url );
}

// sector profesional
$sectores = eZContentObjectTreeNode::subTreeByNodeID(
     array(
         'ClassFilterType' => 'include',
         'ClassFilterArray' => array( 'sector' )
     ),
     157
);

foreach( $sectores as $sector )
{
    $url = $xml->createElement( 'url' );
    $loc = $xml->createElement( 'loc',  'http://www.efl.es/' . str_replace( 'auxiliar/sectores-productivos', 'catalogo/sector', $sector->urlAlias() ) );
    $lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', $sector->attribute( 'object' )->attribute( 'modified' ) ) );
    $changefreq = $xml->createElement( 'changefreq', 'monthly' );
    $priority = $xml->createElement( 'priority', '0.50' );
    $url->appendChild( $loc );
    $url->appendChild( $lastmod );
    $url->appendChild( $changefreq );
    $url->appendChild( $priority );
    $root->appendChild( $url );
}

// formato papel
$url = $xml->createElement( 'url' );
$loc = $xml->createElement( 'loc',  'http://www.efl.es/catalogo/formato/papel' );
$lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', eZContentObjectTreeNode::fetch( 2 )->attribute( 'object' )->attribute( 'modified' ) ) );
$changefreq = $xml->createElement( 'changefreq', 'monthly' );
$priority = $xml->createElement( 'priority', '0.50' );
$url->appendChild( $loc );
$url->appendChild( $lastmod );
$url->appendChild( $changefreq );
$url->appendChild( $priority );
$root->appendChild( $url );

// formato digital
$url = $xml->createElement( 'url' );
$loc = $xml->createElement( 'loc',  'http://www.efl.es/catalogo/formato/digital' );
$lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', eZContentObjectTreeNode::fetch( 2 )->attribute( 'object' )->attribute( 'modified' ) ) );
$changefreq = $xml->createElement( 'changefreq', 'monthly' );
$priority = $xml->createElement( 'priority', '0.50' );
$url->appendChild( $loc );
$url->appendChild( $lastmod );
$url->appendChild( $changefreq );
$url->appendChild( $priority );
$root->appendChild( $url );

// formato papel digital
$url = $xml->createElement( 'url' );
$loc = $xml->createElement( 'loc',  'http://www.efl.es/catalogo/formato/papel-digital' );
$lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', eZContentObjectTreeNode::fetch( 2 )->attribute( 'object' )->attribute( 'modified' ) ) );
$changefreq = $xml->createElement( 'changefreq', 'monthly' );
$priority = $xml->createElement( 'priority', '0.50' );
$url->appendChild( $loc );
$url->appendChild( $lastmod );
$url->appendChild( $changefreq );
$url->appendChild( $priority );
$root->appendChild( $url );


// productos
$productos = eZContentObjectTreeNode::subTreeByNodeID(
     array(
         'ClassFilterType' => 'include',
         'ClassFilterArray' => array( 
             'producto', 
             'producto_imemento',
             'producto_qmementix',
             'producto_nautis'
         )
     ),
     61
);

foreach( $productos as $producto )
{
    $url = $xml->createElement( 'url' );
    $loc = $xml->createElement( 'loc',  'http://www.efl.es/' . $producto->urlAlias() );
    $lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', $producto->attribute( 'object' )->attribute( 'modified' ) ) );
    $changefreq = $xml->createElement( 'changefreq', 'monthly' );
    $priority = $xml->createElement( 'priority', '0.50' );
    $url->appendChild( $loc );
    $url->appendChild( $lastmod );
    $url->appendChild( $changefreq );
    $url->appendChild( $priority );
    $root->appendChild( $url );
}

$xml->appendChild( $root );
$cli->output( $xml->save( 'sitemap-efl.xml' ) );

?>
