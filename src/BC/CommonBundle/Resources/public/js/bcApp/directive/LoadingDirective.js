/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 26/11/2017.
 */

bcApp.directive('loading',
  ['$http',
    function ($http) {
      return {
        restrict: 'A',
        link: function (scope, elm, attrs) {
          scope.isLoading = function () {
            scope.loading = $http.pendingRequests.length > 0;
            return scope.loading;
          };

          scope.$watch(scope.isLoading, function (v) {
            if (v) {
              $(elm).show();
            } else {
              $(elm).hide();
            }
          });
        }
      };
    }
  ]
);

