<?php

namespace Efl\ReviewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValoracionesProductos
 */
class ValoracionesProductos
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $userId;

    /**
     * @var integer
     */
    private $nodeProducto;

    /**
     * @var boolean
     */
    private $haVotado;

    /**
     * @var integer
     */
    private $calidad;

    /**
     * @var integer
     */
    private $actualizaciones;

    /**
     * @var integer
     */
    private $facilidad;

    /**
     * @var string
     */
    private $comentario;

    /**
     * @var integer
     */
    private $visible;

    /**
     * @var integer
     */
    private $fecha;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $empresa;

    /**
     * @var string
     */
    private $email;


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
     * Set userId
     *
     * @param integer $userId
     * @return ValoracionesProductos
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set nodeProducto
     *
     * @param integer $nodeProducto
     * @return ValoracionesProductos
     */
    public function setNodeProducto($nodeProducto)
    {
        $this->nodeProducto = $nodeProducto;

        return $this;
    }

    /**
     * Get nodeProducto
     *
     * @return integer 
     */
    public function getNodeProducto()
    {
        return $this->nodeProducto;
    }

    /**
     * Set haVotado
     *
     * @param boolean $haVotado
     * @return ValoracionesProductos
     */
    public function setHaVotado($haVotado)
    {
        $this->haVotado = $haVotado;

        return $this;
    }

    /**
     * Get haVotado
     *
     * @return boolean 
     */
    public function getHaVotado()
    {
        return $this->haVotado;
    }

    /**
     * Set calidad
     *
     * @param integer $calidad
     * @return ValoracionesProductos
     */
    public function setCalidad($calidad)
    {
        $this->calidad = $calidad;

        return $this;
    }

    /**
     * Get calidad
     *
     * @return integer 
     */
    public function getCalidad()
    {
        return $this->calidad;
    }

    /**
     * Set actualizaciones
     *
     * @param integer $actualizaciones
     * @return ValoracionesProductos
     */
    public function setActualizaciones($actualizaciones)
    {
        $this->actualizaciones = $actualizaciones;

        return $this;
    }

    /**
     * Get actualizaciones
     *
     * @return integer 
     */
    public function getActualizaciones()
    {
        return $this->actualizaciones;
    }

    /**
     * Set facilidad
     *
     * @param integer $facilidad
     * @return ValoracionesProductos
     */
    public function setFacilidad($facilidad)
    {
        $this->facilidad = $facilidad;

        return $this;
    }

    /**
     * Get facilidad
     *
     * @return integer 
     */
    public function getFacilidad()
    {
        return $this->facilidad;
    }

    /**
     * Set comentario
     *
     * @param string $comentario
     * @return ValoracionesProductos
     */
    public function setComentario($comentario)
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * Get comentario
     *
     * @return string 
     */
    public function getComentario()
    {
        return $this->comentario;
    }

    /**
     * Set visible
     *
     * @param integer $visible
     * @return ValoracionesProductos
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;

        return $this;
    }

    /**
     * Get visible
     *
     * @return integer 
     */
    public function getVisible()
    {
        return $this->visible;
    }

    /**
     * Set fecha
     *
     * @param integer $fecha
     * @return ValoracionesProductos
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return integer 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return ValoracionesProductos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     * @return ValoracionesProductos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string 
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     * @return ValoracionesProductos
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return ValoracionesProductos
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
}
