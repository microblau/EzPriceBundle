<?php
/**
 * File containing the ezpRouteMethodNotAllowedException class.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

class ezpRouteMethodNotAllowedException extends ezcMvcToolsException
{
    /**
     * List of allowed methods when the exception was thrown
     *
     * @var array
     */
    protected $allowedMethods = array();

    /**
     * Constructor
     *
     * @param array $allowedMethods
     */
    public function __construct( array $allowedMethods = array() )
    {
        $this->allowedMethods = $allowedMethods;
        parent::__construct(
            "This method is not supported, allowed methods are: " . implode( ', ', $allowedMethods )
        );
    }

    /**
     * Returns the list of allowed methods
     *
     * @return array
     */
    public function getAllowedMethods()
    {
        return $this->allowedMethods;
    }

}
