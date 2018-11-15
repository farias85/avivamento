<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 16/09/2018
 * Time: 12:36
 */

namespace AV\CommonBundle\Traits;

use Symfony\Component\HttpFoundation\File\UploadedFile;

trait PathTrait {

    /**
     * @var UploadedFile
     */
    private $path;

    /**
     * @var string
     */
    private $filename;

    /**
     * @return mixed
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path) {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getFilename(): string {
        return $this->filename;
    }

    /**
     * @param string $filename
     */
    public function setFilename(string $filename) {
        $this->filename = $filename;
    }
}