angular.module('starters.controllers')
    .controller('GuestShowCompanionController', ['$scope', '$state', '$stateParams', 'Guest', '$ionicLoading','ionicDatePicker', '$filter',
        function ($scope, $state, $stateParams, Guest, $ionicLoading, ionicDatePicker, $filter) {
            $scope.guest = {
                id: null
            };

            if ($stateParams.id) {
                $ionicLoading.show({
                    template: 'Carregando ...'
                });

                Guest.getCompanion({id: $stateParams.id}, {}, function (data) {
                    $scope.guest = data;

                    $ionicLoading.hide();
                }, function (dataError) {
                    $ionicLoading.hide();
                });
            }

            $scope.save = function () {
                $ionicLoading.show({
                    template: 'Salvando ...'
                });

                Guest.storeCompanion({id: $scope.guest.id}, {guest: $scope.guest}, function (data) {
                    //$scope.guest = data.data;

                    $ionicLoading.hide();
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

        }])
;