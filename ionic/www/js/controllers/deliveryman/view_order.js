angular.module('starters.controllers')
    .controller('DeliverymanViewOrderController', ['$scope', '$stateParams', 'DeliverymanOrder', '$ionicLoading',
        function ($scope, $stateParams, DeliverymanOrder, $ionicLoading) {

            $scope.order = {};

            $ionicLoading.show({
                template: 'Carregando ...'
            });

            $scope.products = [];
            DeliverymanOrder.get({id: $stateParams.id, include: "items,cupom"}, function (data) {
                //sucesso
                $scope.order = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                //fracasso
                $ionicLoading.hide();
            });
            
        }]);