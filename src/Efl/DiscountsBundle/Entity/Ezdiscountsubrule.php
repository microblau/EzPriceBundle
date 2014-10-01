<?php

namespace Efl\DiscountsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ezdiscountsubrule
 */
class Ezdiscountsubrule
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var float
     */
    private $discountPercent;

    /**
     * @var integer
     */
    private $discountruleId;

    /**
     * @var string
     */
    private $limitation;

    /**
     * @var string
     */
    private $name;


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
     * Set discountPercent
     *
     * @param float $discountPercent
     * @return Ezdiscountsubrule
     */
    public function setDiscountPercent($discountPercent)
    {
        $this->discountPercent = $discountPercent;

        return $this;
    }

    /**
     * Get discountPercent
     *
     * @return float 
     */
    public function getDiscountPercent()
    {
        return $this->discountPercent;
    }

    /**
     * Set discountruleId
     *
     * @param integer $discountruleId
     * @return Ezdiscountsubrule
     */
    public function setDiscountruleId($discountruleId)
    {
        $this->discountruleId = $discountruleId;

        return $this;
    }

    /**
     * Get discountruleId
     *
     * @return integer 
     */
    public function getDiscountruleId()
    {
        return $this->discountruleId;
    }

    /**
     * Set limitation
     *
     * @param string $limitation
     * @return Ezdiscountsubrule
     */
    public function setLimitation($limitation)
    {
        $this->limitation = $limitation;

        return $this;
    }

    /**
     * Get limitation
     *
     * @return string 
     */
    public function getLimitation()
    {
        return $this->limitation;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Ezdiscountsubrule
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
}
