<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 06/12/2017
 * Time: 9:51
 */

namespace AV\CommonBundle\Manager;


use AV\CommonBundle\Entity\Configuracion;
use AV\CommonBundle\Util\Entity;


class ConfiguracionManager extends Manager {

    /**
     * @param string $clave
     * @param null $valor
     * @return string
     * @throws \InvalidArgumentException
     */
    public function get($clave, $valor = null) {
        $em = $this->getEntityManager();
        $configuration = $em->getRepository(Entity::CONFIGURACION)->findOneBy(['clave' => $clave]);
        if (!empty($configuration)) {
            if (!is_null($valor)) {
                $configuration->setValor($valor);
                $em->flush();
            }
            return $configuration->getValor();
        }

        $configuration = new Configuracion();
        $configuration->setClave($clave);
        $configuration->setValor($valor);

        if (is_null($configuration->getValor())) {
            throw new \InvalidArgumentException('Attempt to create a configuration key without any value');
        }

        $em->persist($configuration);
        $em->flush();

        return $configuration->getValor();
    }


}