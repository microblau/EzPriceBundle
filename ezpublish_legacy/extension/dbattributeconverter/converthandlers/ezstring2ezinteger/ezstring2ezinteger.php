<?php

class ezstring2ezinteger extends convertHandler
{
	var $from_datatype	= 'ezstring';
	var $to_datatype	= 'eztext';

	function ezstring2ezinteger()
	{
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		// all ezstring settings should be removed, default 0 set for ezstring lenght
		$contentClassAttribute->setAttribute( 'data_int1', 0 ); 
		$contentClassAttribute->store();
	}
	
	function convertObjectAttribute( $contentObjectAttribute )
	{
		$content = $this->getAttributeContent( $contentObjectAttribute ); 
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $content );
		// remove remaining data in data_text
		$contentObjectAttribute->setAttribute( 'data_text', '' );
		$contentObjectAttribute->store();
	}
	
}

?>