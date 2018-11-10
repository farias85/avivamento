<?php
/**
 * Created by PhpStorm.
 * User: farias
 * Date: 3/29/2018
 * Time: 4:00 PM
 */

namespace BC\MediaBundle\Repository;


use Doctrine\ORM\EntityRepository;
use BC\CommonBundle\Util\Entity;

class DocumentoRepository extends EntityRepository {

    public function hidrateByOption($ownerEntityId, $ownerEntityName, $toEntityId, $toEntityName, $tipoMedia = null, $isActive = true, $hidrate = true, $idMedia = null) {
        $dql = '';
        $dql .= 'SELECT d, m, tm  FROM ' . Entity::DOCUMENTO . ' d
        JOIN d.media m
        JOIN m.tipoMedia tm
        WHERE d.paraEntityId = :toEntityId
        AND d.paraEntityName = :toEntityName
        AND m.entityId = :ownerEntityId
        AND m.entityName = :ownerEntityName
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

        $query->setParameter('toEntityId', $toEntityId);
        $query->setParameter('toEntityName', $toEntityName);

        $query->setParameter('ownerEntityId', $ownerEntityId);
        $query->setParameter('ownerEntityName', $ownerEntityName);
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