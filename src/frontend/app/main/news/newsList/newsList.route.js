(function() {
    'use strict';

    angular
        .module('newsList')
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider ) {
        $stateProvider
            .state('news.list', {
                url: 'student_news',
                templateUrl: '/app/main/news/newsList/newsList.html',
                controller: 'newsListCtrl',
                parent: 'news'

            });
    }


})();
