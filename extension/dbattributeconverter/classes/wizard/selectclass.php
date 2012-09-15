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

class selectClass extends eZWizardBase
{
    function selectClass(  $tpl, $module, $storageName = false )
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
        $this->TPL->setVariable( 'wizard', $this );
        $this->TPL->setVariable( 'step', $this->metaData( 'current_step' ) );

        $result = array();
        $result['content'] = $this->TPL->fetch( 'design:dbattributeconverter/select_class.tpl' );
        $result['left_menu'] = 'design:parts/content/dbattributeconverter_menu.tpl';
        $result['path'] = array(
            array( 'url' => false, 'text' => ezi18n( 'dbattributeconverter/wizard', 'Attribute converter - select content class' ) )
        );

        return $result;
    }

    function postCheck()
    {
        if ( $this->HTTP->hasPostVariable( 'NextButton' ) && $this->HTTP->hasPostVariable( 'ClassID' ) && $this->HTTP->postVariable( 'ClassID' ) != '' )
        {
            $this->setVariable( 'class_id', $this->HTTP->postVariable( 'ClassID' ) );
            return true;
        }
        else if ( $this->HTTP->hasPostVariable( 'NextButton' ) )
        {
            $this->WarningList[] = ezi18n( 'dbattributeconverter/wizard','You have to select one class.' );
        }

        return false;
    }
}

?>