<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 29/09/14
 * Time: 8:47
 */

namespace Efl\WebBundle\Helper;

class MenusHelper
{
    public function getSelectedMainMenuItem( $route )
    {
        if ( strpos( $route, 'qmementix' ) !== false )
        {
            return 69;
        }

        if ( strpos( $route, 'imemento' ) !== false )
        {
            return 11152;
        }


        return 2;
    }
} 