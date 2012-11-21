<?php
/**
 * File containing the ezpContentCriteriaInterface interface.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package API
 */

/**
 * This interface is the base one when it comes to implementing content query criteria
 * @package API
 */
interface ezpContentCriteriaInterface
{
    /**
     * Return the criteria as a value usable by eZContentObjectTreeNode
     * Temporary method that needs to be refactored
     *
     * @return array
     */
    public function translate();
}
?>
