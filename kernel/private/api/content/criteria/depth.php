<?php
/**
 * File containing ezpContentDepthCriteria class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

/**
 * Depth criteria
 * @package API
 */
class ezpContentDepthCriteria implements ezpContentCriteriaInterface
{
    /**
     * Maximum depth to dig while fetching
     * @var int
     */
    private $depth;

    public function __construct( $depth )
    {
        $this->depth = (int)$depth;
    }

    public function translate()
    {
        return array(
            'type'      => 'param',
            'name'      => array( 'Depth' ),
            'value'     => array( $this->depth )
        );
    }

    public function __toString()
    {
        return 'With depth '.$this->depth;
    }
}
?>
