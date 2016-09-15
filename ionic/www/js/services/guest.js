angular.module('starters.services')
    .factory('Guest', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.baseUrl + 'api/guest/guest', {}, {
            query: {
                isArray: false
            },
            updateProfile: {
                method: 'PUT'
            },
            getCompanions:{
                url: appConfig.baseUrl + 'api/guest/companions',
                method: 'GET'
            },
            destroyCompanion:{
                url: appConfig.baseUrl + 'api/guest/companions/:id',
                method: 'DELETE'
            },
            getCompanion:{
                isArray: false,
                url: appConfig.baseUrl + 'api/guest/companions/:id',
                method: 'GET'
            },
            storeCompanion:{
                url: appConfig.baseUrl + 'api/guest/companion',
                method: 'PUT'
            }
        });

    }])