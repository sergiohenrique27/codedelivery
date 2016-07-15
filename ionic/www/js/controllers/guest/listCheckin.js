angular.module('starters.controllers')
    .controller('GuestListCheckinController', ['$scope', '$state', '$ionicLoading', '$stateParams', '$ionicPopup', 'Checkin', '$ionicActionSheet',
        function ($scope, $state, $ionicLoading, $stateParams, $ionicPopup, Checkin, $ionicActionSheet) {

            if ($stateParams.status == 'A'){
                $scope.title = 'Agendado';
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


            $scope.showActionSheet = function(checkin){
                $ionicActionSheet.show({
                    buttons: [
                        {text: 'Alterar Checkin'},
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
                                $state.go('guest.viewGeoHotel', {id: checkin.id});
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