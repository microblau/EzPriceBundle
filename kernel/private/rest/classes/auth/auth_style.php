<?php
/**
 * File containing the ezpRestAuthenticationStyleInterface interface.
 *
 * @copyright Copyright (C) 1999-2012 eZ Systems AS. All rights reserved.
 * @license http://ez.no/Resources/Software/Licenses/eZ-Business-Use-License-Agreement-eZ-BUL-Version-2.1 eZ Business Use License Agreement eZ BUL Version 2.1
 * @version 4.7.0
 * @package kernel
 */

interface ezpRestAuthenticationStyleInterface
{
    /**
     * Setting up the state to allow for later authentcation checks.
     *
     * @param ezcMvcRequest $request
     * @return void
     */
    public function setup( ezcMvcRequest $request );

    /**
     * Method to be run inside the runRequestFilters hook inside MvcTools.
     *
     * This method should take care of seting up proper redirections to MvcTools
     *
     * @return eZUser|ezcMvcInternalRedirect
     */
    public function authenticate( ezcAuthentication $auth, ezcMvcRequest $request );

    /**
     * Returns valid eZPublish user that has been authenticated by {@link self::authenticate()}
     * @return eZUser
     */
    public function getUser();

    /**
     * Registers the user that has been authenticated
     * @return void
     * @param eZUser $user
     */
    public function setUser( eZUser $user );
}
?>
