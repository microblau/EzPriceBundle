<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 21/09/14
 * Time: 14:05
 */

namespace Efl\WebBundle\PagerFanta\View;

use Efl\WebBundle\PagerFanta\View\Template\EflTemplate;
use Pagerfanta\View\TwitterBootstrap3View;

class EflView extends TwitterBootstrap3View
{
    protected function createDefaultTemplate()
    {
        return new EflTemplate();
    }

    public function getName()
    {
        return 'efl';
    }
}