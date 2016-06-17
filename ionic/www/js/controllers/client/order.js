angular.module('starters.controllers')
    .controller('ClientOrderController', ['$scope', '$state', '$ionicLoading', '$ionicActionSheet', 'Order',
        function ($scope, $state, $ionicLoading, $ionicActionSheet, Order) {
            $scope.items = [];

            $ionicLoading.show({
                template: 'Carregando ...'
            });

            $scope.doRefresh = function () {
                getOrders().then(
                    function (data) {
                        $scope.items = data.data;
                        $scope.$broadcast('scroll.refreshComplete');
                    }, function (dataError) {
                        $scope.$broadcast('scroll.refreshComplete');
                    }
                );
            };

            $scope.openOrderDetail = function (order) {
                $state.go('client.view_order', {id: order.id})
            };

            $scope.showActionSheet = function(order){
                $ionicActionSheet.show({
                   buttons: [
                       {text: 'ver detalhes'},
                       {text: 'ver entrega'}
                   ],
                    titleText: 'O que fazer?',
                    cancelText: 'cancelar',
                    cancel: function () {

                    },
                    buttonClicked: function (i) {
                        switch (i){
                            case 0:
                                $state.go('client.view_order', {id: order.id});
                                break;
                            case 1:
                                $state.go('client.view_delivery', {id: order.id});
                                break;
                        }
                    }
                });
            }
            
            function getOrders() {
                return Order.query({
                    id: null,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            };


            getOrders().then(
                function (data) {
                    //sucesso
                    $scope.items = data.data;
                    $ionicLoading.hide();
                }, function (dataError) {
                    //fracasso
                    $ionicLoading.hide();
                }
            );


        }]);