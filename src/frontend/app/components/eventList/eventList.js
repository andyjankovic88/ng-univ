(function () {
   'use strict';

   angular
      .module('eventList', [])
      .directive('eventList', function (apiService, alerts) {
         return {
            restrict: 'E',
            scope: {
               clubId: '@',
               type: '@',
               canEdit: '=?'
            },
            templateUrl: '/app/components/eventList/eventList.html',
            link: function ($scope) {
               $scope.events = [];

               if($scope.clubId){
               apiService.events.getEvents($scope.type, $scope.clubId).then(
                  function (response) {
                     if (response && response.upcoming_events) {
                        $scope.events = response.upcoming_events;
                        $scope.canEdit = response.can_create_delete;
                     }
                  },
                  function (error) {
                     alerts.warning(error.data.message);
                  });} else {
               apiService.events.getAllEvents().then(
                  function (response) {
                     console.log("eventlist", response);
                     if (response && response.upcoming_events) {
                        $scope.events = response.upcoming_events;
                        $scope.canEdit = response.can_create_delete;
                     }
                  }
               )
               }
               $scope.joinEvent = function (event, eventID) {
                  if($scope.type === 'club'){

                  };
                  apiService.events.joinEvent($scope.type, $scope.clubId, eventID).then(
                     function () {
                        event.is_joined = true;
                     },
                     function (error) {
                        alerts.warning(error.data.message);
                     }
                  );
               };
               $scope.leaveEvent = function (event, eventID) {
                  apiService.events.leaveEvent($scope.type, $scope.clubId, eventID).then(
                     function () {
                        event.is_joined = false;
                     },
                     function (error) {
                        alerts.warning(error.data.message);
                     }
                  );
               };
            }
         };
      });


})();
