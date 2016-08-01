(function () {
   'use strict';

   angular
      .module('messages')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider) {
      $stateProvider
         .state('messages', {
            abstract: true,
            url: '/',
            templateUrl: '/app/main/messages/messages.html',
            controller: 'messagesCtrl',
            parent: 'main'

         });

   }


})();
