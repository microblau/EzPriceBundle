<?php

/**
 * eZ Human CAPTCHA extension for eZ Publish 4.0
 * Written by Piotrek Karas, Copyright (C) SELF s.c.
 * http://www.mediaself.pl, http://ryba.eu
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; version 2 of the License.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 */



class eZHumanCAPTCHATemplateOperator {

	
	var $Operators;


	/**
	 * Enter description here...
	 *
	 * @param unknown_type $name
	 */
	function __construct()
	{
		$this->Operators = array( 'ezhumancaptcha_image', 'ezhumancaptcha_validate', 'ezhumancaptcha_sessidhash' );
	}


	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	function &operatorList()
	{
		return $this->Operators;
	}


	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	function namedParameterPerOperator()
	{
		return true;
	}


	/**
	 * Enter description here...
	 *
	 * @return unknown
	 */
	function namedParameterList()
	{
		return array( 
			'ezhumancaptcha_image' => array( ), 
			'ezhumancaptcha_validate' => array( ),
		    'ezhumancaptcha_sessidhash' => array( ),
		);
	}


	/**
	 * Enter description here...
	 *
	 * @param unknown_type $tpl
	 * @param unknown_type $operatorName
	 * @param unknown_type $operatorParameters
	 * @param unknown_type $rootNamespace
	 * @param unknown_type $currentNamespace
	 * @param unknown_type $operatorValue
	 * @param unknown_type $namedParameters
	 */
	function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
	{
		include_once( 'extension/ezhumancaptcha/classes/ezhumancaptchatools.php' );
		switch( $operatorName )
		{
			case 'ezhumancaptcha_image':
				$operatorValue = eZHumanCAPTCHATools::init();
				break;
			case 'ezhumancaptcha_validate':
				$operatorValue = eZHumanCAPTCHATools::validateHTTPInput();
				break;
			case 'ezhumancaptcha_sessidhash':
				$operatorValue = eZHumanCAPTCHATools::bypassSessionIDHash();
				break;				
				
		}
	}


};

?>
