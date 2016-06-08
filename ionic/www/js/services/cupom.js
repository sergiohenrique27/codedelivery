angular.module('starters.services')

    .factory('Cupom', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + '/api/cupom/:code', {}, {
            query: {
                isArray: false
            }
        });

    }])