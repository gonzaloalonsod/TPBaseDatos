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
     * @Route("/hello/{name}")
     * @Template()
     */
    public function indexAction($name)
    {
        return array('name' => $name);
    }
    
    /**
     * @Route("/pedidos")
     * @Template()
     */
    public function pedidosAction()
    {
        $pedidos = $this->em->buscarPedidosPorEmpleado(1);
//        var_dump($pedidos);die;
        return array('entities' => $pedidos);
    }
}
