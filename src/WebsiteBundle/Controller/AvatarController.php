<?php

namespace WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use WebsiteBundle\Entity\Avatar;
use WebsiteBundle\Form\AvatarType;

/**
 * Avatar controller.
 *
 * @Route("/avatar")
 */
class AvatarController extends Controller
{
    /**
     * Lists all Avatar entities.
     *
     * @Route("/", name="avatar_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $Avatars = $em->getRepository('WebsiteBundle:Avatar')->findAll();

        return $this->render('Avatar/index.html.twig', array(
            'Avatars' => $Avatars,
        ));
    }

    /**
     * Creates a new Avatar entity.
     *
     * @Route("/new", name="avatar_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $Avatar = new Avatar();
        $form = $this->createForm('WebsiteBundle\Form\AvatarType', $Avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Avatar);
            $em->flush();

            return $this->redirectToRoute('avatar_show', array('id' => $Avatar->getId()));
        }

        return $this->render('Avatar/new.html.twig', array(
            'Avatar' => $Avatar,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Avatar entity.
     *
     * @Route("/{id}", name="avatar_show")
     * @Method("GET")
     */
    public function showAction(Avatar $Avatar)
    {
        $deleteForm = $this->createDeleteForm($Avatar);

        return $this->render('Avatar/show.html.twig', array(
            'Avatar' => $Avatar,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Avatar entity.
     *
     * @Route("/{id}/edit", name="avatar_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Avatar $Avatar)
    {
        $deleteForm = $this->createDeleteForm($Avatar);
        $editForm = $this->createForm('WebsiteBundle\Form\AvatarType', $Avatar);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($Avatar);
            $em->flush();

            return $this->redirectToRoute('avatar_edit', array('id' => $Avatar->getId()));
        }

        return $this->render('Avatar/edit.html.twig', array(
            'Avatar' => $Avatar,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Avatar entity.
     *
     * @Route("/{id}", name="avatar_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Avatar $Avatar)
    {
        $form = $this->createDeleteForm($Avatar);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($Avatar);
            $em->flush();
        }

        return $this->redirectToRoute('avatar_index');
    }

    /**
     * Creates a form to delete a Avatar entity.
     *
     * @param Avatar $Avatar The Avatar entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Avatar $Avatar)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avatar_delete', array('id' => $Avatar->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
