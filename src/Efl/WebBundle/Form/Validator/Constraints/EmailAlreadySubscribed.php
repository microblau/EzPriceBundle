<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 8/09/14
 * Time: 12:51
 */

namespace Efl\WebBundle\Form\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class EmailAlreadySubscribed extends Constraint
{
    public $message = 'El email ya está dado de alta en la lista';

    public function validatedBy()
    {
        return 'email_already_subscribed';
    }
}