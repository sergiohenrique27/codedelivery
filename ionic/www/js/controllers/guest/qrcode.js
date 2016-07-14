angular.module('starters.controllers')
    .controller('GuestQrcodeController',
        ['$scope', '$state', '$ionicPopup', '$stateParams',
            function ($scope, $state, $ionicPopup, $stateParams ) {

               var qrCode = new QRCode(document.getElementById("qrcode"), $stateParams.id);

            }]);