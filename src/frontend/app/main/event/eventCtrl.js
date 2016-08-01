(function () {
   'use strict';
   angular
      .module('event', [])
      .controller('eventCtrl', function ($scope, apiService, userService, alerts, $state, $stateParams, $q, $window) {
         $scope.type = $stateParams.group_type;
         $scope.event_id = $stateParams.event_id;
         $scope.clubId = $stateParams.group_id;
         $scope.isCreate = false;

         apiService.events.getEvent( $scope.type, $scope.event_id).then(
            function(response){
               $scope.event = response[$scope.event_id];
               delete response[$scope.event_id];
               $scope.allEventData = response;
            }
         );

         $scope.joinEvent = function () {
            console.log($scope.type, $scope.clubId, $scope.event_id);
            apiService.events.joinEvent($scope.type, $scope.clubId, $scope.event_id).then(
               function () {
                  $scope.event.is_joined = true;
               },
               function (error) {
                  alerts.warning(error.data.message);
               }
            );
         };
         $scope.leaveEvent = function () {
            alerts.confirm('Are you sure you want to leave event?').then(function () {
               apiService.events.leaveEvent($scope.type, $scope.clubId, $scope.event_id).then(
                  function () {
                     $scope.event.is_joined = false;
                  }
               );
            })
         };

         $scope.deleteEvent = function(){
            alerts.confirm('Are you sure you want to remove event?').then(function () {
               apiService.events.deleteEvent($scope.type, $scope.clubId, $scope.event_id).then(
                  function () {
                     redirection($scope.type, $scope.clubId);
                  },
                  function(error){
                     if (error && error.data && error.data.message) {
                        alerts.warning(error.data.message);
                     }
                  }
               )
            })
         };

         $scope.isClub = function () {
            if ($scope.type === 'club') {
               return true
            } else return false;
         };

         $scope.goBack = function () {
            $window.history.back();
         }

         $scope.showCreate = function () {
            $scope.isCreate = true
         }
         $scope.$on('ticketCreated', function () {
            $scope.isCreate = false;
         })

         function redirection(type, typeId) {
            switch (type) {
               case 'club':
                  $state.go('events', {id: typeId});
                  break;
               case 'customgroups':
                  $state.go('customGroupEvents', {id: typeId});
                  break;
               case 'servicepage':
                  $state.go('customGroupEvents');
                  break;
               case 'university':
                  $state.go('universityEvents', {id: typeId});
                  break;
               case 'mentors':
                  $state.go('mentorGroupEvents', {id: typeId});
                  break;
               default:
                  $state.go('recentActivity');
            }
         }

      });

})();
