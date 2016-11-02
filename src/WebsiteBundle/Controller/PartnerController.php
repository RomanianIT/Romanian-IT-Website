<?php

namespace WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WebsiteBundle\Entity\Partner;
use WebsiteBundle\Form\PartnerType;

/**
 * Partner controller.
 *
 * @Route("/parteneri")
 */
class PartnerController extends Controller
{
    /**
     * Create partner
     *
     * @Route("/create", name="parteneri_create")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $partner = new Partner();
        $form = $this->createForm('WebsiteBundle\Form\PartnerType', $partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            return $this->redirectToRoute('parteneri_index', array());
        }

        return array(
            'partner' => $partner, 'form' => $form->createView()
        );

//        return $this->render('WebsiteBundle:Default:registerPartner.html.twig',
//            ['partner' => $partner, 'form' => $form->createView()]
//        );
    }

    /**
     * Lists all Partner entities.
     *
     * @Route("/", name="parteneri_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $partners = $em->getRepository('WebsiteBundle:Partner')->findAll();

        return array(
            'partners' => $partners,
        );
    }


    /**
     * Finds and displays a Partner entity.
     *
     * @Route("/{id}", name="parteneri_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Partner $partner)
    {
        $deleteForm = $this->createDeleteForm($partner);

        return array(
            'partner' => $partner,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Partner entity.
     *
     * @Route("/{id}/modifica", name="parteneri_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Partner $partner)
    {
        $deleteForm = $this->createDeleteForm($partner);
        $editForm = $this->createForm('WebsiteBundle\Form\PartnerType', $partner);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($partner);
            $em->flush();

            $this->addFlash(
                'notice',
                'Modificările au fost salvate!'
            );

            return $this->redirectToRoute('parteneri_edit', array('id' => $partner->getId()));
        }

        return array(
            'partner' => $partner,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Partner entity.
     *
     * @Route("/{id}", name="parteneri_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Partner $partner)
    {
        $form = $this->createDeleteForm($partner);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($partner);
            $em->flush();
        }

        return $this->redirectToRoute('parteneri_index');
    }

    /**
     * Creates a form to delete a Partner entity.
     *
     * @param Partner $partner The Partner entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Partner $partner)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('parteneri_delete', array('id' => $partner->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
