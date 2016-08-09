angular.module('starters.filters')
.filter('DateToDatabaseFormat', function () {
   return function ( inDate) {
       var data = new Date(inDate),
           dia = data.getDate(),
           mes = data.getMonth()+1,
           ano = data.getFullYear();

       if (mes<10)
           mes = '0' + mes;

       if (dia <10)
           dia = '0'+dia;

       return dia + '/' + mes + '/' + ano;
   }
});