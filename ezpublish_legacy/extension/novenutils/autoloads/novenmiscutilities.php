<?php
// SOFTWARE NAME: Noven Utils
// SOFTWARE RELEASE: 1.0
// COPYRIGHT NOTICE: Copyright (C) 1999-2009 Noven
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
/**
 * Various template operators
 *
 * @author Jerome Vieilledent
 * @since 2009-04-13
 */
class NovenMiscUtilities
{
	/**
	 * @var eZHTTPTool
	 */
	private $http;
	
	/**
	 * Constructor
	 * @return NovenMiscUtilities
	 */
	public function __construct()
	{
		 $this->http = eZHTTPTool::instance();
	}

	/*!
	  
	Return an array with the template operator name.
	*/
	public function operatorList()
	{
		return array( 'persistent_variable_append', 'server_variable', 'session_set', 'media_url');
	}
	/*!
	 \return true to tell the template engine that the parameter list exists per operator type,
	 this is needed for operator classes that have multiple operators.
	 */
	public function namedParameterPerOperator()
	{
		return true;
	}
	/*!
	 See eZTemplateOperator::namedParameterList
	 */
	public function namedParameterList()
	{
		return array(
                      'persistent_variable_append'	=> array( 'key'				=> array('type'		=> 'string',
																						 'required'	=> true,
																						 'default'	=> null),
															  'value'			=> array('type'		=> 'mixed',
																						 'required'	=> false,
																				 		 'default'	=> null),
															  'merge_existing'	=> array('type'		=> 'bool',
																						 'required'	=> false,
																				 		 'default'	=> false),
															),
		
					  'server_variable'				=> array( 'name'				=> array('type'		=> 'string',
																							 'required'	=> true,
																							 'default'	=> null)
															),
															
					  'session_set'				=> array( 'variable'				=> array('type'		=> 'string',
																							 'required'	=> true,
																							 'default'	=> null),
														  'value'					=> array('type'		=> 'mixed',
																							 'required'	=> true,
																							 'default'	=> null),
															),
						'media_url'				=> array( 'addQuotes'   => array( 
														  'type' => 'string',
														  'required' => false,
														  'default' => 'yes' )
												)
		);
	}
	
	/**
	 * Operator exectuion
	 * @param $tpl
	 * @param $operatorName
	 * @param $operatorParameters
	 * @param $rootNamespace
	 * @param $currentNamespace
	 * @param $operatorValue
	 * @param $namedParameters
	 * @return void
	 */
	public function modify( &$tpl, &$operatorName, &$operatorParameters, &$rootNamespace, &$currentNamespace, &$operatorValue, &$namedParameters )
	{

		switch ( $operatorName )
		{
			/*
			 * Adds a value to the "persistent_variable" variable, available in node templates and in pagelayout when a node is displayed
			 */
			case 'persistent_variable_append':
				$persistentVariable = array();
				$key = $namedParameters['key'];
				$value = $namedParameters['value'];
				$mergeExisting = (bool)$namedParameters['merge_existing'];
				if ( $tpl->hasVariable('persistent_variable') && is_array( $tpl->variable('persistent_variable') ) )
					$persistentVariable = $tpl->variable('persistent_variable');
					
				// On check si on peut merger les valeurs
				if(isset($persistentVariable[$key]) && is_array($persistentVariable[$key]) && $mergeExisting && is_array($value))
					$persistentVariable[$key] = array_merge($persistentVariable[$key], $value);
				else
					$persistentVariable[$key] = $value;
				$tpl->setVariable('persistent_variable', $persistentVariable);
				break;
				
			case 'server_variable':
				if(isset($_SERVER[$namedParameters['name']]))
					$operatorValue = $_SERVER[$namedParameters['name']];
				else
					$operatorValue = null;
			break;
			
			case 'session_set':
				$this->http->setSessionVariable($namedParameters['variable'], $namedParameters['value']);
			break;
			
			case 'cp_media_url':
				if($namedParameters['addQuotes'] == 'no')
					$addQuotes = false;
				else
					$addQuotes = true;
				$operatorValue = $this->getMediaURL($operatorValue, $addQuotes);
			break;
		}
	}

	/**
	 * Adds the Media host to an URL. If given URL has quotes, an URL with quotes will be returned
	 * @param $url
	 * @param $addQuotes Indicates if we want to put quotes around the URL (default is true, like ezurl operator)
	 * @return string
	 */
	private function getMediaURL($url, $addQuotes = true)
	{
		$ini = eZINI::instance('novenutils.ini');
		$mediaHost = $ini->variable('MediaSettings', 'MediaHost');
		$hasQuotes = false;
		if(strpos($url, '"') !== false) // Do we have quotes ?
			$hasQuotes = true;

		$url = str_replace(array('"', "'"), '', $url); // Removing quotes
		if(strpos($url, '/') == 0) // Does the URL begins with a "/" ? In this case we delete it
			$url = substr($url, 1);
		$url = $mediaHost.'/'.$url;
		if($hasQuotes || $addQuotes)
			$url = '"'.$url.'"';

		return $url;
	}
}


