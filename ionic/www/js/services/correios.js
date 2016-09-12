angular.module('starters.services')

    .factory('Correios', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource('https://viacep.com.br/ws/:CEP/json', {}, {

        });

    }])
