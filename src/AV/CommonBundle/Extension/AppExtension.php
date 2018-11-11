<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 11/11/2018
 * Time: 14:23
 */

namespace AV\CommonBundle\Extension;


use AV\CommonBundle\Util\Entity;
use Doctrine\ORM\EntityManager;

class AppExtension extends \Twig_Extension {

    protected $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function getFunctions() {
        return [
            new \Twig_SimpleFunction('getConf', [$this, 'getConf'], [
                'needs_context' => true,
            ]),
        ];
    }

    public function getConf(&$context, $keys) {
        if (!is_array($keys)) {
            return '-';
        }
        $configuraciones = $this->em->getRepository(Entity::CONFIGURACION)->getValues($keys, true);
        $result = [];
        foreach ($configuraciones as $value) {
            $result[$value['clave']] = $value['valor'];
        }
        return $result;
    }

    public function getName() {
        return 'av.twig.app.extension';
    }
}