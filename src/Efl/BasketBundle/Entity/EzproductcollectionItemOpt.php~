<?php

namespace Efl\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EzproductcollectionItemOpt
 *
 * @ORM\Table(name="ezproductcollection_item_opt", indexes={@ORM\Index(name="ezproductcollection_item_opt_item_id", columns={"item_id"})})
 * @ORM\Entity
 */
class EzproductcollectionItemOpt
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
     * @ORM\Column(name="item_id", type="integer", nullable=false)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="object_attribute_id", type="integer", nullable=true)
     */
    private $objectAttributeId;

    /**
     * @var integer
     *
     * @ORM\Column(name="option_item_id", type="integer", nullable=false)
     */
    private $optionItemId;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", precision=10, scale=0, nullable=false)
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;



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
     * Set itemId
     *
     * @param integer $itemId
     * @return EzproductcollectionItemOpt
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return integer 
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return EzproductcollectionItemOpt
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
     * Set objectAttributeId
     *
     * @param integer $objectAttributeId
     * @return EzproductcollectionItemOpt
     */
    public function setObjectAttributeId($objectAttributeId)
    {
        $this->objectAttributeId = $objectAttributeId;

        return $this;
    }

    /**
     * Get objectAttributeId
     *
     * @return integer 
     */
    public function getObjectAttributeId()
    {
        return $this->objectAttributeId;
    }

    /**
     * Set optionItemId
     *
     * @param integer $optionItemId
     * @return EzproductcollectionItemOpt
     */
    public function setOptionItemId($optionItemId)
    {
        $this->optionItemId = $optionItemId;

        return $this;
    }

    /**
     * Get optionItemId
     *
     * @return integer 
     */
    public function getOptionItemId()
    {
        return $this->optionItemId;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return EzproductcollectionItemOpt
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
     * Set value
     *
     * @param string $value
     * @return EzproductcollectionItemOpt
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }
}
