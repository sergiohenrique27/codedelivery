angular.module('starters.services')

    .factory('Products', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + 'api/client/products', {}, {
            query: {
                isArray: false
            }
        });

    }])