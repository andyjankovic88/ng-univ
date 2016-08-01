(function () {
   'use strict';

   angular
      .module('profile', [])
      .controller('profileCtrl', function ($scope, $state, $stateParams, apiService, userService, profileStateService, helper) {
         profileStateService.reset();
         $scope.listRequestInProgress = true ;
         $scope.main_tab = false;
         $scope.currentUserId = userService.getInfo().id;
         $scope.userId = $stateParams.id.length < 1 ? $scope.currentUserId : $stateParams.id;
         $scope.isConnecting = false;
         $scope.isProgressing = true;


         $scope.requestConnection = function (userId) {
            console.log('userId = ', userId);
            if (!userId) return;
            if ($scope.isConnecting) return;
            $scope.isConnecting = true;
            apiService.profile.requestConnection(userId).then(function (data) {
               console.log('requestConnection : response : ', arguments);
               $scope.isConnecting = false;
               if (data && data.action_success_status == true) {
                  $scope.profileInfo.sent_connection_request = true;
               }
            }, function (response) {
               $scope.isConnecting = false;
               console.log('requestConnection : error response : ', arguments);
            });
         };
         apiService.profile.info($scope.userId).then(
            function (response) {
               $scope.listRequestInProgress = false;
               $scope.main_tab = true;
               $scope.profileInfo = response;
               if($scope.currentUserId == $scope.userId) {
                  userService.setGroup($scope.profileInfo.group);
               }
               if ($scope.profileInfo.group == 'student'){
                  $state.go('profile.about');
               }  else {
                  $state.go('profileSubjects');
               }
               $scope.isProgressing = false;
            },
            function () {

            }
         );
         $scope.endorse = function (subj) {
            if(!subj) return;
            apiService.profile.doEndorse(subj.id, $scope.profileInfo.user_id).then(
               function (response) {
                  if(response.action_success_status) {
                     subj.endorsements.push({name: userService.getInfo().userName, user_id: userService.getInfo().id, photo_url: userService.getInfo().profilePic});
                  }
               }
            );


         };
      })
      .factory('profileStateService', function () {
         var profileStateService = {
            userId: -1,
            subjects: {
               showPastSubjects: false,
               pastSubjects: []
            },
            reset: function () {
               this.subjects.showPastSubjects = false;
               this.subjects.pastSubjects = [];
            }

         };

         return profileStateService;
      });

})();
