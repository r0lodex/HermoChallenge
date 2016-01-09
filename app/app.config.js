(function() {
    'use strict';
    angular
        .module('hermo')
        .config(routesProvider)
        .run(hermoInit);

    function hermoInit($rootScope, $state) {
        $rootScope.$state = $state
    }

    function routesProvider($stateProvider, $urlRouterProvider) {
        var state = {
            home: {
                url: '/',
                views: {
                    banner: {
                        templateUrl: '/app/banner/banner.html',
                        controller: 'bannerController',
                        controllerAs: 'banner'
                    },
                    products : {
                        templateUrl: '/app/products/products.html',
                        controller: 'productController',
                        controllerAs: 'product'
                    }
                }
            },
            cart: {
                url: '/cart',
                templateUrl: '/app/cart/cart.html',
                controller: 'cartController',
                controllerAs: 'cart'
            }
        }

        $stateProvider.state('home', state.home)
        $stateProvider.state('cart', state.cart)
        $urlRouterProvider.otherwise('/')
    }

})()