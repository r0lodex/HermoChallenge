(function() {
    'use strict';
    angular
        .module('hermo')
        .config(routesProvider);

    function routesProvider($stateProvider, $urlRouterProvider) {
        var views = {
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

        var state = {
            home: {
                url: '/',
                views: views
            }
        }

        $stateProvider.state('home', state.home)
        $urlRouterProvider.otherwise('/')
    }

})()