<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 26/08/14
 * Time: 11:31
 */

namespace Efl\WebBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class SimpleSearch
{
    /**
     * @Assert\Length( min = 0, max = 255, maxMessage = "search.simple.max_size.255" )
     */
    public $searchText;
}
