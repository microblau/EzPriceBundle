<?php

namespace Efl\DiscountsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ezcustomdiscountsubrule
 */
class Ezcustomdiscountsubrule
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
     * @var integer
     */
    private $start;

    /**
     * @var integer
     */
    private $end;


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
     * @return Ezcustomdiscountsubrule
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
     * @return Ezcustomdiscountsubrule
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
     * @return Ezcustomdiscountsubrule
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
     * @return Ezcustomdiscountsubrule
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
     * Set start
     *
     * @param integer $start
     * @return Ezcustomdiscountsubrule
     */
    public function setStart($start)
    {
        $this->start = $start;

        return $this;
    }

    /**
     * Get start
     *
     * @return integer 
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * Set end
     *
     * @param integer $end
     * @return Ezcustomdiscountsubrule
     */
    public function setEnd($end)
    {
        $this->end = $end;

        return $this;
    }

    /**
     * Get end
     *
     * @return integer 
     */
    public function getEnd()
    {
        return $this->end;
    }
}
