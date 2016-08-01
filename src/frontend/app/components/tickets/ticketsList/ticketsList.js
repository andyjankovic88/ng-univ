(function() {
   'use strict';

   angular.module('tickets')
      .directive('ticketsList', function(apiClubs) {
         return {
            restrict: 'E',
            scope: {
               tickets: '=',
               eventId: '@',
               isAdmin: '='
            },
            templateUrl: '/app/components/tickets/ticketsList/ticketsList.html',
            controller: function ($scope, apiServerUrl, redirect) {
               $scope.buyTicket = function (ticket) {
                  ticket.buying = true;
                  var data = {
                     'event-id': $scope.eventId,
                     'event-ticket-id': ticket.id,
                     'ticket-quantity': ticket.quantityBuy
                  }
                  if (ticket.price_choice === 'free') {
                     apiClubs.buyFreeTicket(data);
                  } else {
                     redirect.post(apiServerUrl + '/club/event_ticket_buy/' + $scope.id, data);
                  }
               }
            }
         }
      });
})();
