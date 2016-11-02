<?php

namespace WebsiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use WebsiteBundle\Entity\Member;

/**
 * AjaxController.
 *
 * @Route("/")
 */
class AjaxController extends Controller
{

    /**
     * Update member's location
     *
     * @Route("/update_location/{id}", name="membri_update_location")
     * @Method({"POST"})
     */
    public function updateAction(Request $request, Member $member)
    {
        $lat = $request->get('lat');
        $long = $request->get('long');

        if (is_null($member->getLat()) && is_null($member->getLng())) {
            $member->setLat(floatval($lat));
            $member->setLng(floatval($long));

            $em = $this->getDoctrine()->getManager();
            $em->persist($member);
            $em->flush();

            return new JsonResponse("{status: OK, message: Location update}");
        } else {
            return new JsonResponse("{status: OK, message: Location is already set}");
        }


    }
}