<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 04/07/2018
 * Time: 22:04
 */

namespace BC\ApiBundle\Manager;


use BC\CommonBundle\Manager\Manager;
use BC\CommonBundle\Util\Entity;

class ApiManager extends Manager {

    public function emailExist($email) {
        $em = $this->getEntityManager();
        $fail = ['exist' => false];
        $success = ['exist' => true];

        $demandante = $em->getRepository(Entity::DEMANDANTE)->findOneBy(['email' => $email]);
        if (!empty($demandante)) {
            $success['entity'] = Entity::DEMANDANTE;
            return $success;
        }
        $empresa = $em->getRepository(Entity::EMPRESA)->findOneBy(['email' => $email]);
        if (!empty($empresa)) {
            $success['entity'] = Entity::EMPRESA;
            return $success;
        }
        $cuidador = $em->getRepository(Entity::CUIDADOR)->findOneBy(['email' => $email]);
        if (!empty($cuidador)) {
            $success['entity'] = Entity::CUIDADOR;
            return $success;
        }

        $administrador = $em->getRepository(Entity::ADMINISTRADOR)->findOneBy(['email' => $email]);
        if (!empty($administrador)) {
            $success['entity'] = Entity::ADMINISTRADOR;
            return $success;
        }

        return $fail;
    }
}