angular.module('starters.controllers')
    .controller('GuestProfileController',
        ['$scope', '$state', '$ionicLoading', 'UserData', '$filter', 'Guest', '$ionicPopup', 'ionicDatePicker', '$filter',
        function ($scope, $state, $ionicLoading, UserData, $filter, Guest, $ionicPopup, ionicDatePicker, $filter) {

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
                    //$scope.guest = data.data;
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
                var ipObj1 = {
                    callback: function (val) {  //Mandatory
                        $scope.guest.birthdate = $filter('DateToDatabaseFormat')(val);
                    },
                    inputDate: new Date($scope.guest.birthdate)     //Optional
                };
                ionicDatePicker.openDatePicker(ipObj1);
            };
        }]);
