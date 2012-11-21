<?php

namespace Tp\StamparBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tp\StamparBundle\Entity\Empleado
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Empleado
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $dni
     *
     * @ORM\Column(name="dni", type="integer")
     */
    private $dni;

    /**
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string $apellido
     *
     * @ORM\Column(name="apellido", type="string", length=50)
     */
    private $apellido;
    
    /**
     * @var Empleado
     *
     * @ORM\ManyToOne(targetEntity="Empleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_supervisa", referencedColumnName="id")
     * })
     */
    private $idSupervisa;


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
     * Set dni
     *
     * @param integer $dni
     * @return empleado
     */
    public function setDni($dni)
    {
        $this->dni = $dni;
    
        return $this;
    }

    /**
     * Get dni
     *
     * @return integer 
     */
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return empleado
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
     * Set apellido
     *
     * @param string $apellido
     * @return empleado
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    
        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set idSupervisa
     *
     * @param Tp\StamparBundle\Entity\Empleado $idSupervisa
     * @return empleado
     */
    public function setIdSupervisa(\Tp\StamparBundle\Entity\Empleado $idSupervisa = null)
    {
        $this->idSupervisa = $idSupervisa;
    
        return $this;
    }

    /**
     * Get idSupervisa
     *
     * @return Tp\StamparBundle\Entity\Empleado 
     */
    public function getIdSupervisa()
    {
        return $this->idSupervisa;
    }
}