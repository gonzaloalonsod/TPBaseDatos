<?php

namespace Tp\StamparBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tp\StamparBundle\Entity\Producto
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Producto
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
     * @var string $nombre
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string $imagen
     *
     * @ORM\Column(name="imagen", type="string", length=255)
     */
    private $imagen;
    
    /**
     * @var integer $cantidad
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $cantidad;
    
    /**
     * @var float $precio
     *
     * @ORM\Column(name="precio", type="float", nullable=false)
     */
    private $precio;
    
    /**
     * @var TipoProducto
     *
     * @ORM\ManyToOne(targetEntity="TipoProducto")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_tipo_producto", referencedColumnName="id")
     * })
     */
    private $idTipoProducto;
    
    /**
     * @var Proveedor
     *
     * @ORM\ManyToOne(targetEntity="proveedor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_proveedor", referencedColumnName="id")
     * })
     */
    private $idProveedor;


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
     * Set nombre
     *
     * @param string $nombre
     * @return Producto
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
     * Set imagen
     *
     * @param string $imagen
     * @return Producto
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    
        return $this;
    }

    /**
     * Get imagen
     *
     * @return string 
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set idTipoProducto
     *
     * @param Tp\StamparBundle\Entity\TipoProducto $idTipoProducto
     * @return Producto
     */
    public function setIdTipoProducto(\Tp\StamparBundle\Entity\TipoProducto $idTipoProducto = null)
    {
        $this->idTipoProducto = $idTipoProducto;
    
        return $this;
    }

    /**
     * Get idTipoProducto
     *
     * @return Tp\StamparBundle\Entity\TipoProducto 
     */
    public function getIdTipoProducto()
    {
        return $this->idTipoProducto;
    }
    
     /**
     * Set idProveedor
     *
     * @param Tp\StamparBundle\Entity\proveedor $idProveedor
     * @return Producto
     */
    public function setIdProveedor(\Tp\StamparBundle\Entity\proveedor $idProveedor = null)
    {
        $this->idProveedor = $idProveedor;
    
        return $this;
    }

    /**
     * Get idProveedor
     *
     * @return Tp\StamparBundle\Entity\proveedor
     */
    public function getIdProveedor()
    {
        return $this->idProveedor;
    }
    
    /**
     * Set cantidad
     *
     * @param integer $cantidad
     * @return Producto
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
     * Set precio
     *
     * @param float $precio
     * @return Producto
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }
}