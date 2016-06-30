angular.module('starters.controllers')
    .controller('LoginCtrl', ['$scope', 'OAuth', 'OAuthToken', '$ionicPopup', '$state', 'UserData', 'User', '$redirect',
        function ($scope, OAuth, OAuthToken, $ionicPopup, $state, UserData, User, $redirect) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.doLogIn = function () {
                var promise = OAuth.getAccessToken($scope.user)

                promise
                    .then( function (data) {
                        return User.authenticated({include: 'client'}).$promise;
                    })
                    .then(function (data) {
                        UserData.set(data.data);
                        $redirect.redirectAfterLogin();
                        
                    }, function (dataError) {
                        UserData.set(null);
                        OAuthToken.removeToken();
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Login e/ou Senha inválidos.'
                        });
                    });
            }

        }])

    .controller('ForgotPasswordCtrl', function($scope, $state) {
        $scope.recoverPassword = function(){

        };

        $scope.user = {};
    })

    .controller('SignupCtrl', function($scope, $state) {
        $scope.user = {};

        $scope.user.email = "";

        $scope.doSignUp = function(){

        };
    })