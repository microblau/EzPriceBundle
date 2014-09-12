<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 10/09/14
 * Time: 14:00
 */

namespace Efl\WebBundle\Exceptions\Newsletter;

use eZ\Publish\Core\Base\Exceptions\NotFoundException;

/**
 * Not Found Exception implementation
 *
 * Use:
 *   throw new HashNotFound( 'HashNotFound', 42 );
 */
class HashAlreadyUsedException extends NotFoundException
{
}
