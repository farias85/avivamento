<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 10/08/2017
 * Time: 9:33
 */

namespace BC\CommonBundle\Service;


class ObjectLangGetter {

    /**
     * @var ObjectLang
     */
    private $ol;

    /**
     * ObjectLangGetter constructor.
     * @param $ol
     */
    public function __construct($ol) {
        $this->ol = $ol;
    }

    /**
     * @return ObjectLang
     */
    public function getOl(): ObjectLang {
        return $this->ol;
    }

    /**
     * @param ObjectLang $ol
     */
    public function setOl(ObjectLang $ol) {
        $this->ol = $ol;
    }

    public function get($attr) {
        if (empty($this->ol)) {
            return '';
        }

        $data = $this->ol->getData();
        $dataLang = $this->ol->getDataLang();
        if (empty($data)) {
            return '';
        }

        $attr = ucfirst($attr);
        $method = 'get' . $attr;
        if (method_exists($data, $method)) {
            return $data->$method();
        }

        if (empty($dataLang)) {
            return '';
        }
        if (method_exists($dataLang, $method)) {
            return $dataLang->$method();
        }

        return '';
    }
}