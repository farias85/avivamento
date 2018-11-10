/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

avApp.controller('TodoController',
  ['$scope', 'localStorageService', '$rootScope',
    function ($scope, localStorageService, $rootScope) {

      $scope.message = 'Hello world ANGULaaaAR!!!';
      $scope.act = {};

      if (localStorageService.get('todo_list')) {
        $scope.todo = localStorageService.get('todo_list');
      } else {
        $scope.todo = [];
      }

      $scope.addTodo = function () {
        $scope.todo.push($scope.act);
        $scope.act = {};
        localStorageService.set('todo_list', $scope.todo);
      };

      $scope.removeTodo = function () {
        $scope.alert('removeTodo');
      };

      $rootScope.$on('eventt', (event, result) => {
        console.log('result', result);
      });

      $scope.acept = () => {

      };
    }
  ]
);
