<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AV\CommonBundle\EventListener;

use AV\MediaBundle\Entity\TipoMedia;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;

class YoutubeUrlsSetterListener {

    /**
     * @var ContainerInterface
     */
    private $container;


    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setYoutubeUrls')) {
            $medias = $this->container->get('av.media.manager')->findMany($entity, TipoMedia::YOUTUBE_URL);
            if (!empty($media)) {
                $urls = [];
                foreach ($medias as $url) {
                    $urls[] = $url->getName();
                }
                $entity->setYoutubeUrls($urls);
            }
        }
        return;
    }
}
