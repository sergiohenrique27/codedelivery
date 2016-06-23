angular.module('starters.controllers')
    .controller('ClientViewDeliveryController', [
        '$scope', '$stateParams', 'Order', '$ionicLoading', '$ionicPopup', 'UserData', '$pusher', '$window', '$map',
        'uiGmapGoogleMapApi',
        function ($scope, $stateParams, Order, $ionicLoading, $ionicPopup, UserData, $pusher, $window, $map,
                  uiGmapGoogleMapApi) {
            var urlIcon = "http://maps.google.com/mapfiles/kml/pal2";
            $scope.map = $map;

            $scope.markers = [];

            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando ...'
            });

            uiGmapGoogleMapApi.then(function (maps) {
                $ionicLoading.hide();
            }, function (error) {
                $ionicLoading.hide();
            });

            $scope.products = [];
            Order.get({id: $stateParams.id, include: "items,cupom"}, function (data) {
                //sucesso
                $scope.order = data.data;

                if ($scope.order.status == 1) {
                    initMarkers($scope.order);
                } else {
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Pedido não está em estado de entrega.'
                    });
                }
            });

            function initMarkers(order) {
                var client = UserData.get().client.data,
                    address = client.zipcode + ', ' + client.address + ', ' + client.city + ' - ' + client.state;

                createMarkerClient(address);
                whatchPositionDeliveryman(order.hash);
            }

            function createMarkerClient(address) {
                console.log(address);
                var geocoder = new google.maps.Geocoder();

                geocoder.geocode({
                    address: address
                }, function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat(),
                            longitude = results[0].geometry.location.lng();

                        $scope.markers.push({
                            id: "Cliente",
                            coords: {
                                latitude: latitude,
                                longitude: longitude
                            },
                            options: {
                                title: "Local de Entrega",
                                icon: urlIcon + '/icon2.png'
                            }
                        });

                    } else {
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Não foi possível encontrar o seu endereço.'
                        });
                    }
                });
            };

            function whatchPositionDeliveryman(channel) {
                var pusher = $pusher($window.client),
                    channel = pusher.subscribe(channel);

                channel.bind('CodeDelivery\\Events\\GetLocationDeliveryman', function (data) {
                    var latitude = data.geo.latitude,
                        longitude = data.geo.longitude;


                    if ($scope.markers.length == 1 || $scope.markers.length == 0) {
                        $scope.markers.push({
                            id: "Entregador",
                            coords: {
                                latitude: latitude,
                                longitude: longitude
                            },
                            options: {
                                title: "Entregador",
                                icon: urlIcon + '/icon47.png'
                            }
                        });

                    } else {
                        for (var key in $scope.markers) {
                            if ($scope.markers[key] == "Entregador") {
                                $scope.markers[key].coords = {
                                    latitude: latitude,
                                    longitude: longitude
                                }
                            }
                        }
                    }
                });
            }

            $scope.$watch('markers.length', function (value) {
                if (value == 2) {
                    createBounds();
                }
            });

            function createBounds() {
                var bounds = new google.maps.LatLngBounds(),
                    LatLng;

                angular.forEach($scope.markers, function (value) {
                    LatLng = new google.maps.LatLng(Number(value.coords.latitude), Number(value.coords.longitude));
                    bounds.extend(LatLng);
                });

                $scope.map.bounds = {
                    northeast: {
                        latitude: bounds.getNorthEast().lat(),
                        longitude: bounds.getNorthEast().lng()
                    },
                    southwest: {
                        latitude: bounds.getSouthWest().lat(),
                        longitude: bounds.getSouthWest().lng()
                    }
                };
            }

        }])
    .controller('CvdControlDescentralize', ['$scope', '$map', function ($scope, $map) {
        $scope.map = $map;
        $scope.fit = function () {
            $scope.map.fit = !$scope.map.fit;
        }
    }])
    .controller('CvdControlReload', [ '$scope', '$window', '$timeout', function ($scope, $window, $timeout) {
        $scope.reload = function () {
            $timeout(function () {
                $window.location.reload(true);
            },100)
        }

    }])