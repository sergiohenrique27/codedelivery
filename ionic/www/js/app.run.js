angular.module('starters.run').run(['PermissionStore', 'OAuth', 'UserData', 'RoleStore', '$rootScope', 'authService', '$state', '$ionicPopup',
    function (PermissionStore, OAuth, UserData, RoleStore, $rootScope, authService, $state, $ionicPopup) {

        PermissionStore.definePermission('user-permission', function () {
            return OAuth.isAuthenticated();
        });

        PermissionStore.definePermission('client-permission', function () {
            var user = UserData.get();
            if (user == null || !user.hasOwnProperty('role')) {
                return false;
            }
            return user.role == 'client';
        });

        PermissionStore.definePermission('deliveryman-permission', function () {
            var user = UserData.get();
            if (user == null || !user.hasOwnProperty('role')) {
                return false;
            }
            return user.role == 'deliveryman';
        });

        RoleStore.defineRole('client-role', ['user-permission', 'client-permission']);

        RoleStore.defineRole('deliveryman-role', ['user-permission', 'deliveryman-permission']);

        $rootScope.$on('event:auth-loginRequired', function (event, data) {

            switch (data.data.error) {
                case 'access_denied' :
                    if (!$rootScope.refreshingtoken) {
                        $rootScope.refreshingtoken = OAuth.getRefreshToken();
                    }
                    $rootScope.refreshingtoken.then(function (data) {
                        authService.loginConfirmed();
                        $rootScope.refreshingtoken = null;
                    }, function (responseError) {
                        $state.go('logout');
                    });
                    break;
                case 'invalid_credentials':
                    $ionicPopup.alert({
                        title: 'Advertência',
                        template: 'Login e/ou Senha inválidos.'
                    });
                    break;
                default:
                    $state.go('logout');
                    break;
            }


        });

    }]);
