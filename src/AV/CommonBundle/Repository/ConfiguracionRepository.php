<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 11/11/2018
 * Time: 14:44
 */

namespace AV\CommonBundle\Repository;


use AV\CommonBundle\Util\Entity;
use Doctrine\ORM\EntityRepository;

class ConfiguracionRepository extends EntityRepository {

    public function getValues(array $keys, $hidrate = false) {
        if (!is_array($keys)) {
            return [];
        }

        $dql = "";
        $dql .= 'SELECT c FROM ' . Entity::CONFIGURACION . ' c            
            WHERE 2 > 1 ';

        if (!empty($keys)) {
            $dqlAux = '';
            $size = sizeof($keys);
            $count = 1;
            foreach ($keys as $index => $value) {
                $dqlAux .= $size != $count ? ' c.clave = :clave' . $index . ' OR ' : ' c.clave = :clave' . $index . ' ';
                $count++;
            }
            $dql .= ' AND (' . $dqlAux . ') ';
        }

        $dql .= 'ORDER BY c.id ASC';
        $em = $this->getEntityManager();
        $query = $em->createQuery($dql);

        if (!empty($keys)) {
            foreach ($keys as $index => $value) {
                $query->setParameter('clave' . $index, $value);
            }
        }

        return $hidrate ? $query->getArrayResult() : $query->getResult();
    }
}