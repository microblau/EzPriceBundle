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
$loc = $xml->createElement( 'loc', 'http://formacion.efl.es' );
$lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', eZContentObjectTreeNode::fetch( 62 )->attribute( 'object' )->attribute( 'modified' ) ) );
$changefreq = $xml->createElement( 'changefreq', 'monthly' );
$priority = $xml->createElement( 'priority', '1.00' );
$url->appendChild( $loc );
$url->appendChild( $lastmod );
$url->appendChild( $changefreq );
$url->appendChild( $priority );
$root->appendChild( $url );


// productos
$elements = eZContentObjectTreeNode::subTreeByNodeID(
     array(
         
     ),
     62
);

foreach( $elements as $element )
{
    $url = $xml->createElement( 'url' );
    $loc = $xml->createElement( 'loc',  'http://formacion.efl.es/' . $element->urlAlias() );
    $lastmod = $xml->createElement( 'lastmod', date( 'Y-m-d', $element->attribute( 'object' )->attribute( 'modified' ) ) );
    $changefreq = $xml->createElement( 'changefreq', 'monthly' );
    $priority = $xml->createElement( 'priority', '0.50' );
    $url->appendChild( $loc );
    $url->appendChild( $lastmod );
    $url->appendChild( $changefreq );
    $url->appendChild( $priority );
    $root->appendChild( $url );
}

$xml->appendChild( $root );
$cli->output( $xml->save( 'sitemap-formacion.xml' ) );

?>
