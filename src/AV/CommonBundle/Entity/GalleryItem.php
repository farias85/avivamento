<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Traits\ImageTrait;
use AV\CommonBundle\Traits\PathTrait;
use AV\CommonBundle\Traits\RefTrait;
use AV\CommonBundle\Util\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 *
 * @ORM\Table(name="gallery_item")
 * @ORM\Entity
 */
class GalleryItem implements EntityNameExtension {

    use RefTrait;
    use ImageTrait;
    use PathTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    protected $activo;

    public function __construct() {
        $this->ref = md5(uniqid(null, true));
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }


    /**
     * @return bool
     */
    public function isActivo(): bool {
        return $this->activo;
    }

    /**
     * @return bool
     */
    public function getActivo(): bool {
        return $this->isActivo();
    }

    /**
     * @param bool $activo
     */
    public function setActivo(bool $activo) {
        $this->activo = $activo;
    }

    public function getEntityName() {
        return Entity::GALLERY_ITEM;
    }
}
