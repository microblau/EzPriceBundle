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

class selectAttribute extends eZWizardBase
{
    function selectAttribute(  $tpl, $module, $storageName = false )
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
		$class_id = $this->variable( 'class_id' );
		$this->TPL->setVariable( 'class_id', $class_id );
        $this->TPL->setVariable( 'wizard', $this );
        $this->TPL->setVariable( 'possible_datatypes', DBAttributeConverter::getConvertFromArray() );
        $this->TPL->setVariable( 'step', $this->metaData( 'current_step' ) );

        $result = array();
        $result['content'] = $this->TPL->fetch( 'design:dbattributeconverter/select_attribute.tpl' );
        $result['left_menu'] = 'design:parts/content/dbattributeconverter_menu.tpl';
        $result['path'] = array(
            array( 'url' => false, 'text' => ezpI18n::tr( 'dbattributeconverter/wizard', 'Attribute converter - select class attribute' ) ),
           // array( 'url' => false, 'text' => ezpI18n::tr( 'quotation/online', 'Content upload' ) )
        );

        return $result;
    }

    function postCheck()
    {
        if ( $this->HTTP->hasPostVariable( 'NextButton' ) && $this->HTTP->hasPostVariable( 'AttributeID' ) && $this->HTTP->postVariable( 'AttributeID' ) != '' )
        {
            $this->setVariable( 'attribute_id', $this->HTTP->postVariable( 'AttributeID' ) );
			$attribute = eZContentClassAttribute::fetch( $this->variable( 'attribute_id' ) );
			if ( !is_object( $attribute ) )
			{
				$this->WarningList[] = ezpI18n::tr( 'dbattributeconverter/wizard','Error - cannot find datatype by attribute!' );
				return false;
			}
			$this->setVariable( 'source_datatype_string', $attribute->attribute( 'data_type_string' ) );

            return true;
        }
        else if ( $this->HTTP->hasPostVariable( 'NextButton' ) )
        {
            $this->WarningList[] = ezpI18n::tr( 'dbattributeconverter/wizard','You have to specify one attribute you want to convert.' );
        }


        return false;
    }
}


?>