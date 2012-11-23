<?php

namespace Tp\StamparBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Pagerfanta\Pagerfanta;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\View\TwitterBootstrapView;

use Tp\StamparBundle\Entity\Factura;
use Tp\StamparBundle\Form\FacturaType;
use Tp\StamparBundle\Form\FacturaFilterType;

use Tp\StamparBundle\Form\FacturaEmpresaType;
use Tp\StamparBundle\Entity\Cliente;

/**
 * Factura controller.
 *
 * @Route("/factura")
 */
class FacturaController extends Controller
{
    /**
     * Lists all Factura entities.
     *
     * @Route("/", name="factura")
     * @Template()
     */
    public function indexAction()
    {
        list($filterForm, $queryBuilder) = $this->filter();

        list($entities, $pagerHtml) = $this->paginator($queryBuilder);

    
        return array(
            'entities' => $entities,
            'pagerHtml' => $pagerHtml,
            'filterForm' => $filterForm->createView(),
        );
    }

    /**
    * Create filter form and process filter request.
    *
    */
    protected function filter()
    {
        $request = $this->getRequest();
        $session = $request->getSession();
        $filterForm = $this->createForm(new FacturaFilterType());
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository('TpStamparBundle:Factura')->createQueryBuilder('e');
    
        // Reset filter
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'reset') {
            $session->remove('FacturaControllerFilter');
        }
    
        // Filter action
        if ($request->getMethod() == 'POST' && $request->get('filter_action') == 'filter') {
            // Bind values from the request
            $filterForm->bind($request);

            if ($filterForm->isValid()) {
                // Build the query from the given form object
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
                // Save filter to session
                $filterData = $filterForm->getData();
                $session->set('FacturaControllerFilter', $filterData);
            }
        } else {
            // Get filter from session
            if ($session->has('FacturaControllerFilter')) {
                $filterData = $session->get('FacturaControllerFilter');
                $filterForm = $this->createForm(new FacturaFilterType(), $filterData);
                $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($filterForm, $queryBuilder);
            }
        }
    
        return array($filterForm, $queryBuilder);
    }

    /**
    * Get results from paginator and get paginator view.
    *
    */
    protected function paginator($queryBuilder)
    {
        // Paginator
        $adapter = new DoctrineORMAdapter($queryBuilder);
        $pagerfanta = new Pagerfanta($adapter);
        $currentPage = $this->getRequest()->get('page', 1);
        $pagerfanta->setCurrentPage($currentPage);
        $entities = $pagerfanta->getCurrentPageResults();
    
        // Paginator - route generator
        $me = $this;
        $routeGenerator = function($page) use ($me)
        {
            return $me->generateUrl('factura', array('page' => $page));
        };
    
        // Paginator - view
        $translator = $this->get('translator');
        $view = new TwitterBootstrapView();
        $pagerHtml = $view->render($pagerfanta, $routeGenerator, array(
            'proximity' => 3,
            'prev_message' => $translator->trans('views.index.pagprev', array(), 'JordiLlonchCrudGeneratorBundle'),
            'next_message' => $translator->trans('views.index.pagnext', array(), 'JordiLlonchCrudGeneratorBundle'),
        ));
    
        return array($entities, $pagerHtml);
    }
    
    /**
     * Finds and displays a Factura entity.
     *
     * @Route("/{id}/show", name="factura_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TpStamparBundle:Factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Factura entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Factura entity.
     *
     * @Route("/new", name="factura_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Factura();
        $form   = $this->createForm(new FacturaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    
    /**
     * Displays a form to create a new Factura entity.
     *
     * @Route("/new/empresa", name="factura_new_empresa")
     * @Template("TpStamparBundle:Factura:new.html.twig")
     */
    public function newEmpresaAction()
    {
        $entity = new Factura();
        $form   = $this->createForm(new FacturaEmpresaType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Factura entity.
     *
     * @Route("/create", name="factura_create")
     * @Method("post")
     * @Template("TpStamparBundle:Factura:new.html.twig")
     */
    public function createAction()
    {
        $entity  = new Factura();
        $request = $this->getRequest();
        
        $em = $this->getDoctrine()->getManager();
        $requestDatos = $request->request->get('tp_stamparbundle_facturatype');
//        var_dump($requestDatos);die;
        if ($requestDatos['tipo'] == 'persona') {
            $id_persona = $requestDatos['idCliente'];
            $persona = $em->getRepository('TpStamparBundle:Persona')->find($id_persona);
            $id_cliente = $persona->getIdCliente();
//            echo $id_cliente.'c';die;
        } else {
            $id_empresa = $requestDatos['idCliente'];
            $empresa = $em->getRepository('TpStamparBundle:Empresa')->find($id_empresa);
            $id_cliente = $empresa->getIdCliente();
//            echo $id_cliente.'e';die;
        }
        
        $cliente = new Cliente();
        $cliente = $em->getRepository('TpStamparBundle:Cliente')->find($id_cliente);
        $empleado = $em->getRepository('TpStamparBundle:Empleado')->find($requestDatos['idEmpleado']);
        
        $entity->setIdCliente($cliente);
        $entity->setTotal($requestDatos['total']);
        $entity->setIdEmpleado($empleado);

//        $form    = $this->createForm(new FacturaType(), $entity);
//        $form->bind($request);

//        var_dump($form->getData());die;
//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.create.success');

            return $this->redirect($this->generateUrl('factura_show', array('id' => $entity->getId())));
//        } else {
//            $this->get('session')->getFlashBag()->add('error', 'flash.create.error');
//        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }
    /**
     * Displays a form to edit an existing Factura entity.
     *
     * @Route("/{id}/edit", name="factura_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TpStamparBundle:Factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Factura entity.');
        }

        $editForm = $this->createForm(new FacturaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Factura entity.
     *
     * @Route("/{id}/update", name="factura_update")
     * @Method("post")
     * @Template("TpStamparBundle:Factura:edit.html.twig")
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TpStamparBundle:Factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Factura entity.');
        }

        $editForm   = $this->createForm(new FacturaType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.update.success');

            return $this->redirect($this->generateUrl('factura_edit', array('id' => $id)));
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.update.error');
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Factura entity.
     *
     * @Route("/{id}/delete", name="factura_delete")
     * @Method("post")
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TpStamparBundle:Factura')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Factura entity.');
            }

            $em->remove($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add('success', 'flash.delete.success');
        } else {
            $this->get('session')->getFlashBag()->add('error', 'flash.delete.error');
        }

        return $this->redirect($this->generateUrl('factura'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
