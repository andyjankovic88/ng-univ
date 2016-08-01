(function() {
   'use strict';

   angular.module('tickets', [])
      .directive('createTicket', function(apiClubs) {
         return {
            restrict: 'E',
            scope: {
               tickets: '=',
               eventId: '@',
               ticketEdit: '=?'
            },
            templateUrl: '/app/components/tickets/createTicket/createTicket.html',
            link: function ($scope, $elem, $attr) {
               $scope.ticket = {
                  event_id: $scope.eventId
               };
               if ($scope.ticketEdit) {
                  $scope.ticket = $scope.ticketEdit;
               }

               $scope.hourMin = 0;
               $scope.hourMax = 11;
               $scope.stop_hourMax = 12;

               $scope.currencyDecorate = function() {
                  var decimalSplit = $scope.ticket.price.split(".");
                  var intPart = decimalSplit[0];
                  var decPart = decimalSplit[1];
                  if (decPart === undefined || decPart === '') {
                     decPart = ".00";
                  } else if (decPart < 10) {
                     decPart = "." + decPart + "0";
                  } else {
                     decPart = "." + decPart;
                  }
                  $scope.ticket.price = intPart + decPart;
               };

               $scope.create = function () {
                  // if ($scope.ticket.advanced_show) {
                  //    $scope.ticket.advanced_show = 1;
                  // } else {
                  //    $scope.ticket.advanced_show = 0;
                  // }
                  apiClubs.createTicket($scope.ticket, $scope.ticketEdit ? $scope.ticketEdit.id : '').then(
                     function (response) {
                        console.log(response);
                        if (!$scope.ticketEdit) {
                           $scope.ticket.id = response.event_ticket_id;
                           $scope.tickets.push($scope.ticket);
                           $scope.$emit('ticketCreated');
                        }
                     },
                     function (err) {
                        $scope.errorMessage = err.data.message;
                     }
                  );
               }
            }
         }
      });
})();
