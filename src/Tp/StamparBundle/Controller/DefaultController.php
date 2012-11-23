<?php

namespace Tp\StamparBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
//CONSULTAS
use Tp\StamparBundle\Controller\Conexion;

class DefaultController extends Controller
{
    private $em;
    
    public function __construct() {
        $this->em = new Conexion();;
    }
    
    /**
     * @Route("/", name="inicio")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/pedidos", name="pedidos")
     * @Template()
     */
    public function pedidosAction()
    {
        $id=$_GET["nombre"];
        $pedidos = $this->em->buscarPedidosPorEmpleado($id);
//        var_dump($pedidos);die;
        return array('entities' => $pedidos);
    }
    
    /**
     * @Route("/clientes", name="clientes")
     * @Template()
     */
    public function clientesAction()
    {
        $id=$_GET["nombre"];
        $clientes = $this->em->buscarClientesPorNomyape($id);
//        var_dump($clientes);die;
        return array('entities' => $clientes);
    }
    
    /**
     * @Route("/compras", name="compras")
     * @Template()
     */
    public function comprasAction()
    {
        $id=$_GET["nombre"];
        $compras = $this->em->buscarComprasDeCliente($id);
        $total = $this->em->totalComprasDeCliente($id);
//        var_dump($total);die;
        return array(
            'entities' => $compras,
            'total' => $total[0]
        );
    }
    
    /**
     * @Route("/facturas", name="facturas")
     * @Template()
     */
    public function facturasAction()
    {
        $facturas = $this->em->buscarFacturasMayor(1000);
//        var_dump($clientes);die;
        return array('entities' => $facturas);
    }
}