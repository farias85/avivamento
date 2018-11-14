/**
 * Created by Felipe on 13/11/2018.
 */

/**
 * Created by Felipe on 20/06/2018.
 */

avApp.controller('MediaController',
  ['$scope', '$window', '$controller', 'DocumentoService',
    function ($scope, $window, $controller, DocumentoService) {

      $scope.to = {};
      $scope.owner = {};
      $scope.misc = {}; //miscelanea - un objeto con lo que quieras mandar

      $scope.send = [];
      $scope.recieve = [];

      $scope.file = {};
      $scope.type = ''; //esto es un slug que viene desde TipoMedia::

      $scope.loading = false;
      $scope.loading_error = '';

      $scope.init = () => {
        const {owner, to, send, recieve, misc, type} = $window.sfParams;

        $scope.to = to;
        $scope.owner = owner;
        $scope.misc = misc;
        $scope.type = type;

        $scope.send = send.map(item => {
          //Para que admita tanto documentos como objetos media
          if (item.hasOwnProperty('media')) { //Este sería una objeto documento
            return item.media;
          }
          return item; //Este sería un objeto media
        });

        $scope.recieve = recieve.map(item => {
          if (item.hasOwnProperty('media')) {
            return item.media;
          }
          return item;
        });

        console.log('owner', $scope.owner);
        console.log('to', $scope.to);
        console.log('send', $scope.send);
        console.log('recieve', $scope.recieve);
        console.log('type', $scope.type);
      };

      $scope.getDate = (item) => {
        if (!item.hasOwnProperty('createdAt'))
          return;
        return moment(item.createdAt.date).toDate();
        // return new Date(item.createdAt.date);
      };

      $scope.getFilePath = (doc) => {
        return `${$scope.UPLOADS_URL}${doc.name}`;
      };

      $scope.getFullFilePath = (doc) => {
        return `${$scope.HOST_URL}${$scope.UPLOADS_URL}${doc.name}`;
      };

      $scope.read = (doc) => {
        // const url = 'http://iesa2018.ipk.fraunhofer.de/fileadmin/user_upload/IESA2018/Documents/I-ESA2018_call_for_papers.pdf';
        const url = $scope.getFullFilePath(doc);
        let reader = $('#reader');
        reader.attr('src', `https://docs.google.com/gview?url=${url}&embedded=true`);
      };

      $scope.submitFile = () => {
        if ($scope.file.size > $scope.MAX_FILE_SIZE) {
          $scope.alert($scope.trans('error.archivo.grande'));
          return;
        }
        console.log('log', $scope.file);
        const file = $scope.file;

        $('#btn-close-cargar-documento').click();
        $('#a-modal-loading').click();
        let modalClose = $('#btn-close-modal-loading');

        $scope.loading = true;
        $scope.loading_error = false;

        DocumentoService.fileSendAceptMultiple(file, $scope.type,
          $scope.owner.entity, $scope.owner.id, $scope.to.entity, $scope.to.id)
          .then(function (resp) {
            if (resp.config.data.file) {
              console.log('Success ', resp.config.data.file.name);
            }
            console.log('uploaded. Response: ', resp.data);
            if (resp.data.success) {
              $scope.send = [resp.data.success, ...$scope.send];
              // $scope.send.push(resp.data.success);

              setTimeout(function () { //para que se refresquen los tooltips de bootstrap
                $('[data-toggle="tooltip"]').tooltip();
              }, 500);

            } else {
              $scope.loading_error = true;
            }
            modalClose.click();
          }, function (resp) {
            console.log('Error status: ' + resp.status);
            $scope.loading_error = true;
            modalClose.click();
          }, function (evt) {
            if (evt.config.data.file) {
              let progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
              // $scope.loading_certificado_progress = progressPercentage;
              console.log('progress: ' + progressPercentage + '% ' + evt.config.data.file.name);
            }
          })
          .then(() => $scope.file = {})
          .then(() => modalClose.click())
          .then(() => $scope.loading = false);
      };

      $scope.openModalCargar = () => {
        $scope.file = {};
        $('#btn-abrir-cargar').click();
      };

      $scope.getName = (obj) => {
        if (obj.hasOwnProperty('fullname')) {
          return obj.fullname;
        }
        return '-';
      };
    }
  ]
);
