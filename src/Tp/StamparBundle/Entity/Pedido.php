<?php

namespace Tp\StamparBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tp\StamparBundle\Entity\Pedido
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pedido
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
     * @var \DateTime $fecha
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;
    
    /**
     * @ORM\OneToMany(targetEntity="LineaPedido", mappedBy="idPedido", cascade={"persist", "remove"})
     */
    private $idLineaPedido;
    
    /**
     * @var Empleado
     *
     * @ORM\ManyToOne(targetEntity="Empleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id", nullable=false)
     * })
     */
    private $idEmpleado;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Pedido
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idLineaPedido = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add idLineaPedido
     *
     * @param Tp\StamparBundle\Entity\LineaPedido $idLineaPedido
     * @return Pedido
     */
    public function addIdLineaPedido(\Tp\StamparBundle\Entity\LineaPedido $idLineaPedido)
    {
        $this->idLineaPedido[] = $idLineaPedido;
    
        return $this;
    }

    /**
     * Remove idLineaPedido
     *
     * @param Tp\StamparBundle\Entity\LineaPedido $idLineaPedido
     */
    public function removeIdLineaPedido(\Tp\StamparBundle\Entity\LineaPedido $idLineaPedido)
    {
        $this->idLineaPedido->removeElement($idLineaPedido);
    }

    /**
     * Get idLineaPedido
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdLineaPedido()
    {
        return $this->idLineaPedido;
    }

    /**
     * Set idEmpleado
     *
     * @param Tp\StamparBundle\Entity\Empleado $idEmpleado
     * @return Pedido
     */
    public function setIdEmpleado(\Tp\StamparBundle\Entity\Empleado $idEmpleado = null)
    {
        $this->idEmpleado = $idEmpleado;
    
        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return Tp\StamparBundle\Entity\Empleado 
     */
    public function getIdEmpleado()
    {
        return $this->idEmpleado;
    }
}