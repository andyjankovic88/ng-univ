(function() {
    'use strict';

    angular
        .module('staffFeeds')
        .config(function($stateProvider) {
            $stateProvider
                .state('staffFeeds', {
                    url: '/staffFeeds',
                    templateUrl: '/app/main/staffFeeds/feeds.html',
                    controller: 'staffFeedsCtrl',
                    parent: 'main',
                    data: {
                        permissions: {
                            only: ['staff'],
                            redirectTo: 'universityFeeds'
                        }
                    },
                    params: {
                        type: '',
                        id: ''
                    }
                });
        });


})();
