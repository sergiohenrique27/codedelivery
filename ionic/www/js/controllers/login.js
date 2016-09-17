angular.module('starters.controllers')
    .controller('LoginCtrl', ['$scope', 'OAuth', 'OAuthToken', '$ionicPopup', '$state', 'UserData', 'User', '$redirect',
        function ($scope, OAuth, OAuthToken, $ionicPopup, $state, UserData, User, $redirect) {

            $scope.user = {
                username: '',
                password: ''
            };

            $scope.doLogIn = function () {
                var promise = OAuth.getAccessToken($scope.user);

                promise
                    .then( function (data) {
                        return User.authenticated({include: 'guest'}).$promise;
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

    .controller('ForgotPasswordCtrl', function($scope, $state, User, $ionicPopup, $ionicLoading) {

        $scope.recoverPassword = function(){
            $ionicLoading.show({
                template: 'Carregando ...'
            });

            User.resetPassword({email: $scope.user.email }).$promise
                .then(
                    function (data) {
                        $ionicPopup.alert({
                            title: 'Link enviado',
                            template: 'E-mail enviado com o link para alteração da senha.'
                        });
                    },function(dataError){
                        $ionicPopup.alert({
                            title: 'Advertência',
                            template: 'Houve um erro.'
                        });
                    }
                );
            $ionicLoading.hide();
        };

        $scope.user = {};
    })

    .controller('SignupCtrl',
        ['$scope', '$state', 'User', '$ionicPopup', function($scope, $state, User, $ionicPopup) {
        $scope.user = {
            name: '',
            email: '',
            password: ''
        };

        $scope.doSignUp = function(){
            //User.authenticated({include: 'client'}).$promise;
            var promise = User.signup( $scope.user ).$promise;

            promise.then(function (data) {
                $ionicPopup.alert({
                    title: 'Seja bem-vindo',
                    template: 'Cadastro efetuado com sucesso. Faça o seu login.'
                });
                $state.go('auth.login');

            }, function (dataError) {
                var msg = "";
                angular.forEach(dataError.data, function(value, key){
                   msg += value + '<br/>'
                });
                $ionicPopup.alert({
                    title: 'Advertência',
                    template: msg
                });
            });
        };
    }])