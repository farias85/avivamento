<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Traits\LangTrait;
use AV\CommonBundle\Traits\RefTrait;
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
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
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
