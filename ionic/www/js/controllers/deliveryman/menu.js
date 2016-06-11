angular.module('starters.controllers')
    .controller('DeliverymanMenuController', ['$scope', '$state', '$ionicLoading', 'UserData',
        function ($scope, $state, $ionicLoading, UserData) {
            $scope.user = UserData.get;
        }]);