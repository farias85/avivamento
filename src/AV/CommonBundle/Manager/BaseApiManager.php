<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 08/09/2017
 * Time: 10:40
 */

namespace AV\CommonBundle\Manager;

use AV\CommonBundle\Util\Util;

class BaseApiManager extends Manager {

    public function save($data, \Closure $beforeFlush = null) {

        if (!empty($data['sfFullEntityName'])) {
            $fullEntityName = $data['sfFullEntityName'];
        } else {
            throw new \InvalidArgumentException('The sfFullEntityName key in $data var is not present');
        }

        $entity = new $fullEntityName();

        $this->getConnection()->transactional(function () use ($entity, $data, $beforeFlush) {
            $em = $this->getEntityManager();

            $exist = $this->get('av.entitysetter')->fromData($entity, $data);

            if (!empty($beforeFlush)) {
                $beforeFlush($entity, $data);
            }

            $em->persist($entity);
            $em->flush($entity);

            if ($exist == false) {
                $em->persist($entity->getEl());
            }
            $em->flush();
        });

        return $entity;
    }


    public function edit($entity, $data, \Closure $beforeFlush = null) {
        $this->getConnection()->transactional(function () use ($entity, $data, $beforeFlush) {

            $em = $this->getEntityManager();
            $existe = $this->get('av.entitysetter')->fromData($entity, $data);

            if (!empty($beforeFlush)) {
                $beforeFlush($entity, $data);
            }

            if ($existe == false) {
                $em->persist($entity->getEl());
            }

            $em->flush();
        });
    }

    public function remove($entity, \Closure $beforeFlush = null) {
        $this->getConnection()->transactional(function () use ($entity, $beforeFlush) {
            $em = $this->getEntityManager();

            $hasEl = method_exists($entity, 'getEl') && method_exists($entity, 'setEl');

            if ($hasEl) {
                $entityName = Util::getClass($entity);
                $simpleEntityName = lcfirst(Util::getClass($entity, false));

                $langs = $em->getRepository($entityName . 'Lang')->findBy([$simpleEntityName => $entity]);
                if (!empty($langs)) {
                    foreach ($langs as $item) {
                        $em->remove($item);
                        $em->flush($item);
                    }
                }
            }

            if (!empty($beforeFlush)) {
                $beforeFlush($entity);
            }

            $em->remove($entity);
            $em->flush($entity);
        });
    }
}