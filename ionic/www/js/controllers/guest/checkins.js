angular.module('starters.controllers')
    .controller('GuestCheckinsController', ['$scope', '$state', '$ionicLoading', 'Guest', '$ionicPopup',
        function ($scope, $state, $ionicLoading, Guest, $ionicPopup) {

            $scope.addCheckin = function () {
                $state.go('guest.checkin',{id: null} );
            }

            $scope.listCheckins = function ( status) {
                $state.go('guest.listCheckin',{status: status} );
            }

        }])
;