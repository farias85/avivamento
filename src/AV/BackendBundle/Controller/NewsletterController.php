<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 28/10/2017
 * Time: 19:52
 */

namespace AV\BackendBundle\Controller;


use AV\CommonBundle\Controller\UniqueNomenclatureController;
use AV\CommonBundle\Form\NewsletterType;
use AV\CommonBundle\Util\Entity;

class NewsletterController extends UniqueNomenclatureController {

    public function getTitle() {
        return 'Email Newsletter';
    }

    public function getEntityName() {
        return Entity::NEWSLETTER;
    }

    public function getRoutePrefix() {
        return 'backend_newsletter';
    }

    public function getFormTypeClass() {
        return NewsletterType::class;
    }

    public function defaultKeysFilter() {
        return ['id' => 'text', 'email' => 'text'];
    }

    public function keysUnique() {
        return ['email'];
    }
}