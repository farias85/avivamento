<?php

namespace AV\CommonBundle\Entity;

use AV\CommonBundle\Traits\RefORMTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Configuration
 *
 * @ORM\Table(name="configuracion")
 * @ORM\Entity(repositoryClass="AV\CommonBundle\Repository\ConfiguracionRepository")
 */
class Configuracion {

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
     * @var boolean
     *
     * @ORM\Column(name="requerido", type="boolean", nullable=false)
     */
    protected $requerido;

    function __construct() {
        $this->ref = md5(uniqid(null, true));
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
     * @return string
     */
    public function getClave(): string {
        return $this->clave;
    }

    /**
     * @param string || null $clave
     */
    public function setClave($clave) {
        if (is_string($clave)) { //El valor es null cuando el input clave está disabled en formulario del backend
            $this->clave = $clave;
        }
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

    /**
     * @return bool
     */
    public function isRequerido(): bool {
        return $this->requerido;
    }

    /**
     * @return bool
     */
    public function getRequerido(): bool {
        return $this->isRequerido();
    }

    /**
     * @param bool $requerido
     */
    public function setRequerido(bool $requerido) {
        $this->requerido = $requerido;
    }
}
