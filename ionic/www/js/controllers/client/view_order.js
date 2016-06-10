angular.module('starters.controllers')
    .controller('ClientViewOrderController', ['$scope', '$stateParams', 'Order', '$ionicLoading',
        function ($scope, $stateParams, Order, $ionicLoading) {

            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando ...'
            });

            $scope.products = [];
            Order.get({id: $stateParams.id, include: "items,cupom"}, function (data) {
                //sucesso
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                //fracasso
                $ionicLoading.hide();
            });
            
        }]);