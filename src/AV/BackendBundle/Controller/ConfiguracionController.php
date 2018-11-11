<?php

namespace AV\BackendBundle\Controller;

use AV\CommonBundle\Controller\UniqueNomenclatureController;
use AV\CommonBundle\Entity\Configuracion;
use AV\CommonBundle\Form\ConfiguracionType;
use AV\CommonBundle\Util\Entity;

class ConfiguracionController extends UniqueNomenclatureController {

    public function getTitle() {
        return $this->get('translator')->trans('configuracion', [], 'menu-i18n');
    }

    public function getEntityName() {
        return Entity::CONFIGURACION;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'backend_configuracion';
    }

    public function getFormTypeClass() {
        return ConfiguracionType::class;
    }

    public function defaultKeysFilter() {
        return ['clave' => 'text', 'valor' => 'text', 'requerido' => 'bool'];
    }

//    public function getResourceViewPath() {
//        return 'BackendBundle:Configuration';
//    }

    public function keysUnique() {
        return ['clave'];
    }

    /**
     * @param $entity Configuracion
     * @param $data array
     */
    public function editActionBeforeFlush($entity, $data) {
        if (is_null($data['clave'])) {
            $entity->setRequerido(true);
        }
    }
}
