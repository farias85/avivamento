<?php

namespace BC\MediaBundle\Manager;

use BC\CommonBundle\Manager\Manager;
use BC\CommonBundle\Util\Entity;
use BC\MediaBundle\Entity\Media;
use BC\MediaBundle\Entity\TipoMedia;
use Symfony\Component\HttpFoundation\File\MimeType\ExtensionGuesser;
use Symfony\Component\VarDumper\VarDumper;

class MediaManager extends Manager {

    /**
     * @param $entity mixed
     * @param $tipoMedia TipoMedia|string
     * @param $isActive boolean
     * @throws \Exception
     * @return Media|null|object|array
     */
    public function findOne($entity, $tipoMedia, $isActive = true) {
        $em = $this->getEntityManager();
        $entityName = $this->getEntityName($entity);
        if (is_string($tipoMedia)) {
            $tipoMedia = $this->getBasicTipoMedia($tipoMedia);
        }
        $media = $em->getRepository(Entity::MEDIA)
            ->findOneBy(['entityId' => $entity->getId(), 'entityName' => $entityName,
                'tipoMedia' => $tipoMedia, 'isActive' => $isActive]);
        return empty($media) ? [] : $media;
    }

    /**
     * @param $alt string
     * @param $path string
     * @param $entity mixed
     * @param $tipoMedia string|TipoMedia El slug o el objeto del tipo de media que es el file
     * @throws \Exception
     * @return Media
     */
    public function save($alt, $path, $entity, $tipoMedia = null) {
        $em = $this->getEntityManager();
        $entityName = $this->getEntityName($entity);

        $media = new Media();
        $media->setCreatedAt(new \DateTime('now'));
        $media->setUpdatedAt(new \DateTime('now'));
        $media->setName($path);
        $media->setPath($path);
        $media->setAlt($alt);
        $media->setEntityId($entity->getId());
        $media->setEntityName($entityName);

        if (empty($tipoMedia)) {
            $tipoMedia = TipoMedia::IMAGEN;
        }
        $media->setTipoMedia($this->getBasicTipoMedia($tipoMedia));

        $em->persist($media);
        $em->flush();

        return $media;
    }

    public function remove(Media $media) {
        $em = $this->getEntityManager();
        $dir = $this->get('bc.media.file.uploader')->getTargetDir() . '/';
        $file = $media->getName();

        if (file_exists($dir . $file)) {
            @unlink($dir . $file);
        }
        $em->remove($media);
        $em->flush($media);
    }

    public function removeByEntity($entity) {
        $this->getConnection()->transactional(function () use ($entity) {
            $em = $this->getEntityManager();
            $medias = $em->getRepository(Entity::MEDIA)->findBy([
                'entityId' => $entity->getId(),
                'entityName' => $this->getEntityName($entity),
            ]);

            foreach ($medias as $item) {
                $documentos = $em->getRepository(Entity::DOCUMENTO)->findBy(['media' => $item]);
                foreach ($documentos as $inner) {
                    $em->remove($inner);
                }
                $em->flush();
                $this->remove($item);
            }
            $em->flush();
        });
    }

    /**
     * Este método no permite multiples instancias de un mismo tipo de objeto considerando
     * los siguientes atributos, entityId, entityName, tipoMedia, isActive
     * @param $file mixed $_FILE['file'] Algo como esto que venga de un request
     * @param $tipoMedia string|TipoMedia El slug o el objeto del tipo de media que es el file
     * @param $entityName string El nombre doctrine de la entidad Ej. CommonBundle:Habilidad
     * @param $entityId integer El identificador de la entidad
     * @param $isActive boolean Variable de control, para permitir q se envien archivos de entidades que aun
     * no han sido guardadas en BD y por lo tanto no tengan $entityId que despues se debe setear.
     * @return Media
     */
    public function asyncFileSend($file, $tipoMedia, $entityName, $entityId, $isActive) {
        $media = new Media();
        $this->getConnection()->transactional(function () use ($media, $file, $tipoMedia, $entityName, $entityId, $isActive) {
            if (!empty($file)) {
                $destination = $this->get('bc.media.file.uploader')->getTargetDir();
                $guesser = ExtensionGuesser::getInstance();
                $extension = $guesser->guess($file['type']);

                $filename = md5(uniqid()) . '.' . $extension;
                $name = $file['name'];
                move_uploaded_file($file['tmp_name'], $destination . '/' . $filename);

                $em = $this->getEntityManager();
                if (is_string($tipoMedia)) {
                    $tipoMedia = $this->getBasicTipoMedia($tipoMedia);
                }

                $entity = $em->getRepository(Entity::MEDIA)
                    ->findOneBy(['entityId' => $entityId, 'entityName' => $entityName,
                        'tipoMedia' => $tipoMedia, 'isActive' => $isActive]);
                if (!empty($entity)) {
                    $this->remove($entity);
                }

                $media->setName($filename)
                    ->setPath($filename)
                    ->setTipoMedia($tipoMedia)
                    ->setAlt($name)
                    ->setCreatedAt(new \DateTime('now'))
                    ->setUpdatedAt(new \DateTime('now'))
                    ->setEntityName($entityName)
                    ->setEntityId($entityId)
                    ->setIsActive($isActive);
                $em->persist($media);
                $em->flush();
            }
        });
        return $media;
    }

