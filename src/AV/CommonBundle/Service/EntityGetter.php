<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03/09/2017
 * Time: 9:38
 */

namespace AV\CommonBundle\Service;


class EntityGetter {

    /**
     * @var mixed
     */
    private $entity;

    /**
     * EntityLangGetter constructor.
     * @param mixed $entity
     */
    public function __construct($entity) {
        $this->entity = $entity;
    }

    /**
     * @return mixed
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * @param mixed $entity
     */
    public function setEntity($entity) {
        $this->entity = $entity;
    }

    /**
     * @param $attr mixed
     * @return mixed
     */
    public function get($attr) {
        if (empty($this->entity)) {
            return '';
        }

        $attr = ucfirst($attr);
        $method = 'get' . $attr;
        if (method_exists($this->entity, $method)) {
            return $this->entity->$method();
        }

        if (method_exists($this->entity, 'getEl')) {
            $entityLang = $this->entity->getEl();
            if (empty($entityLang)) {
                return '';
            }
            if (method_exists($entityLang, $method)) {
                return $entityLang->$method();
            }
        }

        return '';
    }
}