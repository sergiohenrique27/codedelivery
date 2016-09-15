angular.module('starters.services')

    .factory('Correios', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + 'api/guest/cep/:cep', {}, {

        });

    }])
