/**
 * Created by Felipe on 19/05/2018.
 */

avApp.service('DocumentoService', [
    'ApiService', 'Upload',
    function (ApiService, Upload) {

      /**
       *
       * @param file
       * @param type
       * @param entityName Owner del documento
       * @param entityId
       * @param toEntityName A quien va enviado el documento
       * @param toEntityId
       * @param isActive {number} 1 si es está activo, 0 en caso contrario
       */
      this.fileSend = function (file, type, entityName, entityId, toEntityName, toEntityId, isActive = 1) {
        return Upload.upload({
          url: Routing.generate('documento_file_send', {
            'type': type, 'entityName': entityName, 'entityId': entityId,
            'toEntityId': toEntityId, 'toEntityName': toEntityName, 'isActive': isActive
          }),
          data: {
            file: file,
            token: 'token'
          }
        });
      };

      this.fileSendAceptMultiple = function (file, type, entityName, entityId, toEntityName, toEntityId, isActive = 1) {
        return Upload.upload({
          url: Routing.generate('documento_file_send_acept_multiple', {
            'type': type, 'entityName': entityName, 'entityId': entityId,
            'toEntityId': toEntityId, 'toEntityName': toEntityName, 'isActive': isActive
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