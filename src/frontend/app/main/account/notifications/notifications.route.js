(function() {
   'use strict';

   angular
      .module('ucrAccountNotification')
      .config(function($stateProvider) {
         $stateProvider
            .state('ucrAccountNotification', {
               url: '/notifications',
               templateUrl: '/app/main/account/notifications/notifications.html',
               controller: 'notificationCtrl',
               parent: 'ucrAccount'
            });
      });


})();
