<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 30/03/2018
 * Time: 10:17
 */

namespace AV\MediaBundle\Manager;


use AV\CommonBundle\Manager\Manager;
use AV\CommonBundle\Util\Entity;
use AV\MediaBundle\Entity\TipoMedia;

class TipoMediaManager extends Manager {

    public function getBasic($slug) {
        $em = $this->getEntityManager();
        if ($slug == TipoMedia::IMAGEN ||
            $slug == TipoMedia::YOUTUBE_URL ||
            $slug == TipoMedia::GALERIA_EVENTO
        ) {
            $tipo = $em->getRepository(Entity::TIPO_MEDIA)->findOneBy(['slug' => $slug]);
            if (empty($tipo)) {
                $aux = new TipoMedia();
                $aux->setNombre($slug)->setDescripcion($slug);
                $em->persist($aux);
                $em->flush();
                return $aux;
            }
            return $tipo;
        }
        throw new \UnexpectedValueException('El slug ' . $slug . 'no es de un tipo de media por defecto');
    }
}