(function() {
    'use strict';

    angular
        .module('login')
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider) {
        $stateProvider
            .state('login', {
                url: '/login?:redirectTo',
                templateUrl: '/app/external/login/login.html',
                controller: 'LoginCtrl',
                parent: 'external',
                data: {
                    permissions: {
                        only: ['anonymous'],
                        redirectTo: 'recentActivity'
                    }
                }
            });

    }

})();
