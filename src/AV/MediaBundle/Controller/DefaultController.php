<?php

namespace AV\MediaBundle\Controller;

use AV\CommonBundle\Util\Entity;
use AV\MediaBundle\Entity\TipoMedia;
use AV\UserBundle\Entity\Cuidador;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        return $this->render('MediaBundle:Default:index.html.twig');
    }

    public function fileSendAction($type, $entityName, $entityId, $isActive) {
        $manager = $this->get('av.manager');
        $em = $this->getDoctrine()->getManager();
        $result = [];

        if (!empty($_FILES['file'])) {
            $file = $_FILES['file'];

            try {
                $media = $this->get('av.media.manager')->asyncFileSend($file, $type, $entityName, $entityId, $isActive);

                $entity = $em->getRepository($entityName)->find($entityId);
                if (!empty($entity)) { //Eliminando el video de youtube cuando se sube un video perfil
                    if ($entity instanceof Cuidador and $type == TipoMedia::VIDEO_PERFIL) {
                        $entity->setUrlYoutube('');
                        $em->flush();
                    }
                }

            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }

//            $result = $manager->hidrateResult(Entity::MEDIA, ['id' => $media->getId()])[0];

            $result = $em->getRepository(Entity::MEDIA)
                ->hidrateByOption($entityId, $entityName, null, $isActive, true, $media->getId())[0];
        }

        return empty($file) ? $manager->renderJson(['fail' => 'No se ha enviado el archivo'])
            : $manager->renderJson(['success' => $result]);
    }

    public function fileSendAceptMultipleAction($type, $entityName, $entityId, $isActive) {
        $manager = $this->get('av.manager');
        $em = $this->getDoctrine()->getManager();
        $result = [];

        if (!empty($_FILES['file'])) {
            $file = $_FILES['file'];
            try {
                $media = $this->get('av.media.manager')->asyncFileSendAceptMultiple($file, $type, $entityName, $entityId, $isActive);
            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }

//            $result = $manager->hidrateResult(Entity::MEDIA, ['id' => $media->getId()])[0];

            $result = $em->getRepository(Entity::MEDIA)
                ->hidrateByOption($entityId, $entityName, null, $isActive, true, $media->getId())[0];
        }

        return empty($file) ? $manager->renderJson(['fail' => 'No se ha enviado el archivo'])
            : $manager->renderJson(['success' => $result]);
    }

    public function fileSendAppAction(Request $request) {
        $manager = $this->get('av.manager');
        if (!empty($_FILES['file'])) {
            $extension = $_FILES['file']['type'];
            $target_path = $this->get('av.media.file.uploader')->getTargetDir();
            $filename = md5(uniqid()) . '.' . $extension;
            $target_path = $target_path . '/' . $filename;
            try {
                move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
                $media = $this->get('av.media.manager')->fileSendApp($filename, $request->get('type'), $request->get('entityName'), $request->get('entityId'), $request->get('isActive'));
            } catch (\Exception $e) {
                return $manager->renderJson(['fail' => $e->getMessage()]);
            }
            return $manager->renderJson(['path' => $media->getPath()]);
        } else {
            return $manager->renderJson(['fail' => 'No se ha enviado el archivo']);
        }
    }
}
