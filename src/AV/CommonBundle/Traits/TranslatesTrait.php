<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 16/09/2018
 * Time: 12:39
 */

namespace AV\CommonBundle\Traits;


trait TranslatesTrait {

    /**
     * @var string
     */
    private $translates;

    /**
     * @return string
     */
    public function getTranslates(): string {
        return $this->translates;
    }

    /**
     * @param string $translates
     */
    public function setTranslates(string $translates) {
        $this->translates = $translates;
    }
}