<?php

namespace Efl\DiscountsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EzuserDiscountrule
 */
class EzuserDiscountrule
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $contentobjectId;

    /**
     * @var integer
     */
    private $discountruleId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Efl\DiscountsBundle\Entity\Ezdiscountrule
     */
    private $EzDiscountRule;


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
     * @return EzuserDiscountrule
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
     * Set discountruleId
     *
     * @param integer $discountruleId
     * @return EzuserDiscountrule
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
     * Set name
     *
     * @param string $name
     * @return EzuserDiscountrule
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
     * Set EzDiscountRule
     *
     * @param \Efl\DiscountsBundle\Entity\Ezdiscountrule $ezDiscountRule
     * @return EzuserDiscountrule
     */
    public function setEzDiscountRule(\Efl\DiscountsBundle\Entity\Ezdiscountrule $ezDiscountRule = null)
    {
        $this->EzDiscountRule = $ezDiscountRule;

        return $this;
    }

    /**
     * Get EzDiscountRule
     *
     * @return \Efl\DiscountsBundle\Entity\Ezdiscountrule 
     */
    public function getEzDiscountRule()
    {
        return $this->EzDiscountRule;
    }
}
