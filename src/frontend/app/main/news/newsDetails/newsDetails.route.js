(function() {
    'use strict';

    angular
        .module('newsDetails')
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider ) {
        $stateProvider
            .state('news.details', {
                url: 'view/:id',
                templateUrl: '/app/main/news/newsDetails/newsDetails.html',
                controller: 'newsDetailsCtrl',
                parent: 'news',
                params: {
                    id: ''
                }

            });

    }
})();
