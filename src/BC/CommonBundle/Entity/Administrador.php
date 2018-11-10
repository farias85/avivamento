<?php

namespace BC\CommonBundle\Entity;

use BC\CommonBundle\Extension\EntityNameExtension;
use BC\CommonBundle\Traits\ImageTrait;
use BC\CommonBundle\Traits\UserTrait;
use BC\CommonBundle\Util\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador")
 * @ORM\Entity
 */
class Administrador implements EntityNameExtension, AdvancedUserInterface, \Serializable {

    use ImageTrait;
    use UserTrait;

    const ROLE_DEFAULT = 'ROLE_ADMIN';

    public function __construct() {
        $this->isActive = false;
        $this->isConfirm = false;
        $this->ref = md5(uniqid(null, true));
        $this->verificationKey = md5(uniqid(null, true));
    }

    public function getEntityName() {
        return Entity::ADMINISTRADOR;
    }

    public function __toString() {
        return $this->getName() . ' ' . $this->getLastname();
    }
}
