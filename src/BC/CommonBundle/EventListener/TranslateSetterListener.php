<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 09/08/2017
 * Time: 18:52
 */

namespace BC\CommonBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Event\LifecycleEventArgs;
use BC\CommonBundle\Util\Util;
use Symfony\Component\DependencyInjection\ContainerInterface;


class TranslateSetterListener {

    public function postLoad(LifecycleEventArgs $args) {
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if (method_exists($entity, 'setTranslates')) {
            $entityName = Util::getEntityName($entity);
            $words = preg_split("/[:]/", $entityName);
            $simpleEntityName = lcfirst($words[1]);

            $query = $em->createQuery(
                'SELECT lang.isoCode
                FROM ' . $entityName . 'Lang enl
                JOIN enl.lang lang
                JOIN enl.' . $simpleEntityName . ' en
                WHERE en.id = :enId
                ORDER BY lang.id ASC'
            );
            $query->setParameter('enId', $entity->getId());
            $translates = $query->getResult();

            $result = '';
            for ($i = 0; $i < sizeof($translates); $i++) {
                $item = $translates[$i];
                $result .= $item['isoCode'] . ' | ';
            }
            $result = substr($result, 0, strlen($result) - 3);
            $entity->setTranslates($result);
        } else {
            return;
        }
    }
}