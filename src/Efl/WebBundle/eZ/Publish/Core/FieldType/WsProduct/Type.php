<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 23/09/14
 * Time: 15:48
 */

namespace Efl\WebBundle\eZ\Publish\Core\FieldType\WsProduct;

use eZ\Publish\Core\FieldType\TextLine\Type as TextLineType;

class Type extends TextLineType
{
    public function isSearchable()
    {
        return false;
    }
}
