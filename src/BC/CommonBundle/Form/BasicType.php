<?php

namespace BC\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;

class BasicType extends AbstractType {
    /**
     * @param $start
     * @param $finish
     * @param string $prefix
     * @param string $sufix
     * @param int $step
     * @return array
     */
    public static function getChoice($start, $finish, $prefix = '', $sufix = '', $step = 1) {
        $result = [];
        if (is_integer($finish) && is_integer($start)) {
            $rangeLast = $start + $finish;
            for ($i = $start; $i < $rangeLast; $i += $step) {
                $result['' . $i] = trim($prefix . ' ' . $i . ' ' . $sufix);
            }
        }
        return $result;
    }

    /**
     * Devuelve los valores básicos de un choice numérico para seleccionar cantidades
     * @param $count integer
     * @return array
     */
    public static function getBasicChoice($count) {
        return static::getChoice(0, $count);
    }

    public static function getQuantityChoice($count) {
        return static::getChoice(1, $count);
    }

    public static function getHoursChoice() {
        $result = [];
        for ($i = 0; $i < 24; $i++) {
            $value = $i < 10 ? '0' . $i : $i;
            $result['' . $i] = $value;
        }
        return $result;
    }

    public static function getMinutsChoice() {
        $result = [];
        for ($i = 0; $i < 59; $i++) {
            $value = $i < 10 ? '0' . $i : $i;
            $result['' . $i] = $value;
        }
        return $result;
    }
}
