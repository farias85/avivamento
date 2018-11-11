<?php

namespace AV\FrontendBundle\Controller;

use AV\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;

class DefaultController extends Controller {

    public function indexAction() {
//        $em = $this->getDoctrine()->getManager();
//        $values = $em->getRepository(Entity::CONFIGURACION)->getValues([
//            'av_telefono', 'av_whatsapp', 'av_email', 'av_facebook', 'av_youtube', 'av_powered_by', 'av_direccion',
//        ], true);
//
//        $result = [];
//        foreach ($values as $value) {
//            $result[$value['clave']] = $value['valor'];
//        }
//
//        VarDumper::dump($result);
//        die();

        return $this->render('FrontendBundle:Default:index.html.twig', [
            'isIndex' => true,
        ]);
    }

    public function eventDetailsAction(Request $request) {
        return $this->render('FrontendBundle:Default:event-details.html.twig', [

        ]);
    }


}
