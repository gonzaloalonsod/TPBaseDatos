<?php

namespace Tp\StamparBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * empresa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class empresa
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
     * @var string
     *
     * @ORM\Column(name="razon_social", type="string", length=255)
     */
    private $razon_social;

    /**
     * @var string
     *
     * @ORM\Column(name="CUIT", type="string", length=255)
     */
    private $CUIT;


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
     * Set razon_social
     *
     * @param string $razonSocial
     * @return empresa
     */
    public function setRazonSocial($razonSocial)
    {
        $this->razon_social = $razonSocial;
    
        return $this;
    }

    /**
     * Get razon_social
     *
     * @return string 
     */
    public function getRazonSocial()
    {
        return $this->razon_social;
    }

    /**
     * Set CUIT
     *
     * @param string $cUIT
     * @return empresa
     */
    public function setCUIT($cUIT)
    {
        $this->CUIT = $cUIT;
    
        return $this;
    }

    /**
     * Get CUIT
     *
     * @return string 
     */
    public function getCUIT()
    {
        return $this->CUIT;
    }
}
