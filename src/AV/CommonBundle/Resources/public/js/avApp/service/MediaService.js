/**
 * Created by Felipe on 26/03/2018.
 */

avApp.service('MediaService', [
    'ApiService', 'Upload',
    function (ApiService, Upload) {

      /**
       *
       * @param file
       * @param type
       * @param entityName
       * @param entityId
       * @param isActive {number} 1 si es está activo, 0 en caso contrario
       */
      this.fileSend = function (file, type, entityName, entityId, isActive = 1) {
        return Upload.upload({
          url: Routing.generate('media_file_send', {
            'type': type, 'entityName': entityName, 'entityId': entityId, 'isActive': isActive
          }),
          data: {
            file: file,
            token: 'token'
          }
        });
      };

      this.fileSendAceptMultiple = function (file, type, entityName, entityId, isActive = 1) {
        return Upload.upload({
          url: Routing.generate('media_file_send_acept_multiple', {
            'type': type, 'entityName': entityName, 'entityId': entityId, 'isActive': isActive
          }),
          data: {
            file: file,
            token: 'token'
          }
        });
      };
    }
  ]
);