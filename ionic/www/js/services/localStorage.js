angular.module('starters.services')

.factory('$localStorage', ['$window', function ($window) {
    return {
        set: function (key, value) {
            $window.localStorage[key] = value;
            return $window.localStorage[key];
        },
        get: function (key, defaulValue) {
            return $window.localStorage[key] || defaulValue ;
        },
        setObject: function (key, value) {
            $window.localStorage[key] = JSON.stringify( value );
            return this.getObject(key);
        },
        getObject: function (key) {
            if ($window.localStorage[key]) {
                return JSON.parse($window.localStorage[key] ) ;
            }
            return null;
        }
    }
}])