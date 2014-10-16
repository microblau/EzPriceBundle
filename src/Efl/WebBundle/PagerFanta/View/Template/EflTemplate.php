<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 21/09/14
 * Time: 14:32
 */

namespace Efl\WebBundle\PagerFanta\View\Template;

use Pagerfanta\View\Template\TwitterBootstrap3Template;

class EflTemplate extends TwitterBootstrap3Template
{
    public function __construct()
    {
        parent::__construct();

        $this->setOptions(
            array(
                'active_suffix' => '',
            )
        );
    }

    public function nextEnabled($page)
    {
        $text = $this->option('next_message');
        $class = $this->option('css_next_class');

        return $this->liLinkSpan($class, $text, $this->generateRoute($page));
    }

    public function nextDisabled()
    {
        $text = $this->option('next_message');
        $class = $this->option('css_next_class');

        return $this->liLinkSpan($class, $text, '');
    }


    public function previousDisabled()
    {
        $class = $this->previousDisabledClass();
        $text = $this->option('prev_message');

        return $this->liLinkSpan($class, $text, '');
    }

    public function previousEnabled($page)
    {
        $class = $this->previousDisabledClass();
        $text = $this->option('prev_message');

        return $this->liLinkSpan($class, $text, $this->generateRoute($page));
    }

    private function previousDisabledClass()
    {
        return $this->option('css_disabled_class');
    }

    public function current($page)
    {
        $text = trim($page . ' ' . $this->option('active_suffix'));
        $class = $this->option('css_active_class');

        return $this->liLinkSpan($class, $text, $this->generateRoute($page) );
    }

    private function liLinkSpan($class, $text, $href)
    {
        $liClass = $class ? sprintf(' class="%s"', $class) : '';

        return sprintf('<li%s><span class="btn btn-filter"><a href="%s">%s</a></span></li>', $liClass, $href, $text);
    }

    public function pageWithText($page, $text)
    {
        $class = null;

        return $this->pageWithTextAndClass($page, $text, $class);
    }

    private function pageWithTextAndClass($page, $text, $class)
    {
        $href = $this->generateRoute($page);

        return $this->liLinkSpan($class, $text, $href );
    }
}
