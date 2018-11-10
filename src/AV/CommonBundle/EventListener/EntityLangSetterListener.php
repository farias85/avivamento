<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 12/08/2017
 * Time: 21:19
 */

namespace AV\CommonBundle\EventListener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use AV\CommonBundle\Util\Util;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntityLangSetterListener {

    /**
     * @var ContainerInterface
     */
    private $container;


    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();

        if (method_exists($entity, 'setEl')) {
            $glr = $this->container->get('av.glr');

            $entityName = Util::getEntityName($entity);
            $el = $glr->findLang($entity, $entityName);

            if (!empty($el)) {
                $entity->setEl($el);
            }
            if (method_exists($entity, 'setAny')) {
                if (!empty($el)) {
                    $entity->setAny($el);
                } else {
                    $el = $glr->findAnyLang($entity, $entityName, true);
                    $entity->setAny($el);
                }
            }
        } else {
            return;
        }
    }
}