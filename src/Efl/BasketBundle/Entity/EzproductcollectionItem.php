<?php

namespace Efl\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EzproductcollectionItem
 *
 * @ORM\Table(name="ezproductcollection_item", indexes={@ORM\Index(name="ezproductcollection_item_contentobject_id", columns={"contentobject_id"}), @ORM\Index(name="ezproductcollection_item_productcollection_id", columns={"productcollection_id"})})
 * @ORM\Entity
 */
class EzproductcollectionItem
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="contentobject_id", type="integer", nullable=false)
     */
    private $contentobjectId = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="discount", type="float", precision=10, scale=0, nullable=true)
     */
    private $discount;

    /**
     * @var integer
     *
     * @ORM\Column(name="is_vat_inc", type="integer", nullable=true)
     */
    private $isVatInc;

    /**
     * @var integer
     *
     * @ORM\Column(name="item_count", type="integer", nullable=false)
     */
    private $itemCount = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=true)
     */
    private $price = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="productcollection_id", type="integer", nullable=false)
     */
    private $productcollectionId = '0';

    /**
     * @var float
     *
     * @ORM\Column(name="vat_value", type="float", precision=10, scale=0, nullable=true)
     */
    private $vatValue;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contentobjectId
     *
     * @param integer $contentobjectId
     * @return EzproductcollectionItem
     */
    public function setContentobjectId($contentobjectId)
    {
        $this->contentobjectId = $contentobjectId;

        return $this;
    }

    /**
     * Get contentobjectId
     *
     * @return integer 
     */
    public function getContentobjectId()
    {
        return $this->contentobjectId;
    }

    /**
     * Set discount
     *
     * @param float $discount
     * @return EzproductcollectionItem
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;

        return $this;
    }

    /**
     * Get discount
     *
     * @return float 
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * Set isVatInc
     *
     * @param integer $isVatInc
     * @return EzproductcollectionItem
     */
    public function setIsVatInc($isVatInc)
    {
        $this->isVatInc = $isVatInc;

        return $this;
    }

    /**
     * Get isVatInc
     *
     * @return integer 
     */
    public function getIsVatInc()
    {
        return $this->isVatInc;
    }

    /**
     * Set itemCount
     *
     * @param integer $itemCount
     * @return EzproductcollectionItem
     */
    public function setItemCount($itemCount)
    {
        $this->itemCount = $itemCount;

        return $this;
    }

    /**
     * Get itemCount
     *
     * @return integer 
     */
    public function getItemCount()
    {
        return $this->itemCount;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return EzproductcollectionItem
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return EzproductcollectionItem
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set productcollectionId
     *
     * @param integer $productcollectionId
     * @return EzproductcollectionItem
     */
    public function setProductcollectionId($productcollectionId)
    {
        $this->productcollectionId = $productcollectionId;

        return $this;
    }

    /**
     * Get productcollectionId
     *
     * @return integer 
     */
    public function getProductcollectionId()
    {
        return $this->productcollectionId;
    }

    /**
     * Set vatValue
     *
     * @param float $vatValue
     * @return EzproductcollectionItem
     */
    public function setVatValue($vatValue)
    {
        $this->vatValue = $vatValue;

        return $this;
    }

    /**
     * Get vatValue
     *
     * @return float 
     */
    public function getVatValue()
    {
        return $this->vatValue;
    }
}
