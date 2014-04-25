<?php

/**
 * File containing Index Plugin Interface
 *
 * @copyright Copyright (C) 2012-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 2.7.0
 * @package ezfind
 */

/**
 * Description of ezfIndexPlugin.
 * Interface that Index PLugins should implement.
 * The plugin code checks for the correct implementation.
 *
 */
interface ezfIndexPlugin
{
    /**
     * @var eZContentObject $contentObject
     * @var array $docList
     */
    public function modify( eZContentObject $contentObject, &$docList );
}

?>
