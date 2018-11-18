<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Traits\RefORMTrait;
use Doctrine\ORM\Mapping as ORM;
use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Util\Entity;

/**
 * Mensaje
 *
 * @ORM\Table(name="contacto")
 * @ORM\Entity
 */
class Contacto implements EntityNameExtension {

    use RefORMTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=250, nullable=false)
     */
    private $asunto;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text", length=65535, nullable=false)
     */
    private $texto;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=250, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=250, nullable=false)
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="leido", type="boolean", nullable=false)
     */
    protected $leido;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    protected $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="opts", type="text", length=65535, nullable=true)
     */
    private $opts;


    function __construct() {
        $this->leido = false;
        $this->activo = false;
        $this->asunto = '';
        $this->opts = '';
        $this->ref = md5(uniqid(null, true));
        $this->createdAt = new \DateTime('now');
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return Contacto
     */
    public function setAsunto($asunto) {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto() {
        return $this->asunto;
    }

    /**
     * Set texto
     *
     * @param string $texto
     *
     * @return Contacto
     */
    public function setTexto($texto) {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto() {
        return $this->texto;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Contacto
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * @return bool
     */
    public function isLeido(): bool {
        return $this->leido;
    }

    /**
     * @param bool $leido
     */
    public function setLeido(bool $leido) {
        $this->leido = $leido;
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

    /**
     * @return string
     */
    public function getNombre(): string {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre(string $nombre) {
        $this->nombre = $nombre;
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

    public function getEntityName() {
        return Entity::CONTACTO;
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

    function __toString() {
        return $this->getNombre() . ':' . $this->getAsunto();
    }
}
