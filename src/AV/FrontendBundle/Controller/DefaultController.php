<?php

namespace AV\FrontendBundle\Controller;

use AV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $faqs = $em->getRepository(Entity::FAQ)->findBy(['activo' => true]);

        return $this->render('FrontendBundle:Default:index.html.twig', [
            'isIndex' => true,
            'faqs' => $faqs,
        ]);
    }

    public function eventDetailsAction(Request $request) {
        return $this->render('FrontendBundle:Default:event-details.html.twig', [

        ]);
    }


}
