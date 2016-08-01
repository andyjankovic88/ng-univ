(function() {
    'use strict';

    angular
        .module('universityFeeds')
        .config(function($stateProvider) {
            $stateProvider
                .state('universityFeeds', {
                    url: '/universityFeeds',
                    templateUrl: '/app/main/universityFeeds/feeds.html',
                    controller: 'feedsCtrl',
                    parent: 'main',
                    data: {
                        permissions: {
                            except: ['anonymous'],
                            redirectTo: 'login'
                        }
                    },
                    params: {
                        type: '',
                        id: ''
                    }
                });
        });


})();
