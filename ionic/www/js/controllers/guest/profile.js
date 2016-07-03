angular.module('starters.controllers')
    .controller('GuestProfileController', ['$scope', '$state', '$ionicLoading', 'UserData', '$filter', 'Guest',
        function ($scope, $state, $ionicLoading, UserData, $filter, Guest) {
            var user = UserData.get(),
                guest = user.guest.data;

            $scope.guest = guest;

            $scope.save = function () {

                $ionicLoading.show({
                    template: 'Salvando ...'
                });

                Guest.update({id: $scope.guest.id}, function (data) {
                    $scope.guest = data.data;
                    $ionicLoading.hide();
                }, function (dataError) {
                    $ionicLoading.hide();
                });

            }
        }]);
