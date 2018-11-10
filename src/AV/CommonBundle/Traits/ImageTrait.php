<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 16/09/2018
 * Time: 12:36
 */

namespace AV\CommonBundle\Traits;


trait ImageTrait {

    /**
     * @var \AV\MediaBundle\Entity\Media
     */
    private $image;

    /**
     * @return \AV\MediaBundle\Entity\Media
     */
    public function getImage() {
        return $this->image;
    }

    /**
     * @param \AV\MediaBundle\Entity\Media $image
     */
    public function setImage(\AV\MediaBundle\Entity\Media $image) {
        $this->image = $image;
    }
}