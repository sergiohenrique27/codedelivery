angular.module('starters.controllers')
    .controller('LoginController', ['$scope', 'OAuth', '$ionicPopup', '$state',
        function ($scope, OAuth, $ionicPopup, $state, meuValue) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.login = function () {
                OAuth.getAccessToken($scope.user).then(function (data) {
                    //sucesso
                    $state.go('home');
                }, function (responseErro) {
                    //fracasso
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login e/ou Senha inválidos.'
                    });
                });
            }

        }]);