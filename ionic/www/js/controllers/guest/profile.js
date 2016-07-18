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

                Guest.updateProfile({id: $scope.guest.id},{guest: $scope.guest}, function (data) {

                    if (!$scope.guest.id) {
                        var promise = User.authenticated({include: 'guest'}).$promise;
                        promise
                            .then(function (data) {
                                UserData.set(data.data);
                            });
                    }

                    $ionicLoading.hide();

                    $ionicPopup.alert({
                        title: 'Aviso',
                        template: 'Perfil salvo.'
                    });

                }, function (dataError) {
                    $ionicLoading.hide();
                });

            };

            $scope.openDatePickerBirthdate = function(){
                var inputDate = $scope.guest.birthdate;
                if (!inputDate){
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
