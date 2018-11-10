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
            $slug == TipoMedia::CERTIFICADO_PENALES ||
            $slug == TipoMedia::DOCUMENTO_ESTUDIO ||
            $slug == TipoMedia::VIDEO_PERFIL ||
            $slug == TipoMedia::NOMINA ||
            $slug == TipoMedia::FACTURA ||
            $slug == TipoMedia::CONTRATO ||
            $slug == TipoMedia::PROTOCOLO ||
            $slug == TipoMedia::DOCUMENTO ||
            $slug == TipoMedia::CURRICULUM ||
            $slug == TipoMedia::CERTIFICADO_MEDICO
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