<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 10/11/2018
 * Time: 10:08
 */

namespace AV\CommonBundle\Traits;


trait RefTrait {

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=100, nullable=false)
     */
    protected $ref;

    /**
     * @return string
     */
    public function getRef() {
        return $this->ref;
    }

    /**
     * @param string $ref
     */
    public function setRef(string $ref) {
        $this->ref = $ref;
    }

}