angular.module('starters.controllers')
    .controller('ClientMenuController', ['$scope', '$state', '$ionicLoading', 'User',
        function ($scope, $state, $ionicLoading, User) {
            $scope.user = {
                name: ""
            };

            $ionicLoading.show({
                template: 'Carregando ...'
            });

            User.authenticated({}, function (data) {
                //sucesso
                $scope.user = data.data;
                $ionicLoading.hide();
            }, function (dataError) {
                //fracasso
                $ionicLoading.hide();
            });
            
        }]);