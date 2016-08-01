(function() {
   'use strict';

   angular
      .module('club')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('club.cancel', {
            url: '/cancel',
            controller: function($state) {
               $state.go('events', {paypalResult: 'cancel'});
            },
            parent: 'club'

         });

   }

})();
