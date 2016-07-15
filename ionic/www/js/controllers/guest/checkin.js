angular.module('starters.controllers')
    .controller('GuestCheckinController',
        ['$scope', '$state', '$ionicLoading', 'Hotel', '$ionicPopup', 'UserData', 'Guest', 'Checkin', '$stateParams',
            function ($scope, $state, $ionicLoading, Hotel, $ionicPopup, UserData, Guest, Checkin, $stateParams) {
                $scope.Hotels = [];
                $scope.SelectedHotel = null;
                $scope.guest = null;
                $scope.companions = null;

                $ionicLoading.show({
                    template: 'Carregando ...'
                });

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

                //pegar checkin
                if ($stateParams.id){
                    
                    Checkin.getCheckin({id: $stateParams.id, include: 'hotel,guests'}, {}, function (data) {
                        $scope.checkin = data.data;
                        $scope.SelectedHotel = data.data.hotel.data;

                        var guestsSelecionados = data.data.guests.data;

                        for (var i=0; i<guestsSelecionados.length; i++){

                            if ($scope.guest.id == guestsSelecionados[i].id){
                                $scope.checkin.guests[0] = guestsSelecionados[i].id;
                                continue;
                            }

                            for (var j=0; j<$scope.companions.length; j++){
                                if ($scope.companions[j].id == guestsSelecionados[i].id) {
                                    $scope.checkin.guests[j + 1] = guestsSelecionados[i].id;
                                    continue;
                                }
                            }

                            //$scope.checkin.guests[key] = value;
                        };

                       // $scope.checkin.guests['{{guest.id}}'] = $scope.guest.id;

                        $ionicLoading.hide();
                    }, function (dataError) {
                        $ionicLoading.hide();
                    });
                    
                }

                $ionicLoading.hide();

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