angular.module('starters.services')

    .factory('$map', [ function () {
        return {
            center: {
                latitude: 0,
                longitude: 0
            },
            zoom: 16
        }
    }]);