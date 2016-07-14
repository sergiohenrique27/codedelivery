angular.module('starters.controllers')
    .controller('GuestCompanionController', ['$scope', '$state', '$ionicLoading', 'Guest', '$ionicPopup',
        function ($scope, $state, $ionicLoading, Guest, $ionicPopup) {
            $scope.companions = null;
            $scope.showDelete = false;


            Guest.getCompanions({include: 'companions'}).$promise

                .then(function (data) {
                    $scope.companions = data.data;
                }, function (dataError) {
                    alert('Erro');
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
                    $state.go('guest.showCompanion',{id: $scope.companions[i].id} );
            }

            $scope.addCompanion = function () {
                $state.go('guest.showCompanion');
            }
        }])
;