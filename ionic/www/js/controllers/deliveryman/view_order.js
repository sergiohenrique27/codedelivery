angular.module('starters.controllers')
    .controller('DeliverymanViewOrderController', [
        '$scope', '$stateParams', 'DeliverymanOrder', '$ionicLoading', '$cordovaGeolocation', '$ionicPopup',
        function ($scope, $stateParams, DeliverymanOrder, $ionicLoading, $cordovaGeolocation, $ionicPopup) {
            var watch;
            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando ...'
            });

            $scope.products = [];
            DeliverymanOrder.get({id: $stateParams.id, include: "items,cupom"}, function (data) {
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                $ionicLoading.hide();
            });

            $scope.goToDelivery = function () {
                $ionicPopup.alert({
                    title: 'Advertência',
                    template: 'Para parar a localização dê OK!'
                }).then(function () {
                    stopWatchPosition();
                });

                DeliverymanOrder.updateStatus({id: $stateParams.id}, {status: 1}, function () {


                    var watchOptions = {
                        timeout: 10000,
                        enableHighAccuracy: false
                    };

                    watch =  $cordovaGeolocation.watchPosition( watchOptions);

                    watch.then(
                        function(data){
                            console.log(data);
                        },
                        function (responseError) {
                            console.log(responseError);
                        },
                        function (position) {
                            console.log( position );
                            DeliverymanOrder.geo({
                                id: $stateParams.id,
                                latitude: position.coords.latitude,
                                longitude: position.coords.longitude
                            });
                        }
                    );
                    
                });
            };
            
            function stopWatchPosition() {
                if(watch && typeof watch == 'object' && watch.hasOwnProperty('whatchID')){
                    $cordovaGeolocation.clearWatch( watch.watchID );
                }
            }
        }]);