<?php
/**
 * File containing the ezpMultivariateTestInterface interface.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

interface ezpMultivariateTestHandlerInterface
{
    /**
     * Checks whether multivariate testing is enabled or not
     *
     * @abstract
     * @return bool
     */
    public function isEnabled();

    /**
     * Executes multivariate test scenarios
     *
     * @abstract
     * @param int $nodeID
     * @return int
     */
    public function execute( $nodeID );
}
