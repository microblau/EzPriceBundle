<?php
/**
 * Created by PhpStorm.
 * User: carlos
 * Date: 30/06/14
 * Time: 10:21
 */

namespace Efl\WebBundle\Helper;

use Closure;
use eZBasket;

class CartHelper
{
    /**
     * @var \Closure
     */
    private $kernelClosure;

    /**
     * @var \EzBasket $cart
     */
    protected $cart;

    public function __construct( Closure $legacyKernelClosure )
    {
        $this->kernelClosure = $legacyKernelClosure;
    }

    /**
     * @return \eZ\Publish\Core\MVC\Legacy\Kernel
     */
    protected function getLegacyKernel()
    {
        $kernelClosure = $this->kernelClosure;
        return $kernelClosure();
    }

    /**
     * Returns the current cart or false is the cart is empty
     *
     * @return \eZBasket|false
     */
    private function getCartObject()
    {
        if ( is_null( $this->cart ) )
        {
            $this->cart = $this->getLegacyKernel()->runCallback(
                function()
                {
                    return eZBasket::currentBasket();
                },
                false
            );

        }
        return $this->cart;
    }

    /**
     * Returns true if cart is empty
     *
     * @return bool;
     */
    public function isCurrentCartEmpty()
    {
        return $this->getCartObject()->isEmpty();
    }

    /**
     * Returns the current cart total
     *
     * @return float;
     */
    public function getCurrentCartTotal()
    {
        return $this->getCartObject()->totalExVAT();
    }

    /**
     * Return the number of unique products in the list
     *
     * @return int
     */
    public function getCurrentCartNItems()
    {
        return count( $this->getCartObject()->items() );
    }
}
