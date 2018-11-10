<?php

namespace AV\CommonBundle\Controller;

use AV\CommonBundle\Manager\Manager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpFoundation\Response;

abstract class CommonController extends Controller {

    public function successRedirect($id = null) {
        return $this->get('av.manager')->successRedirect($id, $this->getRouteShow(), $this->getRouteIndex());
    }

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    abstract public function getTitle();

    /**
     * Proporcionar el nombre de la ruta show del CRUD de la entidad
     * @return string
     */
    abstract public function getRouteShow();

    /**
     * Proporcionar el nombre de la ruta index del CRUD de la entidad
     * @return string
     */
    abstract public function getRouteIndex();

    /**
     * Propocionar el manager de la entidad, si lo tiene, sino con devolver av.manager está bien, sino null.
     * @return Manager
     */
    abstract public function getManager();

    public function getNameIndex() {
        return $this->get('translator')->trans('verb.list', [], 'common') . ' ' . $this->getTitle();
    }

    public function getNameNew() {
        return $this->get('translator')->trans('verb.create', [], 'common') . ' ' . $this->getTitle();
    }

    public function getNameShow() {
        return $this->get('translator')->trans('verb.show', [], 'common') . ' ' . $this->getTitle();
    }

    public function getNameEdit() {
        return $this->get('translator')->trans('verb.edit', [], 'common') . ' ' . $this->getTitle();
    }

    public function remove(\Closure $func) {
        $request = $this->get('request_stack')->getCurrentRequest();
        $flash = $request->getSession()->getFlashBag();

        try {
            $func();
        } catch (DBALException $dbalE) {
            $flash->add('danger', $this->get('translator')->trans('operation.delete.fail', [], 'common'));
            return $this->redirectToRoute($this->getRouteIndex());
        } catch (\Exception $e) {
            $flash->add('danger', $this->get('translator')->trans('operation.fail', [], 'common'));
            return $this->redirectToRoute($this->getRouteIndex());
        }

//        $func();

        return $this->successRedirect();
    }

    /**
     * @return bool
     */
    public function isXmlHttpRequest() {
        return $this->get('av.manager')->isXmlHttpRequest();
    }

    /**
     * @param $data
     * @param int $status
     * @param array $headers
     * @return Response
     */
    public function renderJson($data, $status = 200, $headers = array()) {
        return $this->get('av.manager')->renderJson($data, $status, $headers);
    }

    /**
     * Devuelve un objeto del GenericLangRepository para las traducciones
     * @return \AV\CommonBundle\Service\GenericLangRepository|object
     */
    public function glr() {
        return $this->get('av.glr');
    }

    public function getAssetPath() {
        return $this->get('av.media.file.uploader')->getAssetPath();
    }

    public function serializeJSON($data) {
        return $this->get('av.manager')->serializeJSON($data);
    }
}
