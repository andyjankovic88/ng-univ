(function () {
   'use strict';

   angular
      .module('conversation')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider) {
      $stateProvider
         .state('conversation', {
            url: 'inbox/view_conversation/:id',
            templateUrl: '/app/main/messages/conversation/conversation.html',
            controller: 'conversationPersonCtrl',
            parent: 'messages',
            params: {
               id: '',
               isRead: false,
               title: ''
            }

         });

   }


})();
