avApp.filter('youtubeEmbedUrl',
  ['$sce',
    function ($sce) {
      return function (videoId) {
        return $sce.trustAsResourceUrl(`https://www.youtube.com/embed/${videoId}?rel=0`);
      };
    }
  ]
);