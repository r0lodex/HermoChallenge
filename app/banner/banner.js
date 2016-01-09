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

    function bannerController($scope, Banner, $timeout) {
        var vm = this
        vm.banner = Banner.query(activeRoulette)
        vm.ind = 0

        function activeRoulette(res) {
            var total = res.items.length

            vm.interval = function() {
                $timeout(function() {
                    if (vm.ind < 3) {
                        vm.active = res.items[vm.ind].image
                        vm.ind++
                    } else {
                        vm.ind = 0
                    }
                    vm.interval()
                }, 3000)
            }

            vm.active = res.items[vm.ind].image

            vm.interval()
        }
    }
})()