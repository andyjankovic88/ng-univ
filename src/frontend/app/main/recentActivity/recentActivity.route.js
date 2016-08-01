(function() {
    'use strict';

    angular
        .module('recentActivity')
        .config(function($stateProvider) {
            $stateProvider
                .state('recentActivity', {
                    url: '/',
                    templateUrl: '/app/main/recentActivity/recentActivity.html',
                    controller: 'recentActivityCtrl',
                    parent: 'main',
                    data: {
                        permissions: {
                            except: ['anonymous'],
                            redirectTo: 'landing',

                        }
                    }
                });

        });



})();
