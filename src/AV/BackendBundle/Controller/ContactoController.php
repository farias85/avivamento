<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 28/10/2017
 * Time: 19:52
 */

namespace AV\BackendBundle\Controller;


use AV\CommonBundle\Controller\NomenclatureController;
use AV\CommonBundle\Form\ContactoType;
use AV\CommonBundle\Util\Entity;

class ContactoController extends NomenclatureController {

    public function getTitle() {
        return 'Contacto';
    }

    public function getEntityName() {
        return Entity::CONTACTO;
    }

    public function getRoutePrefix() {
        return 'backend_contacto';
    }

    public function getFormTypeClass() {
        return ContactoType::class;
    }

    public function defaultKeysFilter() {
        return ['id' => 'text', 'email' => 'text', 'nombre' => 'text',
            'asunto' => 'text', 'texto' => 'text', 'createdAt' => 'date'];
    }
}