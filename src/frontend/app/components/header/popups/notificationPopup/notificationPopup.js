( function() {

    'use strict';

    angular.module('notificationPopup', ['notifications'])
        .directive('notificationPopup', function() {
            return {
                restrict: 'E',
                templateUrl: '/app/components/header/popups/notificationPopup/notificationPopup.html',
                controller: 'notificationsCtrl'

            };
        });


}) ();