    public function asyncFileSendAceptMultiple($file, $tipoMedia, $entityName, $entityId, $isActive) {
        $media = new Media();
        $this->getConnection()->transactional(function () use ($media, $file, $tipoMedia, $entityName, $entityId, $isActive) {
            if (!empty($file)) {
                $destination = $this->get('bc.media.file.uploader')->getTargetDir();
                $guesser = ExtensionGuesser::getInstance();
                $extension = $guesser->guess($file['type']);

                $filename = md5(uniqid()) . '.' . $extension;
                $name = $file['name'];
                move_uploaded_file($file['tmp_name'], $destination . '/' . $filename);

                $em = $this->getEntityManager();
                if (is_string($tipoMedia)) {
                    $tipoMedia = $this->getBasicTipoMedia($tipoMedia);
                }

                $media->setName($filename)
                    ->setPath($filename)
                    ->setTipoMedia($tipoMedia)
                    ->setAlt($name)
                    ->setCreatedAt(new \DateTime('now'))
                    ->setUpdatedAt(new \DateTime('now'))
                    ->setEntityName($entityName)
                    ->setEntityId($entityId)
                    ->setIsActive($isActive);
                $em->persist($media);
                $em->flush();
            }
        });
        return $media;
    }

    public function getBasicTipoMedia($tipoMedia) {
        return $this->get('bc.tipo.media.manager')->getBasic($tipoMedia);
    }

    public function hidrateByOption($entity, $tipoMedia = null, $isActive = true, $hidrate = true, $idMedia = null) {
        $em = $this->getEntityManager();
        return $em->getRepository(Entity::MEDIA)
            ->hidrateByOption($entity->getId(), $this->getEntityName($entity), $tipoMedia, $isActive, $hidrate, $idMedia);
    }

    public function hidrateById($entity, $idMedia, $isActive = true) {
        $em = $this->getEntityManager();
        $result = $em->getRepository(Entity::MEDIA)
            ->hidrateByOption($entity->getId(), $this->getEntityName($entity), null, $isActive, true, $idMedia);
        return !empty($result) ? $result[0] : [];
    }

    public function fileSendApp($filename, $tipoMedia, $entityName, $entityId, $isActive) {
        $media = new Media();
        $this->getConnection()->transactional(function () use ($media, $filename, $tipoMedia, $entityName, $entityId, $isActive) {
            $em = $this->getEntityManager();
            if (is_string($tipoMedia)) {
                $tipoMedia = $this->getBasicTipoMedia($tipoMedia);
            }
            $entity = $em->getRepository(Entity::MEDIA)
                ->findOneBy(['entityId' => $entityId, 'entityName' => $entityName,
                    'tipoMedia' => $tipoMedia, 'isActive' => $isActive]);
            if (!empty($entity)) {
                $this->remove($entity);
            }
            $media->setName($filename)
                ->setPath($filename)
                ->setTipoMedia($tipoMedia)
                ->setAlt($filename)
                ->setCreatedAt(new \DateTime('now'))
                ->setUpdatedAt(new \DateTime('now'))
                ->setEntityName($entityName)
                ->setEntityId($entityId)
                ->setIsActive($isActive);
            $em->persist($media);
            $em->flush();
        });
        return $media;
    }
}