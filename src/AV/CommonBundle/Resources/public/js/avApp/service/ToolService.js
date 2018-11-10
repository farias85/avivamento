/**
 * Created by Felipe Rodriguez Arias <ucifarias@gmail.com> on 28/11/2017.
 */

avApp.service('ToolService',
  [
    function () {

      this.toLowerCase = (str) => {
        return str.replace(/[A-Z]/g, u => u.toLowerCase());
      };

      this.getSlug = (cadena, separador = '-') => {
        let slug = cadena[0].toLowerCase() + cadena.slice(1);
        slug = slug.trim(slug);
        slug = slug.replace(/([A-Z])/g, ' $1');
        slug = slug.replace(/[^a-zA-Z0-9\/_|+ -]/, '');
        slug = slug.toLowerCase();
        slug = slug.replace(/[\/_|+ -]+/g, separador);
        return slug;
      };
    }
  ]
);
