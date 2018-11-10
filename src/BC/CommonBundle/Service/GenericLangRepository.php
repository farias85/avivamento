<?php

namespace BC\CommonBundle\Service;

use Doctrine\ORM\EntityManager;
use BC\CommonBundle\Util\Entity;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Created by PhpStorm.
 * User: farias
 * Date: 21/04/2017
 * Time: 9:32
 */
class GenericLangRepository {
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * GenericRepository constructor.
     * @param EntityManager $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(EntityManager $entityManager, ContainerInterface $container) {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    /**
     * @return EntityManager
     */
    private function getEntityManager() {
        return $this->entityManager;
    }

    /**
     * @return \Doctrine\DBAL\Connection
     */
    private function getConnection() {
        return $this->getEntityManager()->getConnection();
    }

    /**
     * @return ContainerInterface
     */
    private function getContainer() {
        return $this->container;
    }

    /**
     * Gets a service.
     * @param $id string The service identifier
     * @return object mixed The associated service
     */
    private function get($id) {
        return $this->container->get($id);
    }

    /**
     * Crea un objeto de configuracion para una búsqueda de objetos Lang
     * @param $entity
     * @return ParamObjectLang
     */
    private function createParamObjectLang($entity) {
        $lang = $this->getRequestLang();
        return new ParamObjectLang($entity, $lang);
    }

    /**
     * Encuentra el objeto Lang de la entidad $entity, null en caso de no existir.
     * @param $entity mixed
     * @return ObjectLang
     */
    private function findObjectLang($entity) {
        $conf = $this->createParamObjectLang($entity);
        return $this->findObjectLangConf($conf);
    }

    /**
     * Encuentra el objeto Lang que corresponde con la configuración dada por parámetro, null en caso de no existir
     * @param ParamObjectLang $conf
     * @return ObjectLang
     * @throws \Exception
     */
    private function findObjectLangConf(ParamObjectLang $conf) {
        if (empty($conf->getData())) {
            throw new \InvalidArgumentException('El valor getData del objeto ParamObjectLang no puede ser nulo.');
        }
        $em = $this->getEntityManager();
        $data = $conf->getData();
        $lang = $conf->getLang();

        if (method_exists($data, 'getEl')) {
            if (!empty($data->getEl())) {
                $id1 = $data->getEl()->getLang()->getId();
                $id2 = $lang->getId();
                if ($id1 == $id2) {
                    return new ObjectLang($data, $data->getEl(), $lang);
                }
            }
        }

        $param = [$this->getKey($conf->getEntity()) => $data, 'lang' => $lang];
        $dataLang = $em->getRepository($conf->getEntity() . 'Lang')->findOneBy($param);
        return new ObjectLang($data, $dataLang, $lang);
    }

    /**
     * Encuentra al menos un objeto Lang del parámetro $entity, no tiene xq corresponde con el locale de la petición
     * @param $entity mixed
     * @return ObjectLang|null
     */
    private function findAnyObjectLang($entity) {
        $conf = $this->createParamObjectLang($entity);
        return $this->findAnyObjectLangConf($conf);
    }

    /**
     * Encuentra al menos un objeto Lang de la configuracion  no tiene xq corresponde con el locale de la petición
     * @param ParamObjectLang $conf
     * @return ObjectLang|null
     */
    private function findAnyObjectLangConf(ParamObjectLang $conf) {
        $em = $this->getEntityManager();
        $obj = $this->findObjectLangConf($conf);

        if (!empty($obj->getDataLang())) {
            return $obj;
        }

        $langList = $em->getRepository(Entity::LANG)->findAll();
        foreach ($langList as $item) {
            $conf->setLang($item);
            $obj = $this->findObjectLangConf($conf);
            if (!empty($obj->getDataLang())) {
                return $obj;
            }
        }
        return null;
    }

    private function createParamArrayLang($entity) {
        $lang = $this->getRequestLang();
        return new ParamArrayLang($entity, $lang);
    }

    private function findArrayLang($entity) {
        $conf = $this->createParamArrayLang($entity);
        return $this->findArrayLangConf($conf);
    }

    private function findArrayLangConf(ParamArrayLang $conf) {
        if (!is_array($conf->getData())) {
            throw new \InvalidArgumentException('El valor getData del objeto ParamArrayLang debe ser un arreglo.');
        }
        $arrayLang = [];
        foreach ($conf->getData() as $item) {
            $aux = new ParamObjectLang($item, $conf->getLang());
            $ol = $this->findObjectLangConf($aux);
            $arrayLang[] = $ol;
        }
        return $arrayLang;
    }

    private function findAnyArrayLang($entity) {
        $conf = $this->createParamArrayLang($entity);
        return $this->findAnyArrayLangConf($conf);
    }

    private function findAnyArrayLangConf(ParamArrayLang $conf) {
        if (!is_array($conf->getData())) {
            throw new \InvalidArgumentException('El valor getData del objeto ParamArrayLang debe ser un arreglo.');
        }
        $arrayLang = [];
        foreach ($conf->getData() as $item) {
            $aux = new ParamObjectLang($item, $conf->getLang());
            $ol = $this->findAnyObjectLangConf($aux);
            $arrayLang[] = $ol;
        }
        return $arrayLang;
    }

    private function getKey($entity) {
        $arr = preg_split('%:%', $entity);
        return lcfirst($arr[1]);
    }

    /**
     * @param $entity
     * @return array|ObjectLang
     * @throws \Exception
     */
    public function find($entity) {
        if ($entity instanceof ParamObjectLang) {
            return $this->findObjectLangConf($entity);
        }
        if ($entity instanceof ParamArrayLang) {
            return $this->findArrayLangConf($entity);
        }
        if (is_array($entity)) {
            return $this->findArrayLang($entity);
        }
        return $this->findObjectLang($entity);
    }

    /**
     * @param $entity
     * @return array|ObjectLang|null
     */
    public function findAny($entity) {
        if ($entity instanceof ParamObjectLang) {
            return $this->findAnyObjectLangConf($entity);
        }
        if ($entity instanceof ParamArrayLang) {
            return $this->findAnyArrayLangConf($entity);
        }
        if (is_array($entity)) {
            return $this->findAnyArrayLang($entity);
        }
        return $this->findAnyObjectLang($entity);
    }

    public function findLang($entity, $entityName, $lang = null) {
        if (empty($entity)) {
            throw new \InvalidArgumentException('El valor de objeto entity no debe ser un nulo.');
        }
        $em = $this->getEntityManager();
        if (empty($lang)) {
            $lang = $this->getRequestLang();
        }
        $key = $this->getKey($entityName);

        $params = [$key => $entity, 'lang' => $lang];
        return $em->getRepository($entityName . 'Lang')->findOneBy($params);
    }

    /**
     * @param $entity
     * @param string $entityName
     * @param boolean $exclude Si es true, se excluye el lang actual de la petición y se busca en los otros
     * @return null|object
     */
    public function findAnyLang($entity, $entityName, $exclude = null) {
        $em = $this->getEntityManager();
        $lang = $this->getRequestLang();

        if (empty($exclude)) {
            $obj = $this->findLang($entity, $entityName, $lang);
            if (!empty($obj)) {
                return $obj;
            }
        }

        $langList = $em->getRepository(Entity::LANG)->findAll();
        foreach ($langList as $itemLang) {
            if ($lang->getId() != $itemLang->getId()) {
                $obj = $this->findLang($entity, $entityName, $itemLang);
                if (!empty($obj)) {
                    return $obj;
                }
            }
        }
        return null;
    }

    /**
     * @return null|object|\BC\CommonBundle\Entity\Lang
     * @throws \Exception
     */
    public function getRequestLang() {
        return $this->get('bc.manager')->getRequestLang();
    }

}