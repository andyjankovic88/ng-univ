(function () {
   'use strict';

   angular
      .module('customgroups')
      .controller('customGroupRightSideCtrl', function ($scope, $stateParams, apiService) {
         apiService.getSpecificRHS('customgroups', $stateParams.id).then(
            function (response) {
               $scope.admins = userDecorator(response.admin);
               $scope.members = userDecorator(response.member);
               $scope.events = response.upcoming_events;
            }
         );

         function userDecorator(array) {
            return array.map(function (user) {
               return {
                  user_id: user.id,
                  image_url: user.profilePic,
                  name: user.userName,
                  summary_options: user.summary_options
               };
            })
         }
      });

})();
