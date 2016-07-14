angular.module('starters.services')

    .factory('Hotel', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + 'api/hotel?search=:name', {}, {
            query: {
                isArray: false
            }
        });

    }])
