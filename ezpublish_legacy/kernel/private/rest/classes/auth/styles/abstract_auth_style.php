<?php
/**
 * File containing ezpRestAuthenticationStyle class
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */
abstract class ezpRestAuthenticationStyle
{
    /**
     * Authenticated user
     * @var eZuser
     */
    protected $user;

    /**
     * Current prefix for REST requests, to be used in case of internal redirects
     * @var string
     */
    protected $prefix;

    public function __construct()
    {
        $this->prefix = eZINI::instance( 'rest.ini' )->variable( 'System', 'ApiPrefix' );
    }

    /**
     * @see ezpRestAuthenticationStyleInterface::setUser()
     */
    public function setUser( eZUser $user )
    {
        $this->user = $user;
    }

    /**
     * @see ezpRestAuthenticationStyleInterface::getUser()
     */
    public function getUser()
    {
        return $this->user;
    }
}
?>
