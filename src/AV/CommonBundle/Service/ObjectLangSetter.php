<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 10/08/2017
 * Time: 11:56
 */

namespace AV\CommonBundle\Service;

use AV\CommonBundle\Util\Util;

class ObjectLangSetter {

    /**
     * @param ObjectLang $ol Parametro de salida, los cambios se realizan sobre este mismo objeto
     * que sale modificado
     * @param $data mixed
     * @return bool False en caso que no exista el dataLang asociado al data y que se haya creado. En este caso
     * Se hace necesario guardar el dataLang $em->persist($ol->getDataLang()); y luego $em->flush();
     */
    public static function setFromData(ObjectLang $ol, $data) {
        $entityName = Util::getClass($ol->getData(), false);
        $existe = true;

        if (empty($ol->getDataLang())) {
            $dir = 'Nous\CommonBundle\Entity\\';
//            $dir = str_replace('\\', DIRECTORY_SEPARATOR, $dir);

            $entityNameLang = $dir . $entityName . 'Lang';
            $ol->setDataLang(new $entityNameLang());
            $existe = false;
        }

        foreach ($data as $key => $value) {
            $attr = ucfirst($key);
            $method = 'set' . $attr;
            if (method_exists($ol->getData(), $method)) {
                $ol->getData()->$method($value);
                continue;
            }

            if (method_exists($ol->getDataLang(), $method)) {
                $ol->getDataLang()->$method($value);
            }
        }

        $setMethod = 'set' . $entityName;
        $ol->getDataLang()->$setMethod($ol->getData());
        $ol->getDataLang()->setLang($ol->getLang());

        return $existe;
    }
}