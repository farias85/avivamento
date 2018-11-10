<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Traits\LangTrait;
use AV\CommonBundle\Traits\RefTrait;
use Doctrine\ORM\Mapping as ORM;
use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Util\Entity;

/**
 * Evento
 *
 * @ORM\Table(name="evento")
 * @ORM\Entity
 */
class Evento implements EntityNameExtension {

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
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="when", type="datetime", nullable=false)
     */
    private $when;

    /**
     * @var string
     *
     * @ORM\Column(name="where", type="text", length=65535, nullable=false)
     */
    private $where;

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

    /**
     * @var Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria", referencedColumnName="id", nullable=false)
     * })
     */
    private $categoria;

    function __construct() {
        $this->activo = false;
        $this->opts = '';
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Evento
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

    /**
     * @return Categoria
     */
    public function getCategoria(): Categoria {
        return $this->categoria;
    }

    /**
     * @param Categoria $categoria
     */
    public function setCategoria(Categoria $categoria) {
        $this->categoria = $categoria;
    }

    /**
     * @return \DateTime
     */
    public function getWhen(): \DateTime {
        return $this->when;
    }

    /**
     * @param \DateTime $when
     */
    public function setWhen(\DateTime $when) {
        $this->when = $when;
    }

    /**
     * @return string
     */
    public function getWhere(): string {
        return $this->where;
    }

    /**
     * @param string $where
     */
    public function setWhere(string $where) {
        $this->where = $where;
    }

    public function getEntityName() {
        return Entity::EVENTO;
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
