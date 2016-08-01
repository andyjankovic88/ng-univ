(function() {
   'use strict';

   angular
      .module('event')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('newEvent', {
            url: '/newEvent/:group_type/:group_id',
            templateUrl: '/app/main/event/newEvent/newEvent.html',
            controller: 'newEventCtrl',
            parent: 'main',
            params: {
               edit_id: '',
               group_type: '',
               group_id: ''
            }

         });

   }

})();
