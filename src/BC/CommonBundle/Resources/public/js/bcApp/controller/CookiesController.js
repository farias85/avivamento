/**
 * Created by Felipe on 20/05/2018.
 */

bcApp.controller('CookiesController',
  ['$scope', 'localStorageService', 'ApiService',
    function ($scope, localStorageService, ApiService) {

      $scope.sfCookie = null;

      $scope.init = () => {
        // localStorageService.remove('sfCookie'); //todo Descomentar esto si quieres q te aparezca de nuevo el cintillo
        $scope.sfCookie = localStorageService.get('sfCookie');
      };

      $scope.showMessage = () => {
        return $scope.sfCookie === null;
      };

      $scope.aceptar = () => {
        localStorageService.set('sfCookie', {acepted: true});
        $scope.init();
      };
    }
  ]
);