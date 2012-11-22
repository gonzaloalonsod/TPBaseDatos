<?php

namespace Tp\StamparBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LineaFactura
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LineaFactura
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
     * @ORM\Column(name="cantidad", type="float")
     */
    private $cantidad;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;
    
    /**
     * @var Factura
     *
     * @ORM\ManyToOne(targetEntity="Factura", inversedBy="idLineaFactura")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_factura", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $idFactura;

    /**
     * @var Producto
     *
     * @ORM\ManyToOne(targetEntity="Producto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_producto", referencedColumnName="id")
     * })
     */
    private $idProducto;
    
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
     * Set cantidad
     *
     * @param float $cantidad
     * @return linea_factura
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return float 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set total
     *
     * @param float $total
     * @return linea_factura
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
     * Set idFactura
     *
     * @param Tp\StamparBundle\Entity\Factura $idFactura
     * @return LineaFactura
     */
    public function setIdFactura(\Tp\StamparBundle\Entity\Factura $idFactura = null)
    {
        $this->idFactura = $idFactura;
    
        return $this;
    }

    /**
     * Get idFactura
     *
     * @return \Tp\StamparBundle\Entity\Factura
     */
    public function getIdFactura()
    {
        return $this->idFactura;
    }
    
    /**
     * Set idProducto
     *
     * @param Tp\StamparBundle\Entity\Producto $idProducto
     * @return linea_factura
     */
    public function setIdProducto(\Tp\StamparBundle\Entity\Producto $idProducto = null)
    {
        $this->idProducto = $idProducto;
    
        return $this;
    }

    /**
     * Get idProducto
     *
     * @return Tp\StamparBundle\Entity\Producto
     */
    public function getIdProducto()
    {
        return $this->idProducto;
    }
}
