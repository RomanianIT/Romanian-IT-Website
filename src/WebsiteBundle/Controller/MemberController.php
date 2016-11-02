<?php

namespace WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WebsiteBundle\Entity\Member;
use WebsiteBundle\Form\MemberType;

/**
 * Member controller.
 *
 * @Route("/membri")
 */
class MemberController extends Controller
{
    /**
     * Lists all Member entities.
     *
     * @Route("/", name="membri_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $members = $em->getRepository('WebsiteBundle:Member')->findAll();

        return array(
            'members' => $members,
        );
//        return $this->render('member/index.html.twig', array(
//            'members' => $members,
//        ));
    }


    /**
     * Finds and displays a Member entity.
     *
     * @Route("/{id}", name="membri_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Member $member)
    {
        $deleteForm = $this->createDeleteForm($member);

        return array(
            'member' => $member,
            'delete_form' => $deleteForm->createView(),
        );

//        return $this->render('member/show.html.twig', array(
//            'member' => $member,
//            'delete_form' => $deleteForm->createView(),
//        ));
    }

    /**
     * Displays a form to edit an existing Member entity.
     *
     * @Route("/{id}/modifica", name="membri_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Member $member)
    {
        $deleteForm = $this->createDeleteForm($member);
        $editForm = $this->createForm('WebsiteBundle\Form\MemberType', $member);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            $this->addFlash(
                'notice',
                'Modificările au fost salvate!'
            );

            return $this->redirectToRoute('membri_edit', array('id' => $member->getId()));
        }

        return array(
            'member' => $member,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
//        return $this->render('member/edit.html.twig', array(
//            'member' => $member,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
    }

    /**
     * Deletes a Member entity.
     *
     * @Route("/{id}", name="membri_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Member $member)
    {
        $form = $this->createDeleteForm($member);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($member);
            $em->flush();
        }

        return $this->redirectToRoute('membri_index');
    }

    /**
     * Creates a form to delete a Member entity.
     *
     * @param Member $member The Member entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Member $member)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('membri_delete', array('id' => $member->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
