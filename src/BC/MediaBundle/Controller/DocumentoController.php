<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 12/05/2018
 * Time: 10:37
 */

namespace BC\MediaBundle\Controller;


use BC\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocumentoController extends Controller {

    public function fileSendAction($type, $entityName, $entityId, $isActive, $toEntityId, $toEntityName) {
        $manager = $this->get('bc.manager');
        $em = $this->getDoctrine()->getManager();
        $result = [];

        if (!empty($_FILES['file'])) {
            $file = $_FILES['file'];
            try {
                $documento = $this->get('bc.documento.manager')->asyncFileSend($file, $type, $entityName, $entityId, $isActive, $toEntityId, $toEntityName);
            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }

            $result = $em->getRepository(Entity::MEDIA)
                ->hidrateByOption($entityId, $entityName, null, $isActive, true, $documento->getMedia()->getId())[0];
        }

        return empty($file) ? $manager->renderJson(['fail' => 'No se ha enviado el archivo'])
            : $manager->renderJson(['success' => $result]);
    }

    public function fileSendAceptMultipleAction($type, $entityName, $entityId, $isActive, $toEntityId, $toEntityName) {
        $manager = $this->get('bc.manager');
        $em = $this->getDoctrine()->getManager();
        $result = [];

        if (!empty($_FILES['file'])) {
            $file = $_FILES['file'];
            try {
                $documento = $this->get('bc.documento.manager')->asyncFileSendAceptMultiple($file, $type, $entityName, $entityId, $isActive, $toEntityId, $toEntityName);
            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }

            $result = $em->getRepository(Entity::MEDIA)
                ->hidrateByOption($entityId, $entityName, null, $isActive, true, $documento->getMedia()->getId())[0];
        }

        return empty($file) ? $manager->renderJson(['fail' => 'No se ha enviado el archivo'])
            : $manager->renderJson(['success' => $result]);
    }
}