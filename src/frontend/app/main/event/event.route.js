(function() {
   'use strict';

   angular
      .module('event')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('event', {
            url: '/:group_type/:group_id/event/:event_id',
            templateUrl: '/app/main/event/event.html',
            controller: 'eventCtrl',
            parent: 'main',
            params: {
               group_type: '',
               event_id: '',
               group_id:''
            }

         });

   }

})();
