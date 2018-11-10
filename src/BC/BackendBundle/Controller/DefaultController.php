<?php

namespace BC\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('BackendBundle:Default:index2.html.twig');
    }

    public function dispatchAction($template) {
        return $this->render('BackendBundle:Template:' . $template . '.html.twig');
    }
}
