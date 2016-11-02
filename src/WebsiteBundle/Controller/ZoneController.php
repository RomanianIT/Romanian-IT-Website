<?php

namespace WebsiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use WebsiteBundle\Entity\Zone;
use WebsiteBundle\Form\ZoneType;

/**
 * Zone controller.
 *
 * @Route("/zone")
 */
class ZoneController extends Controller
{
    /**
     * Lists all Zone entities.
     *
     * @Route("/", name="zone_index")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $zones = $em->getRepository('WebsiteBundle:Zone')->findAll();

        return array(
            'zones' => $zones,
        );
    }

    /**
     * Creates a new Zone entity.
     *
     * @Route("/new", name="zone_new")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function newAction(Request $request)
    {
        $zone = new Zone();
        $form = $this->createForm('WebsiteBundle\Form\ZoneType', $zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zone);
            $em->flush();

            return $this->redirectToRoute('zone_show', array('id' => $zone->getId()));
        }

        return array(
            'zone' => $zone,
            'form' => $form->createView(),
        );
    }

    /**
     * Finds and displays a Zone entity.
     *
     * @Route("/{id}", name="zone_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction(Zone $zone)
    {
        $deleteForm = $this->createDeleteForm($zone);

        return array(
            'zone' => $zone,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Zone entity.
     *
     * @Route("/{id}/edit", name="zone_edit")
     * @Method({"GET", "POST"})
     * @Template()
     */
    public function editAction(Request $request, Zone $zone)
    {
        $deleteForm = $this->createDeleteForm($zone);
        $editForm = $this->createForm('WebsiteBundle\Form\ZoneType', $zone);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($zone);
            $em->flush();

            return $this->redirectToRoute('zone_edit', array('id' => $zone->getId()));
        }

        return array(
            'zone' => $zone,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Zone entity.
     *
     * @Route("/{id}", name="zone_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Zone $zone)
    {
        $form = $this->createDeleteForm($zone);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($zone);
            $em->flush();
        }

        return $this->redirectToRoute('zone_index');
    }

    /**
     * Creates a form to delete a Zone entity.
     *
     * @param Zone $zone The Zone entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Zone $zone)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('zone_delete', array('id' => $zone->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
