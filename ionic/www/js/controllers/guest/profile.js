angular.module('starters.controllers')
    .controller('GuestProfileController', ['$scope', '$state', '$ionicLoading', 'UserData', '$filter', 'Guest',
        function ($scope, $state, $ionicLoading, UserData, $filter, Guest) {

            var user = UserData.get(),
                guest = null;

            if (user.guest) {
                guest = user.guest.data;
            } else {
                guest = {
                    user_id: user.id
                }
            }

            $scope.guest = guest;


            $scope.save = function () {
                $ionicLoading.show({
                    template: 'Salvando ...'
                });

                Guest.updateProfile({id: $scope.guest.id},{guest: $scope.guest}, function (data) {
                    //$scope.guest = data.data;

                    $ionicLoading.hide();
                }, function (dataError) {
                    $ionicLoading.hide();
                });

            }
        }]);
