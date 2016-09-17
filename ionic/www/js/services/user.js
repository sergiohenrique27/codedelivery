angular.module('starters.services')

    .factory('User', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + 'api/authenticated', {}, {
            query: {
                isArray: false
            },
            authenticated: {
                method: 'GET',
                url: appConfig.baseUrl + 'api/authenticated'
            },
            signup:{
                method: 'POST',
                url: appConfig.baseUrl + 'api/signup'
            },
            resetPassword:{
                method: 'POST',
                url: appConfig.baseUrl + 'api/password/email'
            }
        });

    }])
