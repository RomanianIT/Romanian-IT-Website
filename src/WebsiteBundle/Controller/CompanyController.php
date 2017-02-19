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
 * @Route("/companies")
 */
class CompanyController extends Controller
{


    /**
     * Lists all Partner entities.
     *
     * @Route("/", name="companies_index")
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


}
