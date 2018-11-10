/**
 * Created by Felipe on 09/02/2018.
 */

let avApp = angular.module('AV',
  [
    'ngResource',
    'ngRoute',
    'ngCookies',
    'ngAnimate',
    'chart.js',
    'ngSanitize',
    'ui.multiselect',
    'ngFileUpload',
    'pascalprecht.translate',
    'LocalStorageModule',
    'growlNotifications',
    'AV.CONFIG'
  ], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('{|');
    return $interpolateProvider.endSymbol('|}');
  }
).run(
  ['$rootScope', '$cookieStore', '$location', 'CONFIG', '$translate', '$window',
    function ($rootScope, $cookieStore, $location, CONFIG, $translate, $window) {
      const {
        host, assets, baseUrl, maxFileSize, maxVideoFileSize,
      } = $window.avConfig;

      $rootScope.ASSET_URL = assets.split('common')[0];
      $rootScope.UPLOADS_URL = `${assets.split('bundles')[0]}uploads/`;
      $rootScope.HOST_URL = host;
      $rootScope.BASE_URL = baseUrl;
      $rootScope.MB = 1048576; //1MB -> 1048576 bytes
      $rootScope.MAX_FILE_SIZE = $rootScope.MB * maxFileSize;
      $rootScope.MAX_VIDEO_FILE_SIZE = $rootScope.MB * maxVideoFileSize;

      $rootScope.trans = (key) => {
        return $translate.instant(key);
      };

      $rootScope.random = (start = 0, end = 10) => {
        return Math.floor(Math.random() * end) + start;
      };
    }
  ]
);

