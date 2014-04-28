<?php
/**
 * File containing the Authentication class.
 *
 * This interface as the sentences definitions for the authentication steps
 *
 * @copyright Copyright (C) 1999-2014 eZ Systems AS. All rights reserved.
 * @license http://ez.no/licenses/gnu_gpl GNU General Public License v2.0
 * @version 
 */

namespace EzSystems\BehatBundle\Features\Context\SentencesInterfaces;

/**
 * Authentication Sentences Interface
 */
interface Authentication
{
    /**
     * @Given /^I am not logged in$/
     */
    public function iAmNotLoggedIn();

    /**
     * @Given /^I am logged in as "(?P<user>[^"]*)" with password "(?P<password>[^"]*)"$/
     */
    public function iAmLoggedInAsWithPassword( $user, $password );

    /**
     * @Given /^I am logged (?:in |)as (?:an |a |)"(?P<role>[^"]*)"$/
     */
    public function iAmLoggedInAsAn( $role );
}

