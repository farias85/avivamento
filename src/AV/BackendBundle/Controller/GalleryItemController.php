<?php

namespace AV\BackendBundle\Controller;

use AV\CommonBundle\Controller\NomenclatureController;
use AV\CommonBundle\Form\GalleryItemType;
use AV\CommonBundle\Util\Entity;

class GalleryItemController extends NomenclatureController {

    public function getTitle() {
        return 'Item de Galería';
    }

    public function getEntityName() {
        return Entity::GALLERY_ITEM;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'backend_gallery_item';
    }

    public function getFormTypeClass() {
        return GalleryItemType::class;
    }

    public function defaultKeysFilter() {
        return ['id'=> 'text', 'activo' => 'bool'];
    }

//    public function getResourceViewPath() {
//        return 'BackendBundle:Faq';
//    }
}
