// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
angular.module('starters.controllers', []);
angular.module('starters.services', []);
angular.module('starters.filters', []);
angular.module('starters.run', []);
angular.module('starters.directives', []);

angular.module('starter',
    [
        'ionic','ionic.service.core',
        'angular-oauth2',
        'starters.controllers',
        'ngResource',
        'starters.services',
        'ngCordova',
        'starters.filters',
        'uiGmapgoogle-maps',
        'pusher-angular',
        'ui.router',
        'permission', 'permission.ui',
        'starters.run',
        'http-auth-interceptor',
        'starters.directives'
    ])
    .constant('appConfig',{
       // baseUrl: 'http://192.168.0.19:8000/',     // ortoclinica
        baseUrl: 'http://192.168.0.11:8000/',   //casa
        //baseUrl: 'http://192.34.59.160/',       //digital ocean
        pusherKey: "71402c1e63208f41327c",
        redirectAfterLogin:{
            'client': 'client.order',
            'deliveryman': 'deliveryman.order'
        }
    })

    .run(function ($ionicPlatform, $window, appConfig) {
        $window.client = new Pusher(appConfig.pusherKey);
        $ionicPlatform.ready(function () {
            if (window.cordova && window.cordova.plugins.Keyboard) {
                // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
                // for form inputs)
                cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

                // Don't remove this line unless you know what you are doing. It stops the viewport
                // from snapping when text inputs are focused. Ionic handles this internally for
                // a much nicer keyboard experience.
                cordova.plugins.Keyboard.disableScroll(true);
            }
            if (window.StatusBar) {
                StatusBar.styleDefault();
            }
        });
    })

    .config(function ($stateProvider, $urlRouterProvider, OAuthProvider, OAuthTokenProvider, appConfig, $provide) {
        $stateProvider

            .state('auth', {
                url: "/auth",
                templateUrl: "templates/auth/auth.html",
                abstract: true,
                controller: 'AuthCtrl'
            })
            .state('auth.login', {
                cache: false,
                url: '/login',
                templateUrl: "templates/auth/login.html",
                controller: 'LoginCtrl'
            })

            .state('auth.walkthrough', {
                url: '/walkthrough',
                templateUrl: "templates/auth/walkthrough.html"
            })

            .state('auth.forgot-password', {
                url: "/forgot-password",
                templateUrl: "templates/auth/forgot-password.html",
                controller: 'ForgotPasswordCtrl'
            })

            .state('auth.signup', {
                url: '/signup',
                templateUrl: "templates/auth/signup.html",
                controller: 'SignupCtrl'
            })

            .state('logout', {
                cache: false,
                url: '/logout',
                controller: 'LogoutController'
            })
            .state('home', {
                url: '/home',
                templateUrl: 'templates/home.html',
                controller: function ($scope ) {
                }
            })

            .state('client',{
                abstract: true,
                cache: false,
                url: '/client',
                templateUrl: 'templates/client/menu.html',
                controller: 'ClientMenuController',
                data: {
                    permissions:{
                        only: ['client-role']
                    }
                }
            })
            .state('client.order', {
                cache: false,
                url: '/order',
                templateUrl: 'templates/client/order.html',
                controller: 'ClientOrderController'
            })
            .state('client.view_order', {
                cache: false,
                url: '/view_order/:id',
                templateUrl: 'templates/client/view_order.html',
                controller: 'ClientViewOrderController'
            })
            .state('client.checkout', {
                cache: false,
                url: '/checkout',
                templateUrl: 'templates/client/checkout.html',
                controller: 'ClientCheckoutController'
            })
            .state('client.checkout_item_detail', {
                url: '/checkout/detail/:index',
                templateUrl: 'templates/client/checkout_item_detail.html',
                controller: 'ClientCheckoutDetailController'
            })
            .state('client.checkout_successful',{
                cache: false,
                url: '/checkout/successful',
                templateUrl: 'templates/client/checkout_successful.html',
                controller: 'ClientCheckoutSuccessfulController'
            })
            .state('client.view_products', {
                url: '/view_products',
                templateUrl: 'templates/client/view_products.html',
                controller: 'ClientViewProductsController'
            })
            .state('client.view_delivery',{
                cache: false,
                url: '/view_delivery/:id',
                templateUrl: 'templates/client/view_delivery.html',
                controller: 'ClientViewDeliveryController'
            })

            .state('deliveryman',{
                abstract: true,
                cache: false,
                url: '/deliveryman',
                templateUrl: 'templates/deliveryman/menu.html',
                controller: 'DeliverymanMenuController',
                data: {
                    permissions:{
                        only: ['deliveryman-role']
                    }
                }
            })
            .state('deliveryman.order', {
                cache: false,
                url: '/order',
                templateUrl: 'templates/deliveryman/order.html',
                controller: 'DeliverymanOrderController'
            })
            .state('deliveryman.view_order', {
                cache: false,
                url: '/view_order/:id',
                templateUrl: 'templates/deliveryman/view_order.html',
                controller: 'DeliverymanViewOrderController'
            });

        $urlRouterProvider.otherwise( function($injector) {
            var $state = $injector.get("$state");
            $state.go('auth.walkthrough');
        });

        $provide.decorator('OAuthToken', [ '$localStorage', '$delegate', function ($localStorage, $delegate) {

            Object.defineProperties($delegate, {
                setToken: {
                    value: function (data) {
                        return $localStorage.setObject('token', data);
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                },
                getToken: {
                    value: function () {
                        return $localStorage.getObject('token');
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                },
                removeToken: {
                    value: function () {
                        $localStorage.setObject('token', null);
                    },
                    enumerable: true,
                    configurable: true,
                    writable: true
                }
            });
            return $delegate;
        }] );

        $provide.decorator('oauthInterceptor', ['$delegate', function ($delegate) {
            delete $delegate['responseError'];
            return $delegate;
        }] );

        OAuthProvider.configure({
            baseUrl: appConfig.baseUrl,
            clientId: 'app01',
            clientSecret: 'secret', // optional
            grantPath: 'oauth/access_token'
        });

        OAuthTokenProvider.configure({
            name: 'token',
            options: {
                secure: false // em produção trocar para true
            }
        });

    });
