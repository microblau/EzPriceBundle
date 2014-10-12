<?php

namespace Efl\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Couponcode
 *
 * @ORM\Table(name="eflcouponcode", indexes={@ORM\Index(name="couponcode_basket_id", columns={"basket_id"})})
 * @ORM\Entity
 */
class Couponcode
{
    /**
     * @var integer
     *
     * @ORM\Column(name="basket_id", type="integer", nullable=false)
     * @ORM\Id
     */
    private $basket_id;

    /**
     * @var string
     *
     * @ORM\Column(name="coupon", type="string", length=255, nullable=false)
     */
    private $coupon = '';

    /**
     * @ORM\ManyToOne(targetEntity="Ezbasket")
     * @ORM\JoinColumn(name="basket_id", referencedColumnName="id")
     */
    private $basket;

    /**
     * Get basket_id
     *
     * @return integer 
     */
    public function getBasketId()
    {
        return $this->basket_id;
    }

    /**
     * Set coupon
     *
     * @param string $coupon
     * @return Couponcode
     */
    public function setCoupon($coupon)
    {
        $this->coupon = $coupon;

        return $this;
    }

    /**
     * Get coupon
     *
     * @return string 
     */
    public function getCoupon()
    {
        return $this->coupon;
    }

    /**
     * Set basket_id
     *
     * @param integer $basketId
     * @return Couponcode
     */
    public function setBasketId($basketId)
    {
        $this->basket_id = $basketId;

        return $this;
    }

    /**
     * Set basket
     *
     * @param \Efl\BasketBundle\Entity\Ezbasket $basket
     * @return Couponcode
     */
    public function setBasket(\Efl\BasketBundle\Entity\Ezbasket $basket = null)
    {
        $this->basket = $basket;

        return $this;
    }

    /**
     * Get basket
     *
     * @return \Efl\BasketBundle\Entity\Ezbasket 
     */
    public function getBasket()
    {
        return $this->basket;
    }
}
