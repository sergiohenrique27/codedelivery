angular.module('starters.services')

    .factory('Order', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + 'api/client/order/:id', {id: '@id'}, {
            query: {
                isArray: false
            }
        });

    }])

    .factory('DeliverymanOrder', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + 'api/deliveryman/order/:id', {id: '@id'}, {
            query: {
                isArray: false
            }
        });

    }])