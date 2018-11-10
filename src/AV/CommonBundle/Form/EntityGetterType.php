<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 03/09/2017
 * Time: 9:47
 */

namespace AV\CommonBundle\Form;

use AV\CommonBundle\Service\EntityGetter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EntityGetterType extends AbstractType {

    /**
     * @var mixed
     */
    protected $entity;

    /**
     * @var EntityGetter
     */
    protected $getter;

    /**
     * @var array Con las traducciones de los elementos enviados desde elc ontrolador
     */
    protected $display;

    /**
     * @var array Se utiliza para setear los campos del formulario que no tienen correspondencia con los atributos
     * de la clase entidad
     */
    protected $values;

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $this->setOptions($options);
    }

    public function setOptions($options = array()) {
        $entity = null;
        $display = null;
        $values = null;
        if (!empty($options['data'])) {
            if (!empty($options['data']['entity'])) {
                $entity = $options['data']['entity'];
            }
            if (!empty($options['data']['display'])) {
                $display = $options['data']['display'];
            }
            if (!empty($options['data']['values'])) {
                $values = $options['data']['values'];
            }
        }
        $this->display = $display;
        $this->entity = $entity;
        $this->values = $values;
        $this->getter = new EntityGetter($this->entity);
    }

    public function display($attr) {
        if (!empty($this->display[$attr])) {
            return $this->display[$attr];
        }
        return '';
    }

    /**
     * @param $attr
     * @return mixed
     * @throws \Exception
     */
    public function get($attr) {
        if (empty($this->getter)) {
            throw new \InvalidArgumentException('The getter attr has not been initialized');
        }
        $result = $this->getter->get($attr);
        return $result === '' && !empty($this->values[$attr]) ? $this->values[$attr] : $result;
    }

    /**
     * @param \DateTime $date
     * @return string
     */
    public function getDateText($date) {
        return (!empty($date)) ? $date->format('Y-m-d') : '';
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getEntity() {
        if (empty($this->entity)) {
            throw new \InvalidArgumentException('The entity attr has not been initialized');
        }
        return $this->entity;
    }
}