<?php
/**
 * Created by PhpStorm.
 * User: Felipe
 * Date: 16/09/2018
 * Time: 12:36
 */

namespace AV\CommonBundle\Traits;


trait YoutubeUrlsTrait {

    /**
     * @var array
     */
    private $youtubeUrls;

    /**
     * @return array
     */
    public function getYoutubeUrls(): array {
        return $this->youtubeUrls;
    }

    /**
     * @param array $youtubeUrls
     */
    public function setYoutubeUrls(array $youtubeUrls) {
        $this->youtubeUrls = $youtubeUrls;
    }
}