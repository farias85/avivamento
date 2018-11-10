<?php

namespace BC\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documento
 *
 * @ORM\Table(name="documento")
 * @ORM\Entity(repositoryClass="BC\MediaBundle\Repository\DocumentoRepository")
 */
class Documento {
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
     * @var integer
     *
     * @ORM\Column(name="para_entity_id", type="integer", nullable=false)
     */
    private $paraEntityId;

    /**
     * @var string
     *
     * @ORM\Column(name="para_entity_name", type="string", length=250, nullable=false)
     */
    private $paraEntityName;

    /**
     * @var Media
     *
     * @ORM\ManyToOne(targetEntity="BC\MediaBundle\Entity\Media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media", referencedColumnName="id", nullable=false)
     * })
     */
    private $media;

    /**
     * @var string
     *
     * @ORM\Column(name="options", type="text", length=65535, nullable=false)
     */
    private $options;

    /**
     * Factura constructor.
     */
    public function __construct() {
        $this->createdAt = new \DateTime('now');
        $this->options = '';
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
     * @return int
     */
    public function getParaEntityId(): int {
        return $this->paraEntityId;
    }

    /**
     * @param int $paraEntityId
     */
    public function setParaEntityId(int $paraEntityId) {
        $this->paraEntityId = $paraEntityId;
    }

    /**
     * @return string
     */
    public function getParaEntityName(): string {
        return $this->paraEntityName;
    }

    /**
     * @param string $paraEntityName
     */
    public function setParaEntityName(string $paraEntityName) {
        $this->paraEntityName = $paraEntityName;
    }

    /**
     * @return Media
     */
    public function getMedia(): Media {
        return $this->media;
    }

    /**
     * @param Media $media
     */
    public function setMedia(Media $media) {
        $this->media = $media;
    }

    /**
     * @return string
     */
    public function getOptions(): string {
        return $this->options;
    }

    /**
     * @param string $options
     */
    public function setOptions(string $options) {
        $this->options = $options;
    }
}
