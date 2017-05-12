<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth.login');
    //return view('welcome');
});

// Rotas para solicitar trocar de senha...
Route::get('password/email', 'PasswordController@getEmail');
Route::post('password/email', 'PasswordController@postEmail');

// Rotas para trocar a senha...
Route::get('password/reset/{token}', 'PasswordController@getReset');
Route::post('password/reset', 'PasswordController@postReset');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth.checkrole:admin'], function () {

    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CategoriesController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'CategoriesController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CategoriesController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CategoriesController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'CategoriesController@update']);
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ProductsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'ProductsController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'ProductsController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ProductsController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'ProductsController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'ProductsController@destroy']);
    });

    Route::group(['prefix' => 'clients', 'as' => 'clients.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'ClientsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'ClientsController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'ClientsController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'ClientsController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'ClientsController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'ClientsController@destroy']);
    });

    Route::group(['prefix' => 'orders', 'as' => 'orders.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'OrdersController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'OrdersController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'OrdersController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'OrdersController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'OrdersController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'OrdersController@destroy']);
    });

    Route::group(['prefix' => 'cupoms', 'as' => 'cupoms.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CupomsController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'CupomsController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CupomsController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'CupomsController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'CupomsController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'CupomsController@destroy']);
    });

    // - rotas app admin/
    Route::group(['prefix' => 'employees', 'as' => 'employees.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'EmployeeController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'EmployeeController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'EmployeeController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'EmployeeController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'EmployeeController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'EmployeeController@destroy']);
    });

});


Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => 'auth.checkrole:client'], function () {

    Route::group(['prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'CheckoutController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'CheckoutController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'CheckoutController@store']);
    });
});

Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => 'auth.checkrole:employee'], function () {
    Route::group(['prefix' => 'checkin', 'as' => 'checkin.'], function () {
        Route::get('index', ['uses' => 'CheckinController@index', 'as' => 'index']);
        Route::get('find', ['uses' => 'CheckinController@find', 'as' => 'find']);
        Route::post('doList', ['uses' => 'CheckinController@doList', 'as' => 'doList']);
        Route::get('showList/{id}', ['uses' => 'CheckinController@showList', 'as' => 'showList']);
        Route::post('show', ['uses' => 'CheckinController@show', 'as' => 'show']);
        Route::get('show/{qrcode}/{msg?}', ['uses' => 'CheckinController@show2', 'as' => 'show2']);
        Route::get('ficha/{id}', ['uses' => 'CheckinController@ficha', 'as' => 'ficha']);
        Route::get('update/{id}', ['uses' => 'CheckinController@update', 'as' => 'update']);
        Route::put('store/{id}', ['uses' => 'CheckinController@store', 'as' => 'store']);
        Route::get('guest/{idCheckin}/{id}', ['uses' => 'CheckinController@guest', 'as' => 'guest']);
        Route::put('storeGuest/{idCheckin}/{id}', ['uses' => 'CheckinController@storeGuest', 'as' => 'storeGuest']);
        Route::get('updateStatus/{id}/{status}', ['uses' => 'CheckinController@updateStatus', 'as' => 'updateStatus']);
        Route::get('top10', ['uses' => 'CheckinController@top10', 'as' => 'top10']);
        Route::get('findQuantidade', ['uses' => 'CheckinController@findQuantidade', 'as' => 'findQuantidade']);
        Route::post('getQuantidade', ['uses' => 'CheckinController@getQuantidade', 'as' => 'getQuantidade']);
    });
});

