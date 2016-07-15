angular.module('starters.services')
    
    .factory('Checkin', ['$resource', 'appConfig', function ($resource, appConfig) {
        //return $resource(appConfig.baseUrl + 'api/guest/guest/:id', {id: '@id'}, {
        return $resource(appConfig.baseUrl + 'api/guest/checkinx', {}, {
            query: {
                isArray: false
            },
            store:{
                url: appConfig.baseUrl + 'api/guest/checkin/store',
                method: 'PUT'
            },
            getCheckins:{
                isArray: false,
                url: appConfig.baseUrl + 'api/guest/checkin/listCheckin/:status',
                method: 'GET'
            },
            getCheckin:{
                isArray: false,
                url: appConfig.baseUrl + 'api/guest/checkin/:id',
                method: 'GET'
            }

        });

    }])