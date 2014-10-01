<?php

namespace Efl\DiscountsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EzdiscountsubruleValue
 */
class EzdiscountsubruleValue
{
    /**
     * @var integer
     */
    private $discountsubruleId;

    /**
     * @var integer
     */
    private $value;

    /**
     * @var integer
     */
    private $issection;


    /**
     * Set discountsubruleId
     *
     * @param integer $discountsubruleId
     * @return EzdiscountsubruleValue
     */
    public function setDiscountsubruleId($discountsubruleId)
    {
        $this->discountsubruleId = $discountsubruleId;

        return $this;
    }

    /**
     * Get discountsubruleId
     *
     * @return integer 
     */
    public function getDiscountsubruleId()
    {
        return $this->discountsubruleId;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return EzdiscountsubruleValue
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set issection
     *
     * @param integer $issection
     * @return EzdiscountsubruleValue
     */
    public function setIssection($issection)
    {
        $this->issection = $issection;

        return $this;
    }

    /**
     * Get issection
     *
     * @return integer 
     */
    public function getIssection()
    {
        return $this->issection;
    }
}
