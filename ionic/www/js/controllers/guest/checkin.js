angular.module('starters.controllers')

    .controller('GuestCheckinController',
        ['$scope', '$state', '$ionicLoading', 'Hotel', '$ionicPopup', 'UserData', 'Guest', 'Checkin', '$stateParams', 'ionicDatePicker', '$filter',
            function ($scope, $state, $ionicLoading, Hotel, $ionicPopup, UserData, Guest, Checkin, $stateParams, ionicDatePicker, $filter)
{

    $scope.Hotels = [];
    $scope.SelectedHotel = null;
    //$scope.guest = null;
    $scope.companions = null;
    $scope.canUpdate = true;

    $ionicLoading.show({
        template: 'Carregando ...'
    });

    var user = UserData.get();
    if (user.guest) {
        $scope.guest = user.guest.data;
    }

    $scope.checkin = {
        id: null,
        guests: [
             $scope.guest.id
        ]
    };

    Guest.getCompanions({include: 'companions'}).$promise
        .then(function (data) {
            $scope.companions = data.data;
        }, function (dataError) {
            alert('Erro');
        });


    var query = null;
    Hotel.get({name: query}).$promise
        .then(function (data) {
            $scope.Hotels = data.data;
        }, function (dataError) {
            alert('Erro')
        });



    //pegar checkin
    if ($stateParams.id) {

        Checkin.getCheckin({id: $stateParams.id, include: 'hotel,guests'}, {}, function (data) {
            $scope.checkin = data.data;

            //setando sempre o usuario do app para fazer checkin

            $scope.SelectedHotel = data.data.hotel.data;


            if ($scope.checkin.status != 'A')
                $scope.canUpdate = false;

            var guestsSelecionados = data.data.guests.data;

            for (var i = 0; i < guestsSelecionados.length; i++) {


                if ($scope.guest.id == guestsSelecionados[i].id) {
                    $scope.checkin.guests[0] = guestsSelecionados[i].id;
                    continue;
                }


                for (var j = 0; j < $scope.companions.length; j++) {
                    if ($scope.companions[j].id == guestsSelecionados[i].id) {
                        $scope.checkin.guests[j + 1] = guestsSelecionados[i].id;
                        continue;
                    }
                }

                delete $scope.checkin.guests[ 'data' ];
            };

            $ionicLoading.hide();
        }, function (dataError) {
            $ionicLoading.hide();
        });
    }




    $ionicLoading.hide();



    $scope.openDatePickerCheckin = function(){
        var dtAux = $scope.checkin.checkin;

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
                $scope.checkin.checkin = $filter('DateToDatabaseFormat')(val);
            },
            inputDate: new Date(inputDate)     //Optional
        };
        ionicDatePicker.openDatePicker(ipObj1);
    };

    $scope.openDatePickerCheckout = function(){
        var dtAux = $scope.checkin.checkout;

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
                $scope.checkin.checkout = $filter('DateToDatabaseFormat')(val);
            },
            inputDate: new Date(inputDate)     //Optional
        };
        ionicDatePicker.openDatePicker(ipObj1);
    };

    $scope.afterSelectedHotel = function (selected) {
        if (selected) {
            $scope.SelectedHotel = selected.originalObject;
            $scope.checkin.hotel_id = $scope.SelectedHotel.id;
        }
    };

    $scope.limparHotel = function () {
        $scope.SelectedHotel = null;
        $scope.checkin.hotel_id = null;
        $scope.searchStr = null;
    };

    $scope.save = function () {
        $ionicLoading.show({
            template: 'Salvando ...'
        });



        console.log($scope.checkin);

        Checkin.store({id: $scope.checkin.id}, {checkin: $scope.checkin}, function (data) {
            $scope.checkin.id = data.id;

            $ionicLoading.hide();
            $state.go('guest.qrcode', {id: data.id});
        }, function (dataError) {
            $ionicLoading.hide();
        });
    }
}
]);

