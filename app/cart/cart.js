(function() {
    'use strict';
    angular
        .module('hermo')
        .factory('Cart', cartFactory)
        .controller('cartController', cartController);

    function cartFactory($resource) {
        return $resource('/api/cart/:itemid/:action', { itemid: '@itemid', action: '@action' }, {
            addToCart: { method: 'POST', isArray: true },
            removeItem: { method: 'DELETE', isArray: false },
            updateQty: { method: 'PUT', isArray: false }
        })
    }

    function cartController($scope, Cart) {
        var vm = this
        vm.total = 0
        getCart()

        $scope.$on('cart:add', function(e,data) {
            Cart.addToCart(data, getCart)
        })

        function getCart() {
            Cart.query(function(res) {
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

        vm.removeItem = function(data) {
            var a = confirm('Confirm removal of ' + data.name + '?')
            if (a) {
                Cart.removeItem({ itemid: data.id }, getCart)
            }
        }

        vm.qtymod = function(data, add) {
            Cart.updateQty({ itemid: data.id, action: (add) ? 'add':'minus' }, getCart)
        }
     }

})()