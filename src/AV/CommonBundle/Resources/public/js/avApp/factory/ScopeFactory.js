/**
 * Created by Felipe on 08/07/2018.
 */

avApp.factory('ScopeFactory',
  ['$rootScope',
    function ($rootScope) {
      let mem = {};

      return {
        store: function (key, value) {
          $rootScope.$emit('scope.stored', key);
          mem[key] = value;
        },
        get: function (key) {
          return mem[key];
        }
      };
    }
  ]
);