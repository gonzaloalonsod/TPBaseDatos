<?php

namespace Tp\StamparBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * factura
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class factura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime")
     */
    private $fecha;

    /**
     * @var Cliente
     *
     * @ORM\ManyToOne(targetEntity="cliente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_cliente", referencedColumnName="id")
     * })
     */
    private $idCliente;
    
    /**
     * @var Empleado
     *
     * @ORM\ManyToOne(targetEntity="Empleado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_empleado", referencedColumnName="id")
     * })
     */
    private $idEmpleado;
    
    /**
     * @ORM\OneToMany(targetEntity="linea_factura", mappedBy="idfactura", cascade={"persist", "remove"})
     */
    private $idLineaFactura;
    
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
     * Set total
     *
     * @param float $total
     * @return factura
     */
    public function setTotal($total)
    {
        $this->total = $total;
    
        return $this;
    }

    /**
     * Get total
     *
     * @return float 
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return factura
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
     * Set idCliente
     *
     * @param Tp\StamparBundle\Entity\cliente $idCliente
     * @return Factura
     */
    public function setIdCliente(\Tp\StamparBundle\Entity\cliente $idCliente = null) {
        $this->idCliente = $idCliente;

        return $this;
    }

    /**
     * Get idCliente
     *
     * @return Tp\StamparBundle\Entity\cliente
     */
    public function getIdCliente() {
        return $this->idCliente;
    }
    
    /**
     * Add idLineaFactura
     *
     * @param \Tp\StamparBundle\Entity\linea_factura $idLineaFactura
     * @return Factura
     */
    public function addIdLineaFactura(\Tp\StamparBundle\Entity\linea_factura $idLineaFactura)
    {
        $this->idLineaFactura[] = $idLineaFactura;
    
        return $this;
    }

    /**
     * Remove idLineaFactura
     *
     * @param \Tp\StamparBundle\Entity\linea_factura $idLineaFactura
     */
    public function removeIdLineaFactura(\Tp\StamparBundle\Entity\linea_factura $idLineaFactura)
    {
        $this->idLineaFactura->removeElement($idLineaFactura);
    }

    /**
     * Get idLineaFactura
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getIdLineaFactura()
    {
        return $this->idLineaFactura;
    }

    /**
     * Set idLineaFactura
     *
     * @return LineaFactura
     */
    public function setIdLineaFactura(ArrayCollection $idLineaFactura)
    {
        foreach ($idLineaFactura as $lf) {
            $lf->setIdFactura($this);
        }

        $this->idLineaFactura = $idLineaFactura;
        
        return $this;
    }
    
    /**
     * Set idEmpleado
     *
     * @param Tp\StamparBundle\Entity\Empleado $idEmpleado
     * @return Factura
     */
    public function setIdEmpleado(\Tp\StamparBundle\Entity\Empleado $idEmpleado = null) {
        $this->idEmpleado = $idEmpleado;

        return $this;
    }

    /**
     * Get idEmpleado
     *
     * @return Tp\StamparBundle\Entity\Empleado
     */
    public function getIdEmpleado() {
        return $this->idEmpleado;
    }
}
