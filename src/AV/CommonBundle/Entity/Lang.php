<?php

namespace AV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lang
 *
 * @ORM\Table(name="lang")
 * @ORM\Entity
 */
class Lang {
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
     * @ORM\Column(name="nombre", type="string", length=20, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="iso_code", type="string", length=20, nullable=false)
     */
    private $isoCode;

    /**
     * @var string
     *
     * @ORM\Column(name="language_code", type="string", length=20, nullable=false)
     */
    private $languageCode;

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @var boolean
     *
     * @ORM\Column(name="default_lang", type="boolean", nullable=false)
     */
    private $defaultLang;

    /**
     * @var string
     *
     * @ORM\Column(name="date_format_lite", type="string", length=20, nullable=true)
     */
    private $dateFormatLite;

    /**
     * @var string
     *
     * @ORM\Column(name="date_format_full", type="string", length=20, nullable=true)
     */
    private $dateFormatFull;

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
     * @return Lang
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

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
     * Set isoCode
     *
     * @param string $isoCode
     *
     * @return Lang
     */
    public function setIsoCode($isoCode) {
        $this->isoCode = $isoCode;

        return $this;
    }

    /**
     * Get isoCode
     *
     * @return string
     */
    public function getIsoCode() {
        return $this->isoCode;
    }

    /**
     * Set languageCode
     *
     * @param string $languageCode
     *
     * @return Lang
     */
    public function setLanguageCode($languageCode) {
        $this->languageCode = $languageCode;

        return $this;
    }

    /**
     * Get languageCode
     *
     * @return string
     */
    public function getLanguageCode() {
        return $this->languageCode;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return Lang
     */
    public function setActivo($activo) {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo() {
        return $this->activo;
    }

    /**
     * Set defaultLang
     *
     * @param boolean $defaultLang
     *
     * @return Lang
     */
    public function setDefaultLang($defaultLang) {
        $this->defaultLang = $defaultLang;

        return $this;
    }

    /**
     * Get defaultLang
     *
     * @return boolean
     */
    public function getDefaultLang() {
        return $this->defaultLang;
    }

    /**
     * Set dateFormatLite
     *
     * @param string $dateFormatLite
     *
     * @return Lang
     */
    public function setDateFormatLite($dateFormatLite) {
        $this->dateFormatLite = $dateFormatLite;

        return $this;
    }

    /**
     * Get dateFormatLite
     *
     * @return string
     */
    public function getDateFormatLite() {
        return $this->dateFormatLite;
    }

    /**
     * Set dateFormatFull
     *
     * @param string $dateFormatFull
     *
     * @return Lang
     */
    public function setDateFormatFull($dateFormatFull) {
        $this->dateFormatFull = $dateFormatFull;

        return $this;
    }

    /**
     * Get dateFormatFull
     *
     * @return string
     */
    public function getDateFormatFull() {
        return $this->dateFormatFull;
    }

    function __toString() {
        return $this->nombre;
    }
}
