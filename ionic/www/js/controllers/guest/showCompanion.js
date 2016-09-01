angular.module('starters.controllers')
    .controller('GuestShowCompanionController', ['$scope', '$state', '$stateParams', 'Guest', '$ionicLoading',
        'ionicDatePicker', '$filter', '$ionicPopup',
        function ($scope, $state, $stateParams, Guest, $ionicLoading, ionicDatePicker, $filter, $ionicPopup) {
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
                    $scope.guest.id = data.id;
                    $ionicLoading.hide();
                    $ionicPopup.alert({
                        title: 'Aviso',
                        template: 'Acompanhante salvo.'
                    });
                }, function (dataError) {
                    $ionicLoading.hide();
                });

            };

            $scope.openDatePickerBirthdate = function(){
                var dtAux = $scope.guest.birthdate;

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
                    inputDate: new Date(inputDate)     //Optional
                };
                ionicDatePicker.openDatePicker(ipObj1);
            };

        }])
;