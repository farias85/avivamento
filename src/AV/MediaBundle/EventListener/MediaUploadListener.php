<?php

namespace AV\MediaBundle\EventListener;

use AV\MediaBundle\Service\FileUploader;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\VarDumper\VarDumper;

class MediaUploadListener {
    private $uploader;

    public function __construct(FileUploader $uploader) {
        $this->uploader = $uploader;
    }

    public function prePersist(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    public function preUpdate(PreUpdateEventArgs $args) {
        $entity = $args->getEntity();

        $this->uploadFile($entity);
    }

    private function uploadFile($entity) {

        if (!method_exists($entity, 'getPath')) {
            return;
        }

        $file = $entity->getPath();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);

        if (method_exists($entity, 'setFilename')) {
            $entity->setFilename($fileName);
        }

        try {
            $entity->setPath($fileName); //Aqui explota si se usa el PathTrait en la entidad,
            // funciona bien si se utiliza el CRUD normal de Symfony con los FormType originales
        } catch (\Exception $e) {
        }

//        VarDumper::dump($entity);
//        die;
    }
}
