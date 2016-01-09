(function() {
    'use strict';
    angular
        .module('hermo')
        .factory('Cart', cartFactory)
        .controller('cartController', cartController);

    function cartFactory($resource) {
        return $resource('/api/cart', {}, {
            addToCart: { method: 'POST', isArray: true }
        })
    }

    function cartController($scope, Cart) {
        var vm = this
        vm.total = 0
        getCart()

        function getCart() {
            Cart.query(function(res) {
                console.log(res)
                if (res.length) {
                    vm.items = res
                    var a = 0
                    res.forEach(function(v) {
                        a += v.linetotal
                    })
                    vm.total = a
                }
            })
        }

        $scope.$on('cart:add', function(e,data) {
            Cart.addToCart(data, getCart)
        })
    }

})()