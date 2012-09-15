<?php

class eztext2ezstring extends convertHandler
{
	var $from_datatype	= 'eztext';
	var $to_datatype	= 'ezstring';

	function eztext2ezstring()
	{
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		// set default 0 for char limit
		$contentClassAttribute->setAttribute( 'data_int1', 0 ); 
		$contentClassAttribute->store();
	}
	
	function convertObjectAttribute( $contentObjectAttribute, $wizard = null )
	{
		$content = $this->getAttributeContent( $contentObjectAttribute ); 
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->fromString( $content );
		$contentObjectAttribute->store();
	}
	
}

?>