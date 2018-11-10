/**
 * Created by felipao.
 */
bcApp.config(['$routeProvider', function ($routeProvider) {

    $routeProvider
      .when('/', {
          controller: 'LoginController',
          templateUrl: 'login-template',
        }
      )
      .when('/example', {
          controller: 'ExampleController',
          templateUrl: 'example-template',
        }
      )
      .otherwise('/');
  }]
);
