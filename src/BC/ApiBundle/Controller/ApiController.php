<?php

namespace BC\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use BC\CommonBundle\Util\Entity;
use BC\CommonBundle\Util\Util;

class ApiController extends Controller {

    private const RESPONSE = 'response';
    private const DATA = 'data';
    private const SUCCESS = 'success';
    private const ERROR = 'error';

    public function indexAction() {
        return $this->render('ApiBundle:Default:index.html.twig');
    }

    public function provinciasAction(Request $request) {
        $manager = $this->get('bc.manager');
        $result = $manager->hidrateResult(Entity::PROVINCIA);
        $response = [];
        if ($result) {
            $response[self::RESPONSE] = self::SUCCESS;
            $response[self::DATA] = $result;
        } else {
            $response[self::RESPONSE] = self::ERROR;
            $response[self::DATA] = null;
        }
        return $this->renderJson($response);
    }

    public function municipiosProvinciaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $idProv = $request->get('idProv');
        $result = $em->getRepository(Entity::MUNICIPIO)->findByProvincia($idProv, true);
        $response = [];
        if ($result) {
            $response[self::RESPONSE] = self::SUCCESS;
            $response[self::DATA] = $result;
        } else {
            $response[self::RESPONSE] = self::ERROR;
            $response[self::DATA] = null;
        }
        return $this->renderJson($response);
    }

    public function allPropietarioDataAction(Request $request) {
        return $this->renderJson([self::RESPONSE => self::ERROR]);
    }

    private function renderJson($result) {
        $commonManager = $this->get('bc.manager');
        return $commonManager->renderJson($result);
    }
}
