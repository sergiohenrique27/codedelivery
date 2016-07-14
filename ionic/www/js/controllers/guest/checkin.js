angular.module('starters.controllers')
    .controller('GuestCheckinController',
        ['$scope', '$state', '$ionicLoading', 'Hotel', '$ionicPopup', 'UserData', 'Guest', 'Checkin',
            function ($scope, $state, $ionicLoading, Hotel, $ionicPopup, UserData, Guest, Checkin) {
                $scope.Hotels = [];
                $scope.SelectedHotel = null;
                $scope.guest = null;
                $scope.companions = null;

                $scope.checkin = {
                    id: null
                };

                var user = UserData.get();
                if (user.guest) {
                    $scope.guest = user.guest.data;
                }

                Guest.getCompanions({include: 'companions'}).$promise
                    .then(function (data) {
                        $scope.companions = data.data;
                    }, function (dataError) {
                        alert('Erro');
                    });

                var query = null;
                Hotel.get({name: query}).$promise
                    .then(function (data) {
                        $scope.Hotels = data.data;
                    }, function (dataError) {
                        alert('Erro')
                    });

                $scope.afterSelectedHotel = function (selected) {
                    if (selected) {
                        $scope.SelectedHotel = selected.originalObject;
                        $scope.checkin.hotel_id = $scope.SelectedHotel.id;
                    }
                };

                $scope.limparHotel = function () {
                    $scope.SelectedHotel = null;
                    $scope.checkin.hotel_id = null;
                    $scope.searchStr = null;
                }

                $scope.save = function () {
                    $ionicLoading.show({
                        template: 'Salvando ...'
                    });

                    Checkin.store({id: $scope.checkin.id}, {checkin: $scope.checkin}, function (data) {
                        $scope.checkin.id = data.id;
                        $ionicLoading.hide();
                        $state.go('guest.qrcode', {id: data.id});
                    }, function (dataError) {
                        $ionicLoading.hide();
                    });

                }


            }]);