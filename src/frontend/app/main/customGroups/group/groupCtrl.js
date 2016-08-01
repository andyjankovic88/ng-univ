/**
 * Created by Andri on 04/12/2015.
 */
(function () {
   'use strict';

   angular
      .module('customgroups')
      .controller('customGroupCtrl', function ($scope, apiService, $stateParams, $state) {
            $scope.group_type = 'customgroups';
            $scope.id = $stateParams.id;
            apiService.customGroups.getInfo($scope.id).then(
               function(response){
                  $scope.group = response;
               },
               function(){

               }
            );
            $scope.follow = function(){
               apiService.customGroups.join($scope.id).then(
                  function(){
                     $scope.group.is_joined = true;
                  }
               );
            }
            $scope.unfollow = function(){
               apiService.customGroups.leave($scope.id).then(
                  function(){
                     $scope.group.is_joined = false;
                  }
               );
            }

      })
})();
