<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Traits\RefTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Configuration
 *
 * @ORM\Table(name="configuracion")
 * @ORM\Entity
 */
class Configuracion {

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
     * @var string
     *
     * @ORM\Column(name="clave", type="string", length=250, nullable=false)
     */
    private $clave;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="text", length=65535, nullable=false)
     */
    private $valor;

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
    public function getClave(): string {
        return $this->clave;
    }

    /**
     * @param string $clave
     */
    public function setClave(string $clave) {
        $this->clave = $clave;
    }

    /**
     * @return string
     */
    public function getValor(): string {
        return $this->valor;
    }

    /**
     * @param string $valor
     */
    public function setValor(string $valor) {
        $this->valor = $valor;
    }
}
