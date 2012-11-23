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
        $formEmpleado = $this->choiceEmpleadoForm();
        $formNombre = $this->nombreEmpleadoForm();
        $formCliente = $this->choiceClienteForm();
        return array(
            'formEmpleado' => $formEmpleado->createView(),
            'formNombre' => $formNombre->createView(),
            'formCliente' => $formCliente->createView(),
        );
    }
    
    /**
     * @Route("/pedidos", name="pedidos")
     * @Template()
     */
    public function pedidosAction()
    {
        $request = $this->getRequest();
        $requestDatos = $request->request->get('form');
        $id = $requestDatos['idEmpleado'];

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
        $request = $this->getRequest();
        $requestDatos = $request->request->get('form');
        $nomyape = $requestDatos['nombre'];

        $clientes = $this->em->buscarClientesPorNomyape($nomyape);
//        var_dump($clientes);die;
        return array('entities' => $clientes);
    }
    
    /**
     * @Route("/compras", name="compras")
     * @Template()
     */
    public function comprasAction()
    {
        $request = $this->getRequest();
        $requestDatos = $request->request->get('form');
        $id = $requestDatos['idCliente'];
//        $id=$_GET["nombre"];
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
    
    public function choiceEmpleadoForm()
    {
        return $this->createFormBuilder()
        ->add('idEmpleado', 'entity', array(
            'label' => 'Empleados',
            'class'         => 'Tp\StamparBundle\Entity\Empleado',
        ))
//        ->add('empresas', 'entity', array(
//                'label'         => 'Empresa Sucursal',
//                'class'         => 'Es\MiBundle\Entity\Empresa',
//                'query_builder' => function ($repository) use ($usuario) {
//                                                                    return $repository->createQueryBuilder('e')
//                                                                              ->where('e.usuario = :usuario AND e.enabled = 1')
//                                                                              ->setParameter('usuario', $usuario)
//                                                                    ;},
//                'property' => 'nombre',
//            ))
        ->getForm()
        ;
    }
    
    public function nombreEmpleadoForm()
    {
        return $this->createFormBuilder()
        ->add('nombre', 'text', array(
            'label' => 'Nombre o Apellido',
        ))
        ->getForm()
        ;
    }
    
    public function choiceClienteForm()
    {
        $choices = $this->em->buscarClientes();
        return $this->createFormBuilder()
        ->add('idCliente', 'choice', array(
            'choices' => array($choices),
            'label' => 'Clientes',
        ))
        ->getForm()
        ;
    }
}