<?php
/**
 * File containing the ezpRestContentRendererInterface interface
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

abstract class ezpRestContentRendererInterface
{
    /**
     * @var Container for ezpContent object
     */
    protected $content;

    /**
     * @var Container for ezpRestMvcController object
     */
    protected $controller;

    /**
     * Creates an instance of a ezpRestContentRendererInterface for given content
     *
     * @abstract
     * @param ezpContent $content
     *
     */
    abstract public function __construct( ezpContent $content, ezpRestMvcController $controller );

    /**
     * Returns string with rendered content
     *
     * @abstract
     * @return string
     */
    abstract public function render();
}
