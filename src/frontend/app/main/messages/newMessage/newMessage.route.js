(function () {
   'use strict';

   angular
      .module('newMessage')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider) {
      $stateProvider
         .state('newMessage', {
            url: '/new-message',
            templateUrl: '/app/main/messages/newMessage/newMessage.html',
            controller: 'newMessageCtrl',
            parent: 'main',
            params: {
               recepient: ''
            }


         });

   }


})();
