<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 16/09/2018
 * Time: 12:36
 */

namespace BC\CommonBundle\Traits;


trait ImageTrait {

    /**
     * @var \BC\MediaBundle\Entity\Media
     */
    private $image;

    /**
     * @return \BC\MediaBundle\Entity\Media
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param \BC\MediaBundle\Entity\Media $image
     */
    public function setImage(\BC\MediaBundle\Entity\Media $image) {
        $this->image = $image;
    }
}