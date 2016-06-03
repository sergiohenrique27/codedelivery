angular.module('starters.controllers')
    .controller('ClientCheckoutDetailController', ['$scope', '$state', '$cart', '$stateParams',
        function ($scope, $state, $cart, $stateParams ) {
            $scope.product = $cart.getItem($stateParams.index);

            $scope.updateQtd = function () {

                $cart.updateQtd($stateParams.index, $scope.product.qtd);
                $state.go('client.checkout');

            }
        }]);