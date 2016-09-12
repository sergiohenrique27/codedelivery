angular.module('starters.controllers')
    .controller('GuestQrcodeController',
        ['$scope', '$state', '$ionicPopup', '$stateParams', '$ionicLoading', 'Checkin',
            function ($scope, $state, $ionicPopup, $stateParams, $ionicLoading, Checkin ) {

                $ionicLoading.show({
                    template: 'Carregando ...'
                });

               var qrCode = new QRCode(document.getElementById("qrcode"), $stateParams.id);

                Checkin.getCheckin({id: $stateParams.id, include: 'hotel,guests'}, {}, function (data) {
                    $scope.checkin = data.data;
                    $ionicLoading.hide();
                }, function (dataError) {
                    $ionicLoading.hide();
                });

            }]);