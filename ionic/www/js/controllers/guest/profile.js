angular.module('starters.controllers')
    .controller('GuestProfileController',
        ['$scope', '$state', '$ionicLoading', 'UserData', '$filter', 'Guest', '$ionicPopup', 'ionicDatePicker', 'User',
            function ($scope, $state, $ionicLoading, UserData, $filter, Guest, $ionicPopup, ionicDatePicker, User) {

                var user = UserData.get(),
                    guest = null;

                if (user.guest) {
                    guest = user.guest.data;
                } else {
                    guest = {
                        user_id: user.id
                    }
                }

                $ionicPopup.alert({
                    title: 'Aviso',
                    template: 'Preencha as informações do seu perfil para agilizar os seus Checkins.'
                });

                $scope.guest = guest;


                $scope.save = function () {
                    $ionicLoading.show({
                        template: 'Salvando ...'
                    });

                    Guest.updateProfile({id: $scope.guest.id}, {guest: $scope.guest}, function (data) {

                        if ($scope.guest.id != null && $scope.guest.id !== undefined) {
                            var promise = User.authenticated({include: 'guest'}).$promise;
                            promise
                                .then(function (data) {
                                    UserData.set(data.data);
                                });
                        }

                        $ionicLoading.hide();

                        $ionicPopup.alert({
                            title: 'Aviso',
                            template: 'Perfil salvo. <br/> Você pode adicionar acompanhantes acessando o <b>menu / Acompanhantes</b> ou ' +
                                'agendar Checkins acessando o  <b>menu / Checkins</b>'
                        });

                    }, function (dataError) {
                        $ionicLoading.hide();
                    });

                };

                $scope.openDatePickerBirthdate = function () {
                    var
                        dtAux = $scope.guest.birthdate;

                    if (dtAux != null && dtAux !== undefined) {
                        var
                            dia = dtAux.slice(0, 3),
                            mes = dtAux.slice(3, 5),
                            ano = dtAux.slice(6, 10);

                        inputDate = new Date(ano + '-' + mes + '-' + dia);

                    }
                    else {
                        inputDate = new Date();
                    }

                    var ipObj1 = {
                        callback: function (val) {  //Mandatory

                            $scope.guest.birthdate = $filter('DateToDatabaseFormat')(val);
                        },
                        inputDate: inputDate     //Optional
                    };
                    ionicDatePicker.openDatePicker(ipObj1);
                };
            }]);
