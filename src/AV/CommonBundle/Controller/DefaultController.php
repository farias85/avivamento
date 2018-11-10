<?php

namespace AV\CommonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('CommonBundle:Default:index.html.twig');
    }

    public function dispatchAction($template) {
        return $this->render('CommonBundle:Template:' . $template . '.html.twig');
    }
}
