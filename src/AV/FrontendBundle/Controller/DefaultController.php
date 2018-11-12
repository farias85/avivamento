<?php

namespace AV\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('FrontendBundle:Default:index.html.twig', [
            'isIndex' => true,
        ]);
    }

    public function eventDetailsAction(Request $request) {
        return $this->render('FrontendBundle:Default:event-details.html.twig', [

        ]);
    }


}
