/**
 * Created by Andri on 04/12/2015.
 */
(function () {
   'use strict';

   angular
      .module('studentServicesView', [])
      .controller('studentServicesViewCtrl', function ($scope, $q, apiService, $stateParams) {

         $scope.group_type = 'servicepage';
         $scope.serviceID = $stateParams['service_id'];
         $scope.service = {};
         $scope.loadStatus = '';
         $scope.followers = [];
         $scope.stuffMembers = [];

         function init () {
            $scope.loadStatus = 'loading';
            apiService.studentServices.get($scope.serviceID).then(
               function(response){
                  console.log(response);
                  $scope.service = response;
                  $scope.loadStatus = 'success';
               },
               function(){
                  console.log(' ERROR ON PAGE LOAD ');
                  $scope.loadStatus = 'failed';
               }
            );
            loadFollowers();
         }

         function loadFollowers () {
            var deferred = $q.defer();
            apiService.studentServices.getFollowers($scope.serviceID).then(
               function(response) {
                  $scope.followers = response.student;
                  $scope.stuffMembers = response.staff;
                  return deferred.resolve();
               },
               function() {
                  return deferred.reject();
               }
            );
            return deferred.promise;
         }

         $scope.pageStatus = function (status) {
            return $scope.loadStatus == status;
         };

         $scope.follow = function(){
            apiService.studentServices.follow($scope.serviceID).then(
               function(){
                  $scope.service.is_joined = true;
               }
            );
         };
         $scope.unfollow = function(){
            apiService.studentServices.unfollow($scope.serviceID).then(
               function(){
                  $scope.service.is_joined = false;
               }
            );
         };

         init();
      })
})();
