angular.module('starters.controllers')
    .controller('ClientOrderController', ['$scope', '$state', '$ionicLoading', '$ionicActionSheet', 'Order', '$timeout',
        function ($scope, $state, $ionicLoading, $ionicActionSheet, Order, $timeout) {
            var page = 1;
            $scope.items = [];
            $scope.canMoreItems = true;
/*

            $ionicLoading.show({
                template: 'Carregando ...'
            });
*/
            $scope.doRefresh = function () {

                page = 1;
                $scope.items = [];
                $scope.canMoreItems = true;
                $scope.loadMore();

                $timeout(function () {
                    $scope.$broadcast('scroll.refreshComplete');
                },200);

               /* getOrders().then(
                    function (data) {
                        $scope.items = data.data;
                        $scope.$broadcast('scroll.refreshComplete');
                    }, function (dataError) {
                        $scope.$broadcast('scroll.refreshComplete');
                    }
                ); */
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
            };

            $scope.loadMore = function(){
                getOrders().then(function (data) {
                    $scope.items = $scope.items.concat( data.data );
                    page += 1;
                    $scope.$broadcast('scroll.infiniteScrollComplete');

                    if ($scope.items.length == data.meta.pagination.total){
                        $scope.canMoreItems = false;
                    }
                });
            };
            
            function getOrders() {
                return Order.query({
                    id: null,
                    page: page,
                    orderBy: 'created_at',
                    sortedBy: 'desc'
                }).$promise;
            };

/*
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

*/
        }]);