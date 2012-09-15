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

class selectTarget extends eZWizardBase
{
    function selectTarget(  $tpl, $module, $storageName = false )
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
		$possible_datatype_array = DBAttributeConverter::getTargetDatatypeBySource( (int)$this->variable( 'attribute_id' ) );
		$this->TPL->setVariable( 'class_id', $this->variable( 'class_id' ) );
		$this->TPL->setVariable( 'attribute_id', $this->variable( 'attribute_id' ) );
        $this->TPL->setVariable( 'wizard', $this );
        $possible_target_datatypes = array();
        $iter = 0;
        foreach ( $possible_datatype_array as $possible_datatype )
        {
        	//$possible_target_datatypes['name'] = $possible_datatype;
        	
        	$handler_name = $this->variable( 'source_datatype_string') . '2' . $possible_datatype;
    		$possible_target_datatypes[$iter]['name'] = $possible_datatype;
    		$converter = new $handler_name();
    		$possible_target_datatypes[$iter]['warnings'] = $converter->getWarnings( $this );
    		$possible_target_datatypes[$iter]['settings'] = $converter->getSettings( $this );
    		$iter++;
        	//print_r( $converter->getSettings() );
        	
        }
        $objectsArray = eZContentObjectAttribute::fetchSameClassAttributeIDList( $this->variable( 'attribute_id' ) );
        $this->TPL->setVariable( 'number_of_attributes', count( $objectsArray ) );
        $this->TPL->setVariable( 'possible_target_datatypes', $possible_target_datatypes );
        $this->TPL->setVariable( 'step', $this->metaData( 'current_step' ) );

        $result = array();
        $result['content'] = $this->TPL->fetch( 'design:dbattributeconverter/select_target.tpl' );
        $result['left_menu'] = 'design:parts/content/dbattributeconverter_menu.tpl';
        $result['path'] = array(
            array( 'url' => false, 'text' => ezi18n( 'dbattributeconverter/wizard', 'DB Attribute Converter - select target datatype' ) ),
           // array( 'url' => false, 'text' => ezi18n( 'quotation/online', 'Content upload' ) )
        );

        return $result;
    }

    function postCheck()
    {
        // if custom settings are used and posted, store it in in $this->settings array
        if ( $this->HTTP->hasPostVariable( 'Settings' ) )
        {
        	$this->setVariable( 'settings', $this->HTTP->postVariable( 'Settings' ) );
        }
		
		// set conversion metod - in GUI or CLI
        if ( $this->HTTP->hasPostVariable( 'InBackground' ) )
        {
        	$this->setVariable( 'in_background', true );
        }
        else
        {
        	$this->setVariable( 'in_background', false );
        }
        
            
        if ( $this->HTTP->hasPostVariable( 'NextButton' ) && $this->HTTP->hasPostVariable( 'Datatype' ) && $this->HTTP->postVariable( 'Datatype' ) != '' )
        {
            $this->setVariable( 'target_datatype_string', $this->HTTP->postVariable( 'Datatype' ) );
            
            return true;
        }
        else if ( $this->HTTP->hasPostVariable( 'NextButton' ) )
        {
            $this->WarningList[] = ezi18n( 'dbattributeconverter/wizard','You have to specify new target datatype.' );
        }


        return false;
    }
}


?>