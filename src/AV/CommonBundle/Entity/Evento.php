<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Extension\EntityNameExtension;
use AV\CommonBundle\Traits\ImagePathTrait;
use AV\CommonBundle\Traits\LangTrait;
use AV\CommonBundle\Traits\RefORMTrait;
use AV\CommonBundle\Traits\TranslatesTrait;
use AV\CommonBundle\Util\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Evento
 *
 * @ORM\Table(name="evento")
 * @ORM\Entity
 */
class Evento implements EntityNameExtension {

    use LangTrait;
    use RefORMTrait;
    use ImagePathTrait;
    use TranslatesTrait;

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
     * @ORM\Column(name="when_start", type="datetime", nullable=false)
     */
    private $whenStart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="when_end", type="datetime", nullable=false)
     */
    private $whenEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="where_place", type="text", length=65535, nullable=false)
     */
    private $wherePlace;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    protected $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="youtube_url", type="string", length=250, nullable=false)
     */
    private $youtubeUrl;

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
        $this->ref = md5(uniqid(null, true));
        $this->activo = false;
        $this->createdAt = new \DateTime('now');
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
     * @return string
     */
    public function getWherePlace(): string {
        return $this->wherePlace;
    }

    /**
     * @param string $wherePlace
     */
    public function setWherePlace(string $wherePlace) {
        $this->wherePlace = $wherePlace;
    }

    /**
     * @return \DateTime
     */
    public function getWhenStart(): \DateTime {
        return $this->whenStart;
    }

    /**
     * @param \DateTime $whenStart
     */
    public function setWhenStart(\DateTime $whenStart) {
        $this->whenStart = $whenStart;
    }

    /**
     * @return \DateTime
     */
    public function getWhenEnd(): \DateTime {
        return $this->whenEnd;
    }

    /**
     * @param \DateTime $whenEnd
     */
    public function setWhenEnd(\DateTime $whenEnd) {
        $this->whenEnd = $whenEnd;
    }

    /**
     * @return string
     */
    public function getYoutubeUrl(): string {
        return $this->youtubeUrl;
    }

    /**
     * @param string $youtubeUrl
     */
    public function setYoutubeUrl(string $youtubeUrl) {
        $this->youtubeUrl = $youtubeUrl;
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
