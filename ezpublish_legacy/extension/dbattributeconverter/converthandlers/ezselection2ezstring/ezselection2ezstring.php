<?php

class ezselection2ezstring extends convertHandler
{
	var $from_datatype	= 'ezselection';
	var $to_datatype	= 'ezstring';

	function ezselection2ezstring()
	{
		
	}

	function preAction( $wizard )
	{
		$contentClassAttribute = eZContentClassAttribute::fetch( $wizard->variable( 'attribute_id' ) );
		$wizard->setVariable( 'class_attribute_content', $contentClassAttribute->content() );
		return true;		
	}

	function convertClassAttribute( $contentClassAttribute )
	{
		$contentClassAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		// set default 0 for char limit
		$contentClassAttribute->setAttribute( 'data_text5', '' ); 
		$contentClassAttribute->store();
	}
	
	function convertObjectAttribute( $contentObjectAttribute, $wizard )
	{
		$content = $this->getAttributeContent( $contentObjectAttribute ); 
		$contentObjectAttribute->setAttribute( 'data_type_string', $this->to_datatype );
		$contentObjectAttribute->setAttribute( 'data_text', $this->getOptionString( $content, $wizard ) );
		$contentObjectAttribute->store();
	}
	
	function getAttributeContent( $contentObjectAttribute )
	{
		 return $contentObjectAttribute->attribute( 'data_text' );
	}
	
	function getSettings( $wizard )
	{
		if ( $this->isMultiselect( $wizard ) )
		{
			$settings = array(); 
			$settings[] = array( 'type'  => 'text',
								 'name'  => 'Separator',
								 'default' => ', ',
								 'label' => ezpI18n::tr( 'attributeconverter/common', 'Separator' ) );
			return $settings;			
		}
		return false;		
	}

	function getWarnings( $wizard )
	{
		if ( $this->isMultiselect( $wizard ) )
		{
			$warnings = array( ezpI18n::tr( 'attributeconverter/common', 'Specify separator for multioption attributes' ) );
			return $warnings;
		}
				
	}
	
	// private area
	private function getOptionString( $option_id, $wizard )
	{
		$class_content = $wizard->variable( 'class_attribute_content' );
		$option_array = $class_content['options'];
		// for single value attribute, just match option_id with array element
		if ( $class_content['is_multiselect'] == 0 )
		{
			// in most cases key is equal to optionID ..
			if ( $option_array[$option_id]['id'] == $option_id )
			{
				return $option_array[$option_id]['name'];
			}
			else // .. but if not, do a loop and find it
			{
				foreach ( $option_array as $option )
				{
					if ( $option['id'] == $option_id )
					{
						return $option['name'];
					}
				}
			}
		}
		// for multiopion value, do a loop for each option
		else
		{
			$settings = $wizard->VariableList['settings'];
			$separator = $settings['Separator']; 
			
			$attribute_options = explode( '-', $option_id );
			$string = '';
			foreach ( $attribute_options as $iter => $attribute_option_id )
			{
				// in most cases key is equal to optionID ..
				if ( $option_array[$attribute_option_id]['id'] == $option_id )
				{
					$string .= $option_array[$option_id]['name'];
				}
				else // .. but if not, do a loop and find it
				{
					foreach ( $option_array as $option )
					{
						if ( $option['id'] == $attribute_option_id )
						{
							$string .= $option['name'];
						}
					}
				}	
				if ( $iter+1 < count( $attribute_options ) )
				{
					$string .= $separator;
				}			
			}
			return $string;
		}
		return null;
	}
		
	private function isMultiselect( $wizard )
	{
		$contentClassAttribute = eZContentClassAttribute::fetch( $wizard->variable( 'attribute_id' ) );
		$class_content = $contentClassAttribute->content();
		return $class_content['is_multiselect'];		
	}
	
	
}

?>