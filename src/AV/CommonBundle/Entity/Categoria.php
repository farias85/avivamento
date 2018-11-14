<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Traits\LangTrait;
use AV\CommonBundle\Traits\RefTrait;
use AV\CommonBundle\Traits\TranslatesTrait;
use Doctrine\ORM\Mapping as ORM;
use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Util\Entity;

/**
 * Categoria
 *
 * @ORM\Table(name="categoria")
 * @ORM\Entity
 */
class Categoria implements EntityNameExtension {

    use LangTrait;
    use RefTrait;
    use TranslatesTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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

    function __toString() {
        if (!empty($this->getEl())) {
            return $this->getEl()->getNombre();
        } elseif (!empty($this->getAny())) {
            return $this->getAny()->getNombre();
        }
        return $this->getId() . '';
    }

    public function getEntityName() {
        return Entity::CATEGORIA;
    }
}
