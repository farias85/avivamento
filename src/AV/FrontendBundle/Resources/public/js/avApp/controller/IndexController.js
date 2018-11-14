/**
 * Created by Felipe on 16/09/2018.
 */

avApp.controller('IndexController',
  ['$scope',
    function ($scope) {

      $scope.init = () => {
        try {
          $scope.initReadOnlyMap('av_map', [['Misión de Avivamiento', 20.010968, -75.832289, 0]]);
        } catch (e) {
          console.error('exception -> $scope.initReadOnlyMap');
        }
      };
    }
  ]
);