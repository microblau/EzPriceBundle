<?php 

$http = eZHTTPTool::instance();
$Module = $Params['Module'];


if( !$Params['ObjectID'] )
{
     return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}

$objectID = $Params['ObjectID'];
if( !$object = eZContentObject::fetch( $objectID ) )
{
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}
$data = $object->dataMap();
if( isset( $data['archivo' ] ) ) {
$file =  $data['archivo']->content()->attribute( 'filepath' );
$original =  $data['archivo']->content()->attribute( 'original_filename' );
}
else{
$file =  $data['file']->content()->attribute( 'filepath' );
$original =  $data['file']->content()->attribute( 'original_filename' );

}


header('Content-disposition: attachment; filename=' . $original );
header('Content-type: application/pdf');
readfile( $file );
$http->removeSessionVariable( 'ebook' );



?>