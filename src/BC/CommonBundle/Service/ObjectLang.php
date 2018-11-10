<?php
/**
 * Created by PhpStorm.
 * User: farias
 * Date: 30/04/2017
 * Time: 15:52
 */

namespace BC\CommonBundle\Service;

use BC\CommonBundle\Entity\Lang;

class ObjectLang {
    /**
     * @var mixed
     */
    private $data;

    /**
     * @var mixed
     */
    private $dataLang;

    /**
     * @var Lang
     */
    private $lang;

    /**
     * ArrayLang constructor.
     * @param mixed $data
     * @param mixed $dataLang
     * @param Lang $lang
     */
    public function __construct($data, $dataLang, Lang $lang) {
        $this->data = $data;
        $this->dataLang = $dataLang;
        $this->lang = $lang;
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
     * @return mixed
     */
    public function getDataLang() {
        return $this->dataLang;
    }

    /**
     * @param mixed $dataLang
     */
    public function setDataLang($dataLang) {
        $this->dataLang = $dataLang;
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