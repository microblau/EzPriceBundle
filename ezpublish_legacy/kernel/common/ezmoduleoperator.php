<?php
/**
 * File containing the eZModuleOperator class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/*!
  \class eZModuleOperator ezmoduleoperator.php
  \brief The class eZModuleOperator does

*/


class eZModuleOperator
{
    /*!
     Constructor
    */
    function eZModuleOperator( $name = 'ezmodule' )
    {
        $this->Operators = array( $name );
    }

    /*!
     Returns the operators in this class.
    */
    function operatorList()
    {
        return $this->Operators;
    }

    /*!
     See eZTemplateOperator::namedParameterList()
    */
    function namedParameterList()
    {
        return array( 'uri' => array( 'type' => 'string',
                                      'required' => false,
                                      'default' => false ) );
    }
    function modify( $tpl, $operatorName, $operatorParameters, $rootNamespace, $currentNamespace, &$operatorValue, $namedParameters, $placement )
    {
        $uri = new eZURI( $namedParameters[ 'uri' ] );
        $moduleName = $uri->element( 0 );
        $moduleList = eZINI::instance( 'module.ini' )->variable( 'ModuleSettings', 'ModuleList' );
        if ( in_array( $moduleName, $moduleList, true ) )
            $check = eZModule::accessAllowed( $uri );
        $operatorValue = isset( $check['result'] ) ? $check['result'] : false;
    }

    /// \privatesection
    public $Operators;
}


?>
