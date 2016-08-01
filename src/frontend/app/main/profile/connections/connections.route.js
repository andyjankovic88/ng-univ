(function() {
   'use strict';

   angular
      .module('profile')
      .config(function($stateProvider) {
         $stateProvider
            .state('profile.connections', {
               url: '/connections',
               templateUrl: '/app/main/profile/connections/connections.html',
               controller: 'profileConnectionsrCtrl',
               parent: 'profile'
            });
      });

})();
