<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 23/11/2017
 * Time: 7:30
 */

namespace AV\CommonBundle\Controller;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use AV\CommonBundle\Extension\EntityNameExtension;
use Symfony\Component\HttpFoundation\Request;

abstract class BaseApiController extends FOSRestController implements EntityNameExtension {

    const RESPONSE_SUCCESS = 'success';
    const RESPONSE_ERROR = 'error';

    private function getSimpleEntityName() {
        $words = preg_split('/[:]/', $this->getEntityName());
        return lcfirst($words[1]);
    }

    /**
     * El full path del directorio donde se encuentra la entidad
     * @return string
     */
    private function getBundleEntityFullPath() {
        $words = preg_split("/[:]/", $this->getEntityName());
        $bundleName = $words[0];
        return 'AV\\' . $bundleName . '\Entity\\';
    }

    private function getFullEntityName() {
        $words = preg_split("/[:]/", $this->getEntityName());
        $simpleEntityName = $words[1];
        return $this->getBundleEntityFullPath() . $simpleEntityName;
    }

    public function getManager() {
        return $this->get('av.base.api.manager');
    }

    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $entities = $em->getRepository($this->getEntityName())->findAll();
        $view = View::create();
        $view->setData($entities);
        return $this->handleView($view);
    }

    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->getEntityName())->find($id);
        $view = View::create();
        $view->setData($entity);
        return $this->handleView($view);
    }

    public function createActionBeforeFlush($entity, $data) {
    }

    /**
     * Siempre se debe enviar desde el frontend un objeto json de
     * nombre jsonData donde van los datos a insertar
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createAction(Request $request) {
        $data = $request->get('jsonData');
        $data['sfFullEntityName'] = $this->getFullEntityName();

        $beforeFlush = function ($entity, $data) {
            $this->createActionBeforeFlush($entity, $data);
        };

        $error = false;
        $entity = [];
        try {
            $entity = $this->getManager()->save($data, $beforeFlush);
        } catch (\Exception $e) {
            $error = true;
        }

        $result = [];
        $result['entity'] = $entity;
        if (empty($error)) {
            $result['response'] = self::RESPONSE_SUCCESS;
            $i18nKey = $this->getSimpleEntityName() . '.create.success';
            $result['data'] = $this->get('translator')->trans($i18nKey);
        } else {
            $result['response'] = self::RESPONSE_ERROR;
            $i18nKey = $this->getSimpleEntityName() . '.create.error';
            $result['data'] = $this->get('translator')->trans($i18nKey);
        }
        $view = View::create();
        $view->setData($result);

        return $this->handleView($view);
    }

    public function updateActionBeforeFlush($entity, $data) {
    }

    /**
     * Siempre se debe enviar desde el frontend un objeto json de
     * nombre jsonData donde van los datos a insertar
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->getEntityName())->find($id);
        $data = $request->get('jsonData');

        $beforeFlush = function ($entity, $data) {
            $this->updateActionBeforeFlush($entity, $data);
        };

        $error = false;
        try {
            $this->getManager()->edit($entity, $data, $beforeFlush);
        } catch (\Exception $e) {
            $error = true;
        }

        $result = [];
        if (empty($error)) {
            $result['response'] = self::RESPONSE_SUCCESS;
            $i18nKey = $this->getSimpleEntityName() . '.update.success';
            $result['data'] = $this->get($i18nKey);
        } else {
            $result['response'] = self::RESPONSE_ERROR;
            $i18nKey = $this->getSimpleEntityName() . '.update.error';
            $result['data'] = $this->get('translator')->trans($i18nKey);
        }

        $view = View::create();
        $view->setData($result);

        return $this->handleView($view);
    }

    public function deleteActionBeforeFlush($entity) {
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository($this->getEntityName())->find($id);

        $error = false;
        try {
            if (!empty($entity)) {
                $beforeFlush = function ($entity) {
                    $this->deleteActionBeforeFlush($entity);
                };
                $this->getManager()->remove($entity, $beforeFlush);
            } else {
                throw new \UnexpectedValueException('Entity object is empty');
            }
        } catch (\Exception $e) {
            $error = true;
        }

        $result = [];
        if (empty($error)) {
            $result['response'] = self::RESPONSE_SUCCESS;
            $i18nKey = $this->getSimpleEntityName() . '.delete.success';
            $result['data'] = $this->get('translator')->trans($i18nKey);
        } else {
            $result['response'] = self::RESPONSE_ERROR;
            $i18nKey = $this->getSimpleEntityName() . '.delete.error';
            $result['data'] = $this->get('translator')->trans($i18nKey);
        }

        $view = View::create();
        $view->setData($result);

        return $this->handleView($view);
    }
}