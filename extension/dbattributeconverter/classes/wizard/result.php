<?php
// Created on: <28-Jun-2009 22:00 bm>
//
// SOFTWARE NAME: DB Attribute Converter
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 2009 DB Team, http://db-team.eu
// SOFTWARE LICENSE: GNU General Public License v2.0
// NOTICE: >
//   This program is free software; you can redistribute it and/or
//   modify it under the terms of version 2.0  of the GNU General
//   Public License as published by the Free Software Foundation.
//
//   This program is distributed in the hope that it will be useful,
//   but WITHOUT ANY WARRANTY; without even the implied warranty of
//   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//   GNU General Public License for more details.
//
//   You should have received a copy of version 2.0 of the GNU General
//   Public License along with this program; if not, write to the Free
//   Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
//   MA 02110-1301, USA.

class result extends eZWizardBase
{
    function result(  $tpl, $module, $storageName = false )
    {
        $this->WizardURL = 'attributeconverter/wizard';
        $this->eZWizardBase( $tpl, $module, $storageName );
    }

    function processPostData()
    {
		return true;
    }

    function preCheck()
    {
        return true;
    }

    function process()
    {
		// proces now or dereffer to cron
		if ( $this->variable( 'in_background' ) === true )
		{
			$this->TPL->setVariable( 'in_background', true );
			$filename_part = DBAttributeConverter::createDataForCLI( $this );
			$this->TPL->setVariable( 'filename_part', $filename_part );
			
			// Take care of script monitoring - only if extension exists
			$scheduledScript = false;
			if ( in_array( 'ezscriptmonitor', eZExtension::activeExtensions() ) and
			     class_exists( 'eZScheduledScript' ) )
			{
				$script = eZScheduledScript::create( 'converter.php',
													 'extension/dbattributeconverter/bin/' . eZScheduledScript::SCRIPT_NAME_STRING .
				                                     ' -s ' . eZScheduledScript::SITE_ACCESS_STRING .
				                                     ' --filename-part=' . $filename_part,
				                                     eZScheduledScript::TYPE_PHP );
				$script->store();
				$this->TPL->setVariable( 'scheduled_script_id', $script->attribute( 'id' ) );
			}
		}
		else
		{
			// antitimeout protection part from ezscriptmonitor				
			$startTime = time();
			$executionTime = 0;
			$phpTimeoutLimit = ini_get( 'max_execution_time' );
				
	        eZDebug::addTimingPoint( "Converter start processing" ); 
	        $handler_name = $this->variable( 'source_datatype_string' ) . '2' . $this->variable( 'target_datatype_string' );
	
			// initialize convert handler
			$converter = new $handler_name();
			
			// transaction begin
			$db = eZDB::instance();
			$db->begin();			
			
			// do preAction()
			$converter->preAction( $this );
	
	
			// do class attribute conversion
			$contentClassAttribute = eZContentClassAttribute::fetch( $this->variable( 'attribute_id' ) );
			$converter->convertClassAttribute( $contentClassAttribute, $this );		
			
			eZDebug::addTimingPoint( "Converter class done" ); 
			
			// do postConvertClassAttributeAction()
			$converter->postConvertClassAttributeAction( $this );
			
			// do preConvertObjectAttributesAction()
			$converter->preConvertObjectAttributesAction( $this );
						
			// do object attributes conversion - all versions			
			$objectsArray = eZContentObjectAttribute::fetchSameClassAttributeIDList( $this->variable( 'attribute_id' ) );
			$attributeObject = $objectsArray[(count($objectsArray)-1)];
			$objectID = $attributeObject->ContentObjectID;
			$total_attribute_count = count( $objectsArray );
			foreach ( $objectsArray as $attributeObject )
			{
				$converter->convertObjectAttribute( $attributeObject, $this );
				
				// antitimeout protection from ezscriptmonitor
			    if ( $executionTime > ( $phpTimeoutLimit * 0.8 ) )
			    {
			        $this->TPL->setVariable( 'execution_time', $executionTime );
			        $this->TPL->setVariable( 'php_timeout_limit', $phpTimeoutLimit );
			        $db->falback();
			        
			        $filename_part = DBAttributeConverter::createDataForCLI( $this );

					$script = eZScheduledScript::create( 'converter.php',
														 'extension/dbattributeconverter/bin/' . eZScheduledScript::SCRIPT_NAME_STRING .
					                                     ' -s ' . eZScheduledScript::SITE_ACCESS_STRING .
					                                     ' --filename-part=' . $filename_part,
					                                     eZScheduledScript::TYPE_PHP );
					$script->store();

			        $result = array();
			        $result['content'] = $this->TPL->fetch( 'design:dbattributeconverter/result.tpl' );
        			$result['left_menu'] = 'design:parts/content/dbattributeconverter_menu.tpl';
			        $result['path'] = array(
			            array( 'url' => false, 'text' => ezpI18n::tr( 'dbattributeconverter/wizard', 'DB Attribute Converter - execute in background' ) )
			        );
			
			        return $result;

			    }				
			}
	
			// do postAction()
			$converter->postAction( $this );
	
	
			// transaction commit
			$db->commit();
			eZContentCacheManager::clearContentCache( $objectID );
	
	
			eZDebug::addTimingPoint( "Converter end processing" ); 
		}
		
		//$this->TPL->setVariable( 'class_id', $this->variable( 'class_id' ) );
		//$this->TPL->setVariable( 'attribute_id', $this->variable( 'attribute_id' ) );

		$this->TPL->setVariable( 'total_attribute_count', $total_attribute_count );

        $this->TPL->setVariable( 'wizard', $this );
        $this->TPL->setVariable( 'step', $this->metaData( 'current_step' ) );

        $result = array();
        $result['content'] = $this->TPL->fetch( 'design:dbattributeconverter/result.tpl' );
        $result['left_menu'] = 'design:parts/content/dbattributeconverter_menu.tpl';
        $result['path'] = array(
            array( 'url' => false, 'text' => ezpI18n::tr( 'dbattributeconverter/wizard', 'DB Attribute Converter - Wizard finished' ) )
        );
		
		// reset wizard data
        $this->cleanup();
        $this->initialize();

        return $result;
    } 

}

?>