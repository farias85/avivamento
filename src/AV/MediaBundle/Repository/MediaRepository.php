<?php
/**
 * Created by PhpStorm.
 * User: farias
 * Date: 3/29/2018
 * Time: 4:00 PM
 */

namespace AV\MediaBundle\Repository;


use Doctrine\ORM\EntityRepository;
use AV\CommonBundle\Util\Entity;

class MediaRepository extends EntityRepository {

    public function hidrateByOption($entityId, $entityName, $tipoMedia = null, $isActive = true, $hidrate = true, $idMedia = null) {
        $dql = '';
        $dql .= 'SELECT m, tm  FROM ' . Entity::MEDIA . ' m
        JOIN m.tipoMedia tm
        WHERE m.entityId = :entityId
        AND m.entityName = :entityName
        AND m.isActive = :isActive ';

        if (!empty($tipoMedia)) {
            if (is_string($tipoMedia)) {
                $dql .= ' AND tm.slug = :slug ';
            } else {
                $dql .= ' AND tm.id = :tmId ';
            }
        }

        if (!empty($idMedia)) {
            $dql .= ' AND m.id = :id ';
        }

        $dql .= 'ORDER BY m.createdAt DESC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);

        $query->setParameter('entityId', $entityId);
        $query->setParameter('entityName', $entityName);
        $query->setParameter('isActive', $isActive);

        if (!empty($tipoMedia)) {
            if (is_string($tipoMedia)) {
                $query->setParameter('slug', $tipoMedia);
            } else {
                $query->setParameter('tmId', $tipoMedia->getId());
            }
        }

        if (!empty($idMedia)) {
            $query->setParameter('id', $idMedia);
        }

        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }
}