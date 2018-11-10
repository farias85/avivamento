<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;

/**
 * FaqLang
 *
 * @ORM\Table(name="faq_lang")
 * @ORM\Entity
 */
class FaqLang {
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
     * @ORM\Column(name="pregunta", type="string", length=250, nullable=true)
     */
    private $pregunta;

    /**
     * @var string
     *
     * @ORM\Column(name="respuesta", type="text", length=65535, nullable=false)
     */
    private $respuesta;

    /**
     * @var Faq
     *
     * @ORM\ManyToOne(targetEntity="AV\CommonBundle\Entity\Faq")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="faq", referencedColumnName="id", nullable=false)
     * })
     */
    private $faq;

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
    public function getPregunta(): string {
        return $this->pregunta;
    }

    /**
     * @param string $pregunta
     */
    public function setPregunta(string $pregunta) {
        $this->pregunta = $pregunta;
    }

    /**
     * @return string
     */
    public function getRespuesta(): string {
        return $this->respuesta;
    }

    /**
     * @param string $respuesta
     */
    public function setRespuesta(string $respuesta) {
        $this->respuesta = $respuesta;
    }

    /**
     * @return Faq
     */
    public function getFaq(): Faq {
        return $this->faq;
    }

    /**
     * @param Faq $faq
     */
    public function setFaq(Faq $faq) {
        $this->faq = $faq;
    }

    /**
     * Set lang
     *
     * @param \AV\CommonBundle\Entity\Lang $lang
     *
     * @return FaqLang
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
}
