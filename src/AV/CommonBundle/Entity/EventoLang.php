<?php

namespace AV\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EventoLang
 *
 * @ORM\Table(name="evento_lang")
 * @ORM\Entity
 */
class EventoLang {
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
     * @ORM\Column(name="titulo", type="string", length=250, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitulo", type="string", length=250, nullable=true)
     */
    private $subtitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text", length=65535, nullable=false)
     */
    private $texto;

    /**
     * @var Evento
     *
     * @ORM\ManyToOne(targetEntity="AV\CommonBundle\Entity\Evento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evento", referencedColumnName="id", nullable=false)
     * })
     */
    private $evento;

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
     * @return string
     */
    public function getTitulo(): string {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo(string $titulo) {
        $this->titulo = $titulo;
    }

    /**
     * @return string
     */
    public function getSubtitulo(): string {
        return $this->subtitulo;
    }

    /**
     * @param string $subtitulo
     */
    public function setSubtitulo(string $subtitulo) {
        $this->subtitulo = $subtitulo;
    }

    /**
     * @return string
     */
    public function getTexto(): string {
        return $this->texto;
    }

    /**
     * @param string $texto
     */
    public function setTexto(string $texto) {
        $this->texto = $texto;
    }

    /**
     * Set lang
     *
     * @param \AV\CommonBundle\Entity\Lang $lang
     *
     * @return EventoLang
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
     * @return Evento
     */
    public function getEvento(): Evento {
        return $this->evento;
    }

    /**
     * @param Evento $evento
     */
    public function setEvento(Evento $evento) {
        $this->evento = $evento;
    }
}
