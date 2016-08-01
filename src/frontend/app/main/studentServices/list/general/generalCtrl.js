(function() {
   'use strict';

   angular
      .module('studentServicesListGeneral', [])
      .controller('studentServicesListGeneralCtrl', function($scope, apiService, userService) {

         var page = 0;

         $scope.scrollContainer = $('.middle-section').eq(0);

         $scope.listRequestInProgress = false;
         $scope.noMoreData = false;

         $scope.universityServices = [];
         $scope.campusServices = [];
         $scope.facultyServices = [];

         function init () {
            $scope.listRequestInProgress = true;
            apiService.studentServices.list().then(
               function (response) {
                  $scope.listRequestInProgress = false;
                  $scope.universityServices = response.university_wide_services;
                  $scope.campusServices = response.campus_services;
                  $scope.facultyServices = response.faculty_services;
               }, function (err) {
                  $scope.listRequestInProgress = false;
               }
            );
         }
         init();
      });

})();
