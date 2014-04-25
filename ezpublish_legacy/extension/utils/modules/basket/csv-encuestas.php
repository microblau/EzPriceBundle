<?php
$contents = eZClusterFileHandler::instance( 'var/cache/encuesta.txt' )->fetchContents();
$unserialized_cache = unserialize( $contents );
$encuesta_id = $unserialized_cache['encuesta'];
$object = eZContentObject::fetch( $encuesta_id );
$data = $object->dataMap();
foreach( $data as $attr )
{
    if( $attr->attribute( 'data_type_string' ) == 'ezsurvey' )
    {
        $contentClassAttributeID = $attr->attribute( 'contentclassattribute_id' );
        break;
    }
}
$survey = eZSurvey::fetchByObjectInfo( $encuesta_id, $contentClassAttributeID, 'esl-ES' );
if ( !is_object( $survey ) )
{
    return $Module->handleError( eZError::KERNEL_NOT_AVAILABLE, 'kernel' );
}
$output = eZSurveyResult::exportCSV( $encuesta_id, $contentClassAttributeID, 'esl-ES' );
echo  $output;
eZExecution::cleanExit();
?>
