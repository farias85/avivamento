<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Traits\ImageTrait;
use AV\CommonBundle\Traits\ORM\UserTrait;
use AV\CommonBundle\Util\Entity;
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
