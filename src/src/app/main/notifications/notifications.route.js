(function() {
    'use strict';

    angular
        .module('notifications')
        .config(function($stateProvider) {
            $stateProvider
                .state('notifications', {
                    url: '/notifications',
                    templateUrl: '/app/main/notifications/notifications.html',
                    controller: 'notificationsCtrl',
                    parent: 'main',

                });

        });



})();
