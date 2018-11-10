/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 08/11/2017.
 */

avApp.service('ApiService',
  ['$http', '$q',
    function ($http, $q) {
      /**
       * HTTP GET CALL
       * @param url
       * @returns {jQuery.promise|*|promise|Promise|f}
       */
      this.get = function (url) {
        let defered = $q.defer();
        let promise = defered.promise;
        $http.get(url)
          .then((response) => defered.resolve(response))
          .catch((err) => defered.reject(err));
        return promise;
      };

      /**
       * HTTP POST CALL
       * @param url
       * @param body
       * @returns {jQuery.promise|*|promise|Promise|f}
       */
      this.post = function (url, body) {
        let defered = $q.defer();
        let promise = defered.promise;
        $http.post(url, body)
          .then((response) => defered.resolve(response))
          .catch((err) => defered.reject(err));
        return promise;
      };

      /**
       * HTTP PUT CALL
       * @param url
       * @param body
       * @returns {jQuery.promise|*|promise|Promise|f}
       */
      this.put = function (url, body) {
        let defered = $q.defer();
        let promise = defered.promise;
        $http.put(url, body)
          .then((response) => defered.resolve(response))
          .catch((err) => defered.reject(err));
        return promise;
      };

      /**
       * HTTP DELETE CALL
       * @param url
       * @param body
       * @returns {jQuery.promise|*|promise|Promise|f}
       */
      this.delete = function (url, body) {
        let defered = $q.defer();
        let promise = defered.promise;
        $http.delete(url, body)
          .then((response) => defered.resolve(response))
          .catch((err) => defered.reject(err));
        return promise;
      };

      const isProduction = false;

      this.mediaUrl = () => {
        return isProduction ? 'https://seniorfirst.com/uploads/img/ofertas/' : 'http://127.0.0.1:8000/bundles/frontend/img/';
      };

      this.mediaUploadUrl = () => {
        return isProduction ? 'https://seniorfirst.com/uploads/img/ofertas/' : 'http:////127.0.0.1:8000/web/uploads/img/ofertas/';
      };

    }
  ]
).service('EvaluacionResource',
  function ($rootScope, $resource) {
    return $resource(`${$rootScope.HOST_URL}${Routing.generate('api_evaluacion_index', {'_locale': _locale_})}:id`, {id: '@id'}, {update: {method: 'PUT'}});
  }
);

