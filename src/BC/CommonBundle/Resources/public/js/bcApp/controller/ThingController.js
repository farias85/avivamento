/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

bcApp.controller('ThingController',
  ['$scope', '$rootScope',
    function ($scope, $rootScope) {

      $scope.init = () => {
      };

      $scope.send = () => {
        const result = [
          {a: 1, b: 2}
        ];
        $rootScope.$emit('eventt', result);
        console.log('enviado result');
      };
    }
  ]
);
