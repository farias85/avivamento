<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriaLang
 *
 * @ORM\Table(name="categoria_lang")
 * @ORM\Entity
 */
class CategoriaLang {
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
     * @var Categoria
     *
     * @ORM\ManyToOne(targetEntity="Categoria")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categoria", referencedColumnName="id", nullable=false)
     * })
     */
    private $categoria;

    /**
     * @var Lang
     *
     * @ORM\ManyToOne(targetEntity="Lang")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="lang", referencedColumnName="id", nullable=false)
     * })
     */
    private $lang;


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
     * @return CategoriaLang
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
     * @return CategoriaLang
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
     * @return CategoriaLang
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

    /**
     * Set lang
     *
     * @param \AV\CommonBundle\Entity\Lang $lang
     *
     * @return CategoriaLang
     */
    public function setLang(\AV\CommonBundle\Entity\Lang $lang = null) {
        $this->lang = $lang;

        return $this;
    }

    /**
     * Get lang
     *
     * @return \AV\CommonBundle\Entity\Lang
     */
    public function getLang() {
        return $this->lang;
    }

    /**
     * @return \AV\CommonBundle\Entity\Categoria
     */
    public function getCategoria(): \AV\CommonBundle\Entity\Categoria {
        return $this->categoria;
    }

    /**
     * @param \AV\CommonBundle\Entity\Categoria $categoria
     */
    public function setCategoria(\AV\CommonBundle\Entity\Categoria $categoria) {
        $this->categoria = $categoria;
    }
}