Route::group(['prefix' => 'superadmin', 'as' => 'superadmin.', 'middleware' => 'auth.checkrole:superadmin'], function () {

    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'AdminController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'AdminController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'AdminController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'AdminController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'AdminController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'AdminController@destroy']);
    });


    // Cadastro de hoteis - superadmin ss

    Route::group(['prefix' => 'hotels', 'as' => 'hotels.'], function () {
        Route::get('/', ['as' => 'index', 'uses' => 'HotelController@index']);
        Route::get('create', ['as' => 'create', 'uses' => 'HotelController@create']);
        Route::post('store', ['as' => 'store', 'uses' => 'HotelController@store']);
        Route::get('edit/{id}', ['as' => 'edit', 'uses' => 'HotelController@edit']);
        Route::put('update/{id}', ['as' => 'update', 'uses' => 'HotelController@update']);
        Route::get('destroy/{id}', ['as' => 'destroy', 'uses' => 'HotelController@destroy']);
    });

});

Route::group(['middleware' => 'cors'], function () {

    Route::post('api/oauth/access_token', function () {
        return Response::json(Authorizer::issueAccessToken());
    });

    Route::post('api/signup', [
        'uses' => 'api\SignupController@store',
        'as' => 'signup'
    ]);

    Route::post('api/password/email', 'Auth\PasswordController@postEmail');

    Route::group(['prefix' => 'api', 'as' => 'api.', 'middleware' => 'oauth'], function () {

        Route::group(['prefix' => 'client', 'as' => 'client.', 'middleware' => 'oauth.checkrole:client'], function () {
            Route::resource('order',
                'api\client\ClientCheckoutController',
                ['except' => ['edit', 'create', 'destroy']]
            );
            Route::get('products', ['as' => 'products', 'uses' => 'api\client\ClientProductController@index']);
        });

        Route::group(['prefix' => 'deliveryman', 'as' => 'deliveryman.', 'middleware' => 'oauth.checkrole:deliveryman'], function () {
            Route::resource('order',
                'api\deliveryman\DeliverymanCheckoutController',
                ['except' => ['edit', 'create', 'destroy', 'store']]
            );
            Route::patch('order/{id}/update-status', [
                'uses' => 'api\deliveryman\DeliverymanCheckoutController@updateStatus',
                'as' => 'order.updateStatus'
            ]);
            Route::post('order/{id}/geo', [
                'uses' => 'api\deliveryman\DeliverymanCheckoutController@geo',
                'as' => 'orders.geo'
            ]);
        });

        Route::group(['prefix' => 'guest', 'as' => 'guest.', 'middleware' => 'oauth.checkrole:guest'], function () {

            /* Route::resource('guest',
                 'api\guest\GuestController',
                 //['except' => ['edit', 'create', 'destroy']]
                 ['except' => [ 'destroy']]
             );
             */

            Route::put('guest', ['uses' => 'api\guest\GuestController@updateProfile', 'as' => 'guest']);
            Route::get('companions', ['uses' => 'api\guest\GuestController@listCompanions', 'as' => 'companions']);
            Route::delete('companions/{id}', ['uses' => 'api\guest\GuestController@destroyCompanion', 'as' => 'destroyCompanion']);
            Route::get('companions/{id}', ['uses' => 'api\guest\GuestController@showCompanion', 'as' => 'showCompanion']);
            Route::get('cep/{cep}', ['uses' => 'api\guest\GuestController@cep', 'as' => 'getCEP']);
            Route::put('companion', ['uses' => 'api\guest\GuestController@storeCompanion', 'as' => 'storeCompanion']);


            Route::group(['prefix' => 'checkin', 'as' => 'checkin.'], function () {
                Route::put('store', ['uses' => 'api\guest\CheckinController@store', 'as' => 'store']);
                Route::get('listCheckin/{status}', ['uses' => 'api\guest\CheckinController@listCheckin', 'as' => 'listCheckin']);
                Route::get('{id}', ['uses' => 'api\guest\CheckinController@getCheckin', 'as' => 'checkin']);
            });

        });

        Route::get('hotel', [
            'uses' => 'api\HotelController@getHotels',
            'as' => 'hotel'
        ]);

        get('authenticated', 'api\UserController@authenticated');
        Route::get('cupom/{code}', 'api\CupomController@show');

    });
});