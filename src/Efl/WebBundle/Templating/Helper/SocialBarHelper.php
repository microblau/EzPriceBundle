<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 19/09/14
 * Time: 13:58
 */

namespace Efl\WebBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\Templating\EngineInterface;

class SocialBarHelper extends Helper
{
    protected $templating;

    public function __construct( EngineInterface $templating )
    {
        $this->templating = $templating;
    }

    public function socialButtons( $parameters )
    {
        return $this->templating->render(
            'EflWebBundle:helper:socialButtons.html.twig',
            $parameters
        );
    }

    public function facebookButton( $parameters )
    {
        return $this->templating->render(
            'EflWebBundle:helper:facebookButton.html.twig',
            $parameters
        );
    }

    public function twitterButton( $parameters )
    {
        return $this->templating->render(
            'EflWebBundle:helper:twitterButton.html.twig',
            $parameters
        );
    }

    public function googlePlusButton( $parameters )
    {
        return $this->templating->render(
            'EflWebBundle:helper:googlePlusButton.html.twig',
            $parameters
        );
    }

    public function linkedInButton( $parameters )
    {
        return $this->templating->render(
            'EflWebBundle:helper:linkedinButton.html.twig',
            $parameters
        );
    }

    public function getName()
    {
        return 'socialButtons';
    }
}
