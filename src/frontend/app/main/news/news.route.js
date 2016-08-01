(function() {
    'use strict';

    angular
        .module('news')
        .config(function($stateProvider) {
            $stateProvider
                .state('news', {
                    abstract: true,
                    url: '/',
                    templateUrl: '/app/main/news/news.html',
                    controller: 'newsCtrl',
                    parent: 'main'
                });
        });


})();
