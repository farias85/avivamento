<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 16/09/2018
 * Time: 12:40
 */

namespace AV\CommonBundle\Traits;


trait LangTrait {

    /**
     * The Entity Lang
     * @var mixed
     */
    private $el;

    /**
     * The Any Entity Lang
     * @var mixed
     */
    private $any;

    /**
     * @return mixed
     */
    public function getEl() {
        return $this->el;
    }

    /**
     * @param mixed $el
     */
    public function setEl($el) {
        $this->el = $el;
    }

    /**
     * @return mixed
     */
    public function getAny() {
        return $this->any;
    }

    /**
     * @param mixed $any
     */
    public function setAny($any) {
        $this->any = $any;
    }
}