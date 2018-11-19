<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Traits\ORM\RefTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Newsletter
 *
 * @ORM\Table(name="newsletter")
 * @ORM\Entity
 */
class Newsletter {

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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="confirm_at", type="datetime", nullable=true)
     */
    private $confirmAt;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_confirm", type="boolean", nullable=false)
     */
    private $isConfirm;

    /**
     * @var string
     *
     * @ORM\Column(name="opts", type="text", length=65535, nullable=false)
     */
    private $opts;


    /**
     * Factura constructor.
     */
    public function __construct() {
        $this->createdAt = new \DateTime('now');
        $this->ref = md5(uniqid(null, true));
        $this->isConfirm = false;
        $this->opts = '';
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getConfirmAt(): \DateTime {
        return $this->confirmAt;
    }

    /**
     * @param \DateTime $confirmAt
     */
    public function setConfirmAt(\DateTime $confirmAt) {
        $this->confirmAt = $confirmAt;
    }

    /**
     * @return string
     */
    public function getEmail(): string {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email) {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isConfirm(): bool {
        return $this->isConfirm;
    }

    /**
     * @param bool $isConfirm
     */
    public function setIsConfirm(bool $isConfirm) {
        $this->isConfirm = $isConfirm;
    }

    /**
     * @return string
     */
    public function getOpts(): string {
        return $this->opts;
    }

    /**
     * @param string $opts
     */
    public function setOpts(string $opts) {
        $this->opts = $opts;
    }
}
