<?php
/**
 * File containing the ezpRestResponseFilterInterface interface
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

interface ezpRestResponseFilterInterface
{
    public function __construct( ezcMvcRoutingInformation $routeInfo, ezcMvcRequest $request, ezcMvcResult $result, ezcMvcResponse $response );
    public function filter();
}
