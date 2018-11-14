<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 28/10/2017
 * Time: 19:40
 */

namespace AV\BackendBundle\Controller;


use AV\CommonBundle\Controller\UniqueNomenclatureController;
use AV\CommonBundle\Util\Entity;

class CategoriaController extends UniqueNomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Categoría';
    }

    public function getEntityName() {
        return Entity::CATEGORIA;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'backend_categoria';
    }

    public function keysUnique() {
        return ['nombre'];
    }

}