(function() {
    'use strict';
    angular
        .module('hermo')
        .factory('Checkout', checkoutFactory)
        .controller('checkoutController', checkoutController);

    function checkoutFactory($resource) {
        return $resource('/api/checkout', {}, {
            checkout: { method: 'POST', isArray: false },
            query: { method: 'GET', isArray: false }
        })
    }

    function checkoutController($scope, Checkout) {
        var vm = this
        vm.total = 0
        vm.data = Checkout.query(function(res) {
            res.items.forEach(function(v) {
                vm.total = vm.total + v.linetotal
            })
        })
    }
})();