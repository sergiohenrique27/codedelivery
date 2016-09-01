angular.module('starters.controllers')
    .controller('GuestListCheckinController', ['$scope', '$state', '$ionicLoading', '$stateParams', '$ionicPopup',
        'Checkin', '$ionicActionSheet', '$cordovaGeolocation', '$window',
        function ($scope, $state, $ionicLoading, $stateParams, $ionicPopup, Checkin, $ionicActionSheet,
                  $cordovaGeolocation, $window) {
            $scope.canAddOrDelete = false;

            if ($stateParams.status == 'A'){
                $scope.title = 'Agendado';
                $scope.canAddOrDelete = true;
            } else if ($stateParams.status == 'V'){
                $scope.title = 'Vigentes';
            }
            else if ($stateParams.status == 'R'){
                $scope.title = 'Realizados';
            }

            Checkin.getCheckins({status: $stateParams.status, include: 'hotel'}, {}).$promise

                .then(function (data) {
                    $scope.checkins = data.data;
                }, function (dataError) {
                    alert('Erro');
                });

            $scope.openGmaps = function (posHotel){


                position =  $cordovaGeolocation.getCurrentPosition()
                .then(
                    function(data){
                        url = 'http://maps.google.com/maps?saddr='+data.coords.latitude+','+data.coords.longitude+'&daddr='+posHotel.latitude+','+posHotel.longitude+'&dirflg=d';
                        $window.open(url,'_system');
                    },
                    function (responseError) {
                        console.log(responseError);
                    }
                );
                return false;
            };

            $scope.addCheckin = function () {
                $state.go('guest.checkin');
            };

            $scope.showActionSheet = function(checkin){
                $ionicActionSheet.show({
                    buttons: [
                        {text: 'ver Checkin'},
                        {text: 'ver localização do Hotel'},
                        {text: 'ver QRCODE'}
                    ],
                    titleText: 'O que fazer?',
                    cancelText: 'cancelar',
                    cancel: function () {

                    },
                    buttonClicked: function (i) {
                        switch (i){
                            case 0:
                                $state.go('guest.checkin', {id: checkin.id});
                                break;
                            case 1:
                                $scope.openGmaps({
                                    latitude: checkin.hotel.data.latitude,
                                    longitude: checkin.hotel.data.longitude
                                });
                                break;
                            case 2:
                                $state.go('guest.qrcode', {id: checkin.id});
                                break;
                        }
                    }
                });
            };

        }])
;