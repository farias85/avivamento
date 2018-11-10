<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 13/02/2018
 * Time: 15:51
 */

namespace AV\CommonBundle\Controller;


abstract class UniqueNomenclatureController extends NomenclatureController {

    /**
     * Define los atributos de la clase que no se pueden repetir
     * @return mixed array ['nombre', 'ci']
     */
    public abstract function keysUnique();

    public function newActionIsFormValid($fullEntityName, $data) {
        $uniques = $this->keysUnique();
        $em = $this->getDoctrine()->getManager();

        $entity = new $fullEntityName();
        $hasEl = method_exists($entity, 'getEl') && method_exists($entity, 'setEl');
        $this->get('av.entitysetter')->fromData($entity, $data);

        foreach ($uniques as $attr) {
            $exist = false;

            $aux = ucfirst($attr);
            $setMethod = 'set' . $aux;
            $getMethod = 'get' . $aux;

            if (method_exists($entity, $setMethod)) {
                $exist = $em->getRepository($this->getEntityName())->findOneBy([$attr => $entity->$getMethod()]);
            }

            if (empty($exist) and $hasEl and method_exists($entity->getEl(), $setMethod)) {
                $lang = $this->get('av.manager')->getRequestLang();
                $exist = $em->getRepository($this->getEntityName() . 'Lang')
                    ->findOneBy([$attr => $entity->getEl()->$getMethod(), 'lang' => $lang]);
            }

            if (!empty($exist)) {
                $words = preg_split("/[:]/", $this->getEntityName());
                $simpleEntityName = $words[1];
                $message = $this->get('translator')->trans('operation.new.fail', [
                    '%clazz%' => $simpleEntityName,
                    '%attr%' => $attr,
                    '%value%' => $hasEl ? $entity->getEl()->$getMethod() : $entity->$getMethod(),
                ], 'common');
                return ['valid' => false, 'error' => $message];
            }
        }
        return ['valid' => true];
    }

    public function editActionIsFormValid($entity) {
        $uniques = $this->keysUnique();
        $em = $this->getDoctrine()->getManager();

        $hasEl = method_exists($entity, 'getEl') && method_exists($entity, 'setEl');

        foreach ($uniques as $attr) {
            $exist = false;

            $aux = ucfirst($attr);
            $setMethod = 'set' . $aux;
            $getMethod = 'get' . $aux;

            if (method_exists($entity, $setMethod)) {
                $exist = $em->getRepository($this->getEntityName())->findBy([$attr => $entity->$getMethod()]);
                if (!empty($exist)) {
                    foreach ($exist as $item) {
                        if ($item->getId() != $entity->getId() and $entity->$getMethod() == $item->$getMethod()) {
                            $exist = true;
                            break;
                        }
                    }
                }
            }

            if (empty($exist) and $hasEl) {
                $el = $entity->getEl();
                if (!empty($el) and method_exists($el, $setMethod)) {
                    $lang = $this->get('av.manager')->getRequestLang();
                    $exist = $em->getRepository($this->getEntityName() . 'Lang')->findBy([$attr => $el->$getMethod(), 'lang' => $lang]);
                    if (!empty($exist)) {
                        foreach ($exist as $item) {
                            if ($item->getId() != $el->getId() and $el->$getMethod() == $item->$getMethod()) {
                                $exist = true;
                                break;
                            }
                        }
                    }
                }
            }

            if (!empty($exist)) {
                $words = preg_split("/[:]/", $this->getEntityName());
                $simpleEntityName = $words[1];
                $message = $this->get('translator')->trans('operation.edit.fail', [
                    '%clazz%' => $simpleEntityName,
                    '%attr%' => $attr,
                    '%value%' => $hasEl ? $entity->getEl()->$getMethod() : $entity->$getMethod(),
                ], 'common');
                return ['valid' => false, 'error' => $message];
            }
        }
        return ['valid' => true];
    }
}