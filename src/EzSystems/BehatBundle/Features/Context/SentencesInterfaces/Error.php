<?php
/**
* File containing the Error class.
*
* This interface has the sentences definitions for the Error steps
*
* @copyright Copyright (C) 1999-2014 eZ Systems AS. All rights reserved.
* @license http://ez.no/licenses/gnu_gpl GNU General Public License v2.0
* @version 
*/

namespace EzSystems\BehatBundle\Features\Context\SentencesInterfaces;

/**
 * Errors Sentences Interface
 */
interface Error
{
    /**
     * @Then /^I see an invalid field error$/
     */
    public function iSeeAnInvalidFieldError();

    /**
     * @Then /^I see not authorized error$/
     */
    public function iSeeNotAuthorizedError();
}
