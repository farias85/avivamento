<?php

namespace AV\BackendBundle\Controller;

use AV\CommonBundle\Controller\NomenclatureController;
use AV\CommonBundle\Entity\Evento;
use AV\CommonBundle\Entity\GalleryItem;
use AV\CommonBundle\Form\EventoType;
use AV\CommonBundle\Form\GalleryItemType;
use AV\CommonBundle\Util\Entity;
use AV\CommonBundle\Util\Validate;
use AV\MediaBundle\Entity\Media;
use AV\MediaBundle\Entity\TipoMedia;
use Symfony\Component\VarDumper\VarDumper;

class EventoController extends NomenclatureController {

    public function getTitle() {
        return 'Evento';
    }

    public function getEntityName() {
        return Entity::EVENTO;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'backend_evento';
    }

    public function getFormTypeClass() {
        return EventoType::class;
    }

    public function defaultKeysFilter() {
        return ['id' => 'text', 'titulo' => 'text', 'activo' => 'bool',
            'principal' => 'bool', 'image' => 'image', 'categoria' => 'text'];
    }

    public function keysFilterOnShow() {
        return ['id' => 'text', 'titulo' => 'text', 'subtitulo' => 'text',
            'texto' => 'raw', 'whenStart' => 'date', 'whenEnd' => 'date', 'wherePlace' => 'text',
            'youtube_url' => 'text', 'categoria' => 'text',
            'activo' => 'bool', 'image' => 'image'];
    }

    private function isValidYoutubeUrl($youtubeUrl){
        if (!empty($youtubeUrl)) {
            $result = Validate::isAbsoluteUrl($youtubeUrl);
            if (empty($result)) {
                return ['valid' => false, 'error' => 'La url de youtube no es válida, debe proporcionar una dirección absoluta'];
            }
        }
        return ['valid' => true];
    }

    public function newActionIsFormValid($fullEntityName, $data) {
        return $this->isValidYoutubeUrl($data['youtubeUrl']);
    }

    /**
     * @param $entity Evento
     * @return array
     */
    public function editActionIsFormValid($entity) {
        return $this->isValidYoutubeUrl($entity->getYoutubeUrl());
    }

    public function newActionAfterFlush($entity, $data) {
        $man = $this->get('av.media.manager');
        $uploadedFile = $data['path'];
        $man->save($uploadedFile->getClientOriginalName(), $entity->getFilename(), $entity);
    }

    public function getResourceViewPath() {
        return 'BackendBundle:Evento';
    }
}