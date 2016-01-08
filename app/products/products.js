(function() {
    angular
        .module('hermo')
        .factory('Product', ProductFactory)
        .controller('productController', productController)

    function ProductFactory($resource) {
        return $resource('http://www.hermo.my/test/api.html?list=best-selling', {}, {
            query: { method: 'GET', isArray: false }
        })
    }

    function productController($scope, Product) {
        var vm = this
        Product.query(function(res) {
            vm.items = res.items
            console.log(res.items[0])
        })
    }
})()