<?php

class ezstring2eztext extends convertHandler
{
	var $from_datatype	= 'ezstring';
	var $to_datatype	= 'eztext';

	function ezstring2eztext()
	{
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		// set default 10 for eztext lines
		$contentClassAttribute->setAttribute( 'data_int1', 10 ); 
		$contentClassAttribute->store();
	}
	
	function convertObjectAttribute( $contentObjectAttribute )
	{
		$content = $this->getAttributeContent( $contentObjectAttribute ); 
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $content );
		$contentObjectAttribute->store();
	}
	
}

?>