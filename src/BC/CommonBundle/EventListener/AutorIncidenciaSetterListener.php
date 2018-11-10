<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 12/08/2017
 * Time: 21:19
 */

namespace BC\CommonBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use BC\CommonBundle\Extension\AutorIncidenciaExtension;
use BC\CommonBundle\Util\Util;
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
            $autor = $this->container->get('bc.incidencia.manager')->findAuthor($entity->getEntityName(), $entity->getEntityId());
            $entity->setAutor($autor);
        }
    }
}