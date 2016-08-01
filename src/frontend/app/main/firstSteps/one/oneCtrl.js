(function() {

   'use strict';

   angular
      .module('firstSteps')
      .controller('firstStepsOneCtrl', function($scope, apiService, userService) {
         apiService.profile.info(userService.getInfo().id).then(
            function(response) {
               $scope.info = response;
            },
            function() {

            }

         );

         $scope.uploadUserPic = function(file) {
            if (file) {
               apiService.profile.uploadUserPic(file).then(
                  function(response) {
                     $scope.info.photo_url = response[0].url;
                  }
               );
            }
         };

        

      });


})();
