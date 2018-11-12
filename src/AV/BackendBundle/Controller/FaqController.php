<?php

namespace AV\BackendBundle\Controller;

use AV\CommonBundle\Controller\NomenclatureController;
use AV\CommonBundle\Form\FaqType;
use AV\CommonBundle\Util\Entity;

class FaqController extends NomenclatureController {

    public function getTitle() {
        return 'Faq';
    }

    public function getEntityName() {
        return Entity::FAQ;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'backend_faq';
    }

    public function getFormTypeClass() {
        return FaqType::class;
    }

    public function defaultKeysFilter() {
        return ['id'=> 'text', 'pregunta' => 'text', 'respuesta' => 'text', 'activo' => 'bool'];
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Faq';
    }
}
