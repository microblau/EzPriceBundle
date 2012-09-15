<?php 

$hash = isset( $Params['Hash'] ) ? $Params['Hash'] : null;
$newsletter_id  = isset( $Params['NewsletterID'] ) ? $Params['NewsletterID'] : null;
$hash = $hash;
$newsletter_id = $newsletter_id;
if( $hash !== null )
{
    $track = CjwNewsletterTrack::create( $hash, $newsletter_id );
    $track->store();
}
eZExecution::cleanExit();
?>
