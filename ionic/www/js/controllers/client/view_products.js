angular.module('starters.controllers')
    .controller('ClientViewProductsController', ['$scope', '$state', 'Products', '$ionicLoading', '$cart',
        function ($scope, $state, Products, $ionicLoading, $cart) {

            $ionicLoading.show({
                template: 'Carregando ...'
            });

            $scope.products = [];
            Products.query({}, function (data) {
                //sucesso
                $scope.products = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                //fracasso
                $ionicLoading.hide();
            });

            $scope.addItem = function ( item ) {
                item.qtd = 1;
                $cart.addItem( item );

                $state.go('client.checkout');
            };
        }]);