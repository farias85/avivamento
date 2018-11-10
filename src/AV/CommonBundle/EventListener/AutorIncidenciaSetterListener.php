<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 12/08/2017
 * Time: 21:19
 */

namespace AV\CommonBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AV\CommonBundle\Extension\AutorIncidenciaExtension;
use AV\CommonBundle\Util\Util;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AutorIncidenciaSetterListener {

    /**
     * @var ContainerInterface
     */
    private $container;


    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if ($entity instanceof AutorIncidenciaExtension) {
            $autor = $this->container->get('av.incidencia.manager')->findAuthor($entity->getEntityName(), $entity->getEntityId());
            $entity->setAutor($autor);
        }
    }
}