/**
 * Created by Felipe on 27/03/2018.
 */

bcApp.filter('month',
  ['$rootScope',
    function ($rootScope) {
      return function (month) {
        try {
          month = parseInt(month, 10);
        } catch (e) {
          console.log(e);
        }
        switch (month) {
          case 1:
            month = $rootScope.trans('enero');
            break;
          case 2:
            month = $rootScope.trans('febrero');
            break;
          case 3:
            month = $rootScope.trans('marzo');
            break;
          case 4:
            month = $rootScope.trans('abril');
            break;
          case 5:
            month = $rootScope.trans('mayo');
            break;
          case 6:
            month = $rootScope.trans('junio');
            break;
          case 7:
            month = $rootScope.trans('julio');
            break;
          case 8:
            month = $rootScope.trans('agosto');
            break;
          case 9:
            month = $rootScope.trans('septiembre');
            break;
          case 10:
            month = $rootScope.trans('octubre');
            break;
          case 11:
            month = $rootScope.trans('noviembre');
            break;
          case 12:
            month = $rootScope.trans('diciembre');
            break;
        }
        return month;
      };
    }
  ]
);