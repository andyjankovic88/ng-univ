(function() {
   'use strict';

   angular
      .module('club')
      .config(routeConfig);

   /** @ngInject */
   function routeConfig($stateProvider ) {
      $stateProvider
         .state('ticketSuccess', {
            url: '/:eventId/:ticketID/success/:token',
            templateUrl: '/app/main/clubsSocieties/club/events/ticket/ticket.html',
            controller: function($scope, $stateParams, apiServerUrl) {
               $scope.downloadLink = apiServerUrl + '/club/download_ticket/' + $stateParams.token;
               console.log($scope.downloadLink);
            },
            parent: 'club',
            params: {
               eventId: '',
               ticketID: '',
               token: ''
            }

         });

   }

})();
