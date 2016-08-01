(function() {
    'use strict';

    angular
        .module('marketplace')
        .config(function($stateProvider) {
            $stateProvider
                .state('marketplaceList', {
                    url: '/list/:userId',
                    templateUrl: '/app/main/marketplace/list/list.html',
                    controller: 'marketplaceListCtrl',
                    parent: 'marketplace',
                    params: {
                        userId: ''
                    },
                    data: {
                        permissions: {
                            only: ['sameUser'],
                            redirectTo: 'recentActivity'
                        }
                    }

                });
        });

})();
