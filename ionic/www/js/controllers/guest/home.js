angular.module('starters.controllers')
    .controller('GuestHomeController', ['$scope', '$state', '$ionicLoading', 'UserData',
        function ($scope, $state, $ionicLoading, UserData) {

            $guest = UserData.get().guest;

            $scope.showPerfil = !$guest;
            $scope.gotoPerfil = function () {
                $state.go('guest.profile');
            };


        }]);