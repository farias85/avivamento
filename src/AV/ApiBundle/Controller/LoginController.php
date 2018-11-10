<?php
/**
 * Created by PhpStorm.
 * User: farias
 * Date: 5/4/2018
 * Time: 8:44 AM
 */

namespace AV\ApiBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AV\CommonBundle\Util\Entity;
use AV\EmpresaBundle\Entity\Empresa;
use AV\UserBundle\Entity\Cuidador;
use AV\UserBundle\Entity\Demandante;
use Symfony\Component\HttpFoundation\Request;

class LoginController extends FOSRestController {

    private const MESSAGE = 'message';
    private const SUCCESS = 'success';
    private const ENTITY = 'entity';
    private const EMAIL = 'email';

    private function getEncoder() {
        return $this->container->get('security.password_encoder');
    }

    private function getRequest() {
        return $this->get('av.manager')->getRequest();
    }

    private function getTranslator() {
        return $this->get('translator');
    }

    private function getMessage0() {
        return $this->getTranslator()->trans('usuario.no.valido.entorno');
    }

    private function getMessage1() {
        return $this->getTranslator()->trans('cuenta.deshabilitada');
    }

    /**
     * @param $match boolean
     * @param $entity Empresa|Cuidador|Demandante|object|null
     * @return string
     */
    private function getMatchErrorMessage($match, $entity) {
        if (empty($match)) {
            return $this->getMessage0();
        } else if (empty($entity->getIsActive())) {
            return $this->getMessage1();
        }
        return '';
    }

    private function findResultFromCuidador() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $rqPassword = $request->get('password');
        $rqEmail = $request->get(self::EMAIL);

        $match = false;
        $result = [self::SUCCESS => true];

        $cuidador = $em->getRepository(Entity::CUIDADOR)->findOneBy([self::EMAIL => $rqEmail]);
        try {
            if (!empty($cuidador)) {
                $match = $this->getEncoder()->isPasswordValid($cuidador, $rqPassword);
            }
        } catch (\Exception $e) {
            $match = false;
        }

        $message = $this->getMatchErrorMessage($match, $cuidador);
        if (!empty($message)) {
            $result[self::MESSAGE] = $message;
        } else {
            $em = $this->getDoctrine()->getManager();
            $completamiento = $this->get('av.cuidador.manager')->calcPerfilCompletamiento($cuidador->getId());
            $cuidador->setPerfilCompletado($completamiento);
            $cuidador->setLatestConnection(new \DateTime('now'));

            if ($cuidador->getIsDeleted()) {
                $cuidador->setIsDeleted(false);
                $estado = $em->getReference(Entity::CUIDADOR_ESTADO_ALTA, $this->getParameter('av.cea.aceptado'));
                $cuidador->setCuidadorEstadoAlta($estado);
            }
            $em->flush();
        }
        $result[self::ENTITY] = Entity::CUIDADOR;
        return $result;
    }

    public function findResultFromEmpresa() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $rqPassword = $request->get('password');
        $rqEmail = $request->get(self::EMAIL);

        $match = false;
        $result = [self::SUCCESS => true];

        $empresa = $em->getRepository(Entity::EMPRESA)->findOneBy([self::EMAIL => $rqEmail]);
        try {
            if (!empty($empresa)) {
                $match = $this->getEncoder()->isPasswordValid($empresa, $rqPassword);
            }
        } catch (\Exception $e) {
            $match = false;
        }

        $message = $this->getMatchErrorMessage($match, $empresa);
        if (!empty($message)) {
            $result[self::MESSAGE] = $message;
        } else {
            $empresa->setLatestConnection(new \DateTime('now'));
            $em->flush();
        }
        $result[self::ENTITY] = Entity::EMPRESA;
        return $result;
    }

    public function findResultFromFamilia() {
        $em = $this->getDoctrine()->getManager();
        $request = $this->getRequest();
        $rqPassword = $request->get('password');
        $rqEmail = $request->get(self::EMAIL);

        $match = false;
        $result = [self::SUCCESS => true];

        $familia = $em->getRepository(Entity::DEMANDANTE)->findOneBy([self::EMAIL => $rqEmail]);
        try {
            if (!empty($familia)) {
                $match = $this->getEncoder()->isPasswordValid($familia, $rqPassword);
            }
        } catch (\Exception $e) {
            $match = false;
        }

        $message = $this->getMatchErrorMessage($match, $familia);
        if (!empty($message)) {
            $result[self::MESSAGE] = $message;
        } else {
            $familia->setLatestConnection(new \DateTime('now'));
            $em->flush();
        }
        $result[self::ENTITY] = Entity::DEMANDANTE;
        return $result;
    }

    public function securityManualAction(Request $request) {
        $rqEntorno = $request->get('entorno');
        $result = [];

        switch ($rqEntorno) {
            case 0: {//Cuidador
                $result = $this->findResultFromCuidador();
            }
                break;
            case 1: {//Empresa
                $result = $this->findResultFromEmpresa();
            }
                break;
            case 2: {//Familia
                $result = $this->findResultFromFamilia();
            }
                break;
            default: {
                $result[self::MESSAGE] = [];
            }
        }

        if (!empty($result[self::MESSAGE])) {
            $result[self::SUCCESS] = false;
        }

        $view = View::create();
        $view->setData($result);
        return $this->handleView($view);
    }
}