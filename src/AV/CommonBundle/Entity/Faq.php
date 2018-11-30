<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Traits\LangTrait;
use AV\CommonBundle\Traits\ORM\RefTrait;
use AV\CommonBundle\Traits\TranslatesTrait;
use AV\CommonBundle\Util\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Faq
 *
 * @ORM\Table(name="faq")
 * @ORM\Entity
 */
class Faq implements EntityNameExtension {

    use LangTrait;
    use TranslatesTrait;
    use RefTrait;

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
        return Entity::FAQ;
    }

    function __toString() {
        if (!empty($this->getEl())) {
            return $this->getEl()->getNombre();
        } elseif (!empty($this->getAny())) {
            return $this->getAny()->getNombre();
        }
        return $this->getId() . '';
    }
}
