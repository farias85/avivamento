<?php

namespace AV\BackendBundle\Controller;

use AV\CommonBundle\Controller\NomenclatureController;
use AV\CommonBundle\Entity\GalleryItem;
use AV\CommonBundle\Form\GalleryItemType;
use AV\CommonBundle\Util\Entity;
use AV\MediaBundle\Entity\Media;
use Symfony\Component\VarDumper\VarDumper;

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
        return ['id' => 'text', 'activo' => 'bool', 'image' => 'image'];
    }

    public function getResourceViewPath() {
        return 'BackendBundle:GalleryItem';
    }

    /**
     * @param $entity GalleryItem
     * @param $data mixed
     */
    public function newActionAfterFlush($entity, $data) {
        $this->get('av.media.manager')->saveUploadedFile($entity, $data);
    }

    /**
     * @param $entity GalleryItem
     * @param $data  mixed
     */
    public function editActionAfterFlush($entity, $data) {
        $this->get('av.media.manager')->editUploadedFile($entity, $data);
    }
}
