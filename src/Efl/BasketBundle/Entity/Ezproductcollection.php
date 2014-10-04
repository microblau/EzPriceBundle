<?php

namespace Efl\BasketBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ezproductcollection
 *
 * @ORM\Table(name="ezproductcollection")
 * @ORM\Entity
 */
class Ezproductcollection
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
     * @ORM\Column(name="created", type="integer", nullable=true)
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=4, nullable=false)
     */
    private $currencyCode = '';



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
     * Set created
     *
     * @param integer $created
     * @return Ezproductcollection
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return integer 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set currencyCode
     *
     * @param string $currencyCode
     * @return Ezproductcollection
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string 
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }
}
