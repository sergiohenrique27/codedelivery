angular.module('starters.controllers')
    .controller('ClientCheckoutSuccessfulController', ['$scope', '$state', '$cart',
        function ($scope, $state, $cart) {

            var cart = $cart.get();
            $scope.cupom = cart.cupom;
            $scope.items = cart.items;
            $scope.total = $cart.getTotalFinal();

            $cart.clear();
            
            $scope.openListOrder = function () {
                $state.go('client.order');
            };

        }]);