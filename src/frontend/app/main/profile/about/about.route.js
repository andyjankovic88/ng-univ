(function() {
   'use strict';

   angular
      .module('about')
      .config(function($stateProvider) {
         $stateProvider
            .state('profile.about', {
               url: '/about',
               templateUrl: '/app/main/profile/about/about.html',
               controller: 'aboutCtrl',
               parent: 'profile'/*,
               data: {
                  permissions: {
                     only: ['student'],
                     redirectTo: 'profile.connections'
                  }
               }*/
            });
      });

})();
