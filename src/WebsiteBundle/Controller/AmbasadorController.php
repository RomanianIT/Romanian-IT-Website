<?php

namespace WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WebsiteBundle\Entity\Ambasador;
use WebsiteBundle\Form\AmbasadorType;

/**
 * Ambasador controller.
 *
 * @Route("/ambasadori")
 */
class AmbasadorController extends Controller
{
    /**
     * Lists all Ambasador entities.
     *
     * @Route("/", name="ambasadori_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $ambasadors = $em->getRepository('WebsiteBundle:Ambasador')->findAll();

        return array(
            'ambasadors' => $ambasadors,
        );
    }


    /**
     * Finds and displays a Ambasador entity.
     *
     * @Route("/{id}", name="ambasadori_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Ambasador $ambasador)
    {
        $deleteForm = $this->createDeleteForm($ambasador);

        return array(
            'ambasador' => $ambasador,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Ambasador entity.
     *
     * @Route("/{id}/modifica", name="ambasadori_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Ambasador $ambasador)
    {
        $deleteForm = $this->createDeleteForm($ambasador);
        $editForm = $this->createForm('WebsiteBundle\Form\AmbasadorType', $ambasador);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ambasador);
            $em->flush();

            $this->addFlash(
                'notice',
                'Modificările au fost salvate!'
            );

            return $this->redirectToRoute('ambasadori_edit', array('id' => $ambasador->getId()));
        }

        return array(
            'ambasador' => $ambasador,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Ambasador entity.
     *
     * @Route("/{id}", name="ambasadori_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Ambasador $ambasador)
    {
        $form = $this->createDeleteForm($ambasador);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($ambasador);
            $em->flush();
        }

        return $this->redirectToRoute('ambasadori_index');
    }

    /**
     * Creates a form to delete a Ambasador entity.
     *
     * @param Ambasador $ambasador The Ambasador entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Ambasador $ambasador)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ambasadori_delete', array('id' => $ambasador->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
