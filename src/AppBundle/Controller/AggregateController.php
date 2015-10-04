<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\Aggregate;
use AppBundle\Form\AggregateType;

/**
 * Aggregate controller.
 *
 * @Route("/aggregate")
 */
class AggregateController extends Controller
{

    /**
     * Lists all Aggregate entities.
     *
     * @Route("/", name="aggregate")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Aggregate')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Aggregate entity.
     *
     * @Route("/", name="aggregate_create")
     * @Method("POST")
     * @Template("AppBundle:Aggregate:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Aggregate();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('aggregate_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Aggregate entity.
     *
     * @param Aggregate $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Aggregate $entity)
    {
        $form = $this->createForm(new AggregateType(), $entity, array(
            'action' => $this->generateUrl('aggregate_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Aggregate entity.
     *
     * @Route("/new", name="aggregate_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Aggregate();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Aggregate entity.
     *
     * @Route("/{id}", name="aggregate_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Aggregate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aggregate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Aggregate entity.
     *
     * @Route("/{id}/edit", name="aggregate_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Aggregate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aggregate entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Aggregate entity.
    *
    * @param Aggregate $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Aggregate $entity)
    {
        $form = $this->createForm(new AggregateType(), $entity, array(
            'action' => $this->generateUrl('aggregate_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Aggregate entity.
     *
     * @Route("/{id}", name="aggregate_update")
     * @Method("PUT")
     * @Template("AppBundle:Aggregate:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Aggregate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Aggregate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('aggregate_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Aggregate entity.
     *
     * @Route("/{id}", name="aggregate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('AppBundle:Aggregate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Aggregate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('aggregate'));
    }

    /**
     * Creates a form to delete a Aggregate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('aggregate_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
