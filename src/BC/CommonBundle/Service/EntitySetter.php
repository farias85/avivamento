<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03/09/2017
 * Time: 9:39
 */

namespace BC\CommonBundle\Service;


use BC\CommonBundle\Util\Util;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EntitySetter {

    private $container;

    /**
     * EntitySetter constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * @param $entity mixed
     * @param $data mixed El getData de los formularios
     * @param $lang mixed lang que se va a setear en el entityLang (el)
     * @return bool False en caso que no exista el dataLang asociado al data y que se haya creado. En este caso
     * Se hace necesario guardar el dataLang $em->persist($ol->getDataLang()); y luego $em->flush();
     */
    public function fromData($entity, $data, $lang = null) {
        $entityName = Util::getClass($entity, false);
        $existe = true;

        $hasEl = method_exists($entity, 'getEl') && method_exists($entity, 'setEl');

        //solo entra aqui si la entidad tiene un lang, para otro tipo de entidades
        //siempre existe = true y hasEl = false por lo que no entra en este if
        if ($hasEl && empty($entity->getEl())) {
            $dir = 'BC\CommonBundle\Entity\\';
            $entityNameLang = $dir . $entityName . 'Lang';
            $entity->setEl(new $entityNameLang());
            $existe = false;
        }

        foreach ($data as $key => $value) {
            $attr = ucfirst($key);
            $method = 'set' . $attr;
            if (method_exists($entity, $method)) {
                $entity->$method($value);
                continue;
            }

            if ($hasEl && method_exists($entity->getEl(), $method)) {
                $entity->getEl()->$method($value);
            }
        }

        //solo entra aqui si la entidad tiene un lang, para otro tipo de entidades
        //siempre existe = true y hasEl = false por lo que no entra en este if
        $setMethod = 'set' . $entityName;
        if ($hasEl && method_exists($entity->getEl(), $setMethod)) {
            $entity->getEl()->$setMethod($entity);
        }
        if ($hasEl && method_exists($entity->getEl(), 'setLang')) {
            if (empty($lang)) {
                $lang = $this->container->get('bc.manager')->getRequestLang();
            }
            $entity->getEl()->setLang($lang);
        }

        return $existe;
    }

}