<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AV\CommonBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AV\CommonBundle\Util\Util;
use AV\MediaBundle\Entity\Media;
use AV\MediaBundle\Entity\TipoMedia;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MediaSetterListener {

    /**
     * @var ContainerInterface
     */
    private $container;


    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setImage')) {
            $mediaManager = $this->container->get('av.media.manager');
            $tipoMedia = $mediaManager->getBasicTipoMedia(TipoMedia::IMAGEN);
            $media = $mediaManager->findOne($entity, $tipoMedia);

            if ($media instanceof Media && $media->getName() != $media->getPath()) {
                $media->setName($media->getPath());
                $em = $this->container->get('av.manager')->getEntityManager();
                $em->flush();
            }
            
            if (!empty($media)) {
                $entity->setImage($media);
            }
        }
        return;
    }
}
