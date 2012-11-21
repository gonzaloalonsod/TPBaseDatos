<?php

namespace Tp\StamparBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tp\StamparBundle\Entity\LineaPedido
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class LineaPedido
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
     * @var integer $cantidad
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;
    
    /**
     * @var Pedido
     *
     * @ORM\ManyToOne(targetEntity="Pedido", inversedBy="idLineaPedido")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pedido", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $idPedido;
    
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
     * @param integer $cantidad
     * @return LineaPedido
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    
        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer 
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set idPedido
     *
     * @param Tp\StamparBundle\Entity\Pedido $idPedido
     * @return LineaPedido
     */
    public function setIdPedido(\Tp\StamparBundle\Entity\Pedido $idPedido = null)
    {
        $this->idPedido = $idPedido;
    
        return $this;
    }

    /**
     * Get idPedido
     *
     * @return Tp\StamparBundle\Entity\Pedido 
     */
    public function getIdPedido()
    {
        return $this->idPedido;
    }

    /**
     * Set idProducto
     *
     * @param Tp\StamparBundle\Entity\Producto $idProducto
     * @return LineaPedido
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