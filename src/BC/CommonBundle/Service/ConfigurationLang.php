<?php
/**
 * Created by PhpStorm.
 * User: farias
 * Date: 30/04/2017
 * Time: 15:16
 */

namespace BC\CommonBundle\Service;

use BC\CommonBundle\Entity\Lang;
use BC\CommonBundle\Util\Util;

abstract class ConfigurationLang {

    /**
     * @var mixed: Objeto o arreglo de una consulta Doctrine
     */
    private $data;

    /**
     * @var Lang: Instancia del lenguaje que se quiere obtener
     */
    private $lang;

    /**
     * @var string
     */
    private $entity;

    /**
     * ConfLang constructor.
     * @param string $data
     * @param Lang $lang
     */
    public function __construct($data, Lang $lang) {
        $this->data = $data;
        $this->lang = $lang;

        $obj = is_array($this->data) ? $this->data[0] : $this->data;
        $this->entity = Util::getClass($obj);
    }

    /**
     * @return string
     */
    public function getEntity() {
        return $this->entity;
    }

    /**
     * @param string $entity
     */
    public function setEntity(string $entity) {
        $this->entity = $entity;
    }

    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * @return Lang
     */
    public function getLang() {
        return $this->lang;
    }

    /**
     * @param Lang $lang
     */
    public function setLang($lang) {
        $this->lang = $lang;
    }
}