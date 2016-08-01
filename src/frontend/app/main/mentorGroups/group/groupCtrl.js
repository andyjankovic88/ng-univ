(function () {
   'use strict';

   angular
      .module('mentorGroups')
      .controller('mentorGroupCtrl', function ($scope, $stateParams, apiService, alerts, helper, $state) {
         var id = $stateParams.id;
         $scope.group_id = id;
         $scope.group_type = 'mentors';

         $scope.group = {};
         $scope.creator = {};

         apiService.mentorGroups.getInfo(id).then(
            function(response) {
               $scope.group = response[0];
               $scope.creator = creator($scope.group);
            },
            function(response) {
               alerts.warning(response.data.message);

            }
         );


         $scope.leave = function() {
            apiService.mentorGroups.leaveAsMentee(id).then(
               function() {
                  $scope.group.is_joined = false;
                  $state.go('mentorGroups');
               },
               function(response) {
                  alerts.warning(response.data.message);
               }

            );
         };

         function creator(group) {
            return group.mentors[helper.findById(group.mentors, 'user_id', group.creator_user_id)];
         }

      });
})();
