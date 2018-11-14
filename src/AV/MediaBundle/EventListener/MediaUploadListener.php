<?php

namespace AV\MediaBundle\EventListener;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use AV\MediaBundle\Entity\Media;
use AV\MediaBundle\Service\FileUploader;
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

        // upload only works for Media entities
        if (!$entity instanceof Media) {
            return;
        }

        $file = $entity->getPath();

        // only upload new files
        if (!$file instanceof UploadedFile) {
            return;
        }

        $fileName = $this->uploader->upload($file);
        $entity->setPath($fileName);

//        VarDumper::dump($entity); die();
    }
}
