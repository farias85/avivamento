/**
 * Created by webind on 8/10/2016.
 */
avApp.config(['$translateProvider', function ($translateProvider) {
  $translateProvider.translations('es', {
    'campo.requerido': 'Campo requerido',
    'localizacion': 'Localización',
    'cargando': 'Cargando',
    'sin.resultados': 'No se encontraron resultados',
    'filtrar': 'Filtrar',
    'seleccione': 'Seleccione',
    'enero': 'Enero',
    'febrero': 'Febrero',
    'marzo': 'Marzo',
    'abril': 'Abril',
    'mayo': 'Mayo',
    'junio': 'Junio',
    'julio': 'Julio',
    'agosto': 'Agosto',
    'septiembre': 'Septiembre',
    'octubre': 'Octubre',
    'noviembre': 'Noviembre',
    'diciembre': 'Diciembre',
    'lunes': 'Lunes',
    'martes': 'Martes',
    'miercoles': 'Miércoles',
    'jueves': 'Jueves',
    'viernes': 'Viernes',
    'sabado': 'Sábado',
    'domingo': 'Domingo',
  });
  $translateProvider.preferredLanguage(_locale_);
  $translateProvider.useSanitizeValueStrategy('escape');
}]);



