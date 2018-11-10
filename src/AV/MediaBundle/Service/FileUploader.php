<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AV\MediaBundle\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileUploader {

    public function upload(UploadedFile $file) {
        $fileName = $this->generateFilename($file->guessExtension());
        $file->move($this->getTargetDir(), $fileName);
        return $fileName;
    }

    public function generateFilename($extension) {
        return md5(uniqid()) . '.' . $extension;
    }

    /**
     * La ruta absoluta del directorio donde se deben guardar los archivos cargados
     * @return string
     */
    public function getWebDir() {
        return __DIR__ . '/../../../../web';
    }

    /**
     * Se deshace del __DIR__ para no meter la pata al mostrar el documento/imagen cargada en la vista.
     * @return string
     */
    public function getUploadPath() {
        return '/uploads';
    }

    public function getTargetDir() {
        return $this->getWebDir() . $this->getUploadPath();
    }

    public function getAssetPath() {
        return substr($this->getUploadPath(), 1, strlen($this->getUploadPath()) - 1) . '/';
    }
}
