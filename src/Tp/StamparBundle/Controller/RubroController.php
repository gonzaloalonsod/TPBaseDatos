<?php

namespace Tp\StamparBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Tp\StamparBundle\Entity\Rubro;
use Tp\StamparBundle\Form\RubroType;

/**
 * Rubro controller.
 *
 * @Route("/rubro")
 */
class RubroController extends Controller
{
    /**
     * Lists all Rubro entities.
     *
     * @Route("/", name="rubro")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TpStamparBundle:Rubro')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Finds and displays a Rubro entity.
     *
     * @Route("/{id}/show", name="rubro_show")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TpStamparBundle:Rubro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rubro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to create a new Rubro entity.
     *
     * @Route("/new", name="rubro_new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Rubro();
        $form   = $this->createForm(new RubroType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a new Rubro entity.
     *
     * @Route("/create", name="rubro_create")
     * @Method("POST")
     * @Template("TpStamparBundle:Rubro:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Rubro();
        $form = $this->createForm(new RubroType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rubro_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Rubro entity.
     *
     * @Route("/{id}/edit", name="rubro_edit")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TpStamparBundle:Rubro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rubro entity.');
        }

        $editForm = $this->createForm(new RubroType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Rubro entity.
     *
     * @Route("/{id}/update", name="rubro_update")
     * @Method("POST")
     * @Template("TpStamparBundle:Rubro:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TpStamparBundle:Rubro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rubro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new RubroType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rubro_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Rubro entity.
     *
     * @Route("/{id}/delete", name="rubro_delete")
     * @Method("POST")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TpStamparBundle:Rubro')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rubro entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rubro'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
