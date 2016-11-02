<?php

namespace WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WebsiteBundle\Entity\Center;
use WebsiteBundle\Form\CenterType;

/**
 * Center controller.
 *
 * @Route("/centre")
 */
class CenterController extends Controller
{
    /**
     * Lists all Center entities.
     *
     * @Route("/", name="centre_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $centers = $em->getRepository('WebsiteBundle:Center')->findAll();

        return array(
            'centers' => $centers,
        );
    }

    /**
     * Creates a new Center entity.
     *
     * @Route("/new", name="centre_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $center = new Center();
        $form = $this->createForm('WebsiteBundle\Form\CenterType', $center);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($center);
            $em->flush();

            return $this->redirectToRoute('centre_show', array('id' => $center->getId()));
        }

        return array(
            'center' => $center,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Center entity.
     *
     * @Route("/{id}", name="centre_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Center $center)
    {
        $deleteForm = $this->createDeleteForm($center);

        return array(
            'center' => $center,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Center entity.
     *
     * @Route("/{id}/edit", name="centre_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Center $center)
    {
        $deleteForm = $this->createDeleteForm($center);
        $editForm = $this->createForm('WebsiteBundle\Form\CenterType', $center);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($center);
            $em->flush();

            return $this->redirectToRoute('centre_edit', array('id' => $center->getId()));
        }

        return array(
            'center' => $center,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Center entity.
     *
     * @Route("/{id}", name="centre_delete")
     * @Method("DELETE")
     * @Template()
     */
    public function deleteAction(Request $request, Center $center)
    {
        $form = $this->createDeleteForm($center);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($center);
            $em->flush();
        }

        return $this->redirectToRoute('centre_index');
    }

    /**
     * Creates a form to delete a Center entity.
     *
     * @param Center $center The Center entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Center $center)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('centre_delete', array('id' => $center->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
