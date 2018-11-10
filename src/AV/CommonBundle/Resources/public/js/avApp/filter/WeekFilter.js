/* 
 * File: DiasSemanaFilter.js
 * User: jariasf1
 * Date: 21-mar-2018
 * Time: 21:24:21
 */

avApp.filter('week',
  ['$rootScope',
    function ($rootScope) {
      return function (day) {
        try {
          day = parseInt(day, 10);
        } catch (e) {
          console.log(e);
        }
        switch (day) {
          case 0:
            day = $rootScope.trans('lunes');
            break;
          case 1:
            day = $rootScope.trans('martes');
            break;
          case 2:
            day = $rootScope.trans('miercoles');
            break;
          case 3:
            day = $rootScope.trans('jueves');
            break;
          case 4:
            day = $rootScope.trans('viernes');
            break;
          case 5:
            day = $rootScope.trans('sabado');
            break;
          case 6:
            day = $rootScope.trans('domingo');
            break;
        }
        return day;
      };
    }
  ]
);
