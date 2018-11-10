<?php

namespace BC\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use BC\CommonBundle\Util\Util;

/**
 * TipoMedia
 *
 * @ORM\Table(name="tipo_media")
 * @ORM\Entity
 */
class TipoMedia {

    const IMAGEN = "imagen";
    const VIDEO_PERFIL = "video-perfil";
    const DOCUMENTO_ESTUDIO = "documento-estudio";
    const CERTIFICADO_PENALES = "certificado-penales";
    const NOMINA = "nomina";
    const FACTURA = "factura";
    const CONTRATO = "contrato";
    const PROTOCOLO = "protocolo";
    const DOCUMENTO = "documento";
    const CURRICULUM = "curriculum";
    const CERTIFICADO_MEDICO = "certificado-medico";

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
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=false)
     */
    private $slug;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return TipoMedia
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        $this->slug = Util::getSlug($nombre);

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return TipoMedia
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TipoMedia
     */
    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion() {
        return $this->descripcion;
    }
}
