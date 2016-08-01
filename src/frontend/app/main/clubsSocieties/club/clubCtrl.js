(function () {
   'use strict';

   angular
      .module('club', [])
      .controller('clubCtrl', function ($scope, apiService, $stateParams, redirect, apiServerUrl, userService, userGroups, alerts, $state) {
         $scope.id = $stateParams.id;
         $scope.group_type = 'club';

         if($stateParams.paypalResult === 'cancel') {
            alerts.info('Payment was cancel');
         }
         if($stateParams.paypalResult === 'success') {
            alerts.info('Payment was success');
         }


         $scope.club = {};
         apiService.clubs.getInfo($scope.id).then(function (response) {
               if (response) {
                  $scope.club = response;
               }
            },
            function () {

            });


         $scope.follow = function () {
            var
               membershipFee = 0;


            if ($scope.club.info && $scope.club.info.membership) { // AI which can fetch useful info from indian response ( - still not sure that all works properly )
               membershipFee = $scope.club.info.membership.fee_non_student || $scope.club.info.membership.fee_student;
               if((userService.getInfo().group_id == userGroups.student) && ( $scope.club.info.membership.fee_student)) {
                  membershipFee = $scope.club.info.membership.fee_student;
               }
            }
            if(membershipFee > 0) {
               redirect.post(apiServerUrl + '/club/join/' + $scope.id, {
                  "is_student_id": false,
                  "is_student_association": false,
                  "is_student_mobile": false,
                  "is_student_email": false,
                  "is_paypal_payment": true,
                  "is_join":true
               });
            } else {
               apiService.clubs.join($scope.id).then(
                  function(response) {
                     $scope.isFollowed = true;
                  },
                  function(response) {

                  }
               );
            }

         };


      })
})();
