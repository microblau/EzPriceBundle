<?php
/**
 * File containing the eZSOAPParameter class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package lib
 */

//! eZSOAPParameter handles parameters to SOAP requests
/*!
  \code

  \endcode
*/


class eZSOAPParameter
{
    /*!
      Creates a new SOAP parameter object.
    */
    function eZSOAPParameter( $name, $value)
    {
        $this->Name = $name;
        $this->Value = $value;
    }

    /*!
      Sets the parameter name.
    */
    function setName( $name )
    {
        $this->Name = $name;
    }

    /*!
      Returns the parameter name.
    */
    function name()
    {
        return $this->Name;
    }

    /*!
      Sets the parameter value
    */
    function setValue( $value )
    {

    }

    /*!
      Returns the parameter value.
    */
    function value()
    {
        return $this->Value;
    }

    /// The name of the parameter
    public $Name;

    /// The parameter value
    public $Value;
}

?>
