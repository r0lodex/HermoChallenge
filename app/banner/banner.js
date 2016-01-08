(function() {
    angular
        .module('hermo')
        .factory('Banner', BannerFactory)
        .controller('bannerController', bannerController)

    function BannerFactory($resource) {
        return $resource('http://www.hermo.my/test/api.html?list=banner', {}, {
            query: { method: 'GET', isArray: false }
        })
    }

    function bannerController($scope, Banner) {
        var vm = this
        vm.banner = Banner.query(activeRoulette)

        function activeRoulette(res) {
            vm.active = res.items[0].image
        }
    }
})()