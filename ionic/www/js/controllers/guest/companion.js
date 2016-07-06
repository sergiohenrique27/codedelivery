angular.module('starters.controllers')
    .controller('GuestCompanionController', ['$scope', '$state', '$ionicLoading', 'Guest',
        function ($scope, $state, $ionicLoading, Guest) {
            $scope.companions = null;
            $scope.showDelete = false;


            Guest.getCompanions({include: 'companions'}).$promise

                .then(function (data) {
                    $scope.companions = data.data;
                }, function (dataError) {

                });


            $scope.removeItem = function (i) {

                Guest.destroyCompanion({id: $scope.companions[i].id}).$promise

                    .then(function (data) {
                        $scope.companions.splice(i, 1);
                        $ionicPopup.alert({
                            title: 'Aviso',
                            template: 'Acompanhante excluido com sucesso'
                        });
                    }, function (dataError) {
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Não foi possivel excluir o acompanhante.'
                        });
                    });
            }

            $scope.showDetail = function (i) {
                //    $state.go('client.checkout_item_detail',{index: i})
            }
        }])
;