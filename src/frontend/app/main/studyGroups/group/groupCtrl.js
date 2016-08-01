/**
 * Created by Andri on 04/12/2015.
 */
(function () {
   'use strict';

   angular
      .module('studyGroupsView', [])
      .controller('studyGroupViewCtrl', function ($scope, apiService, $stateParams, userService, helper) {
         $scope.id = $stateParams.id;
         $scope.group = {};
         $scope.loadStatus = '';
         $scope.userInfo = userService.getInfo();

         function init () {
            $scope.loadStatus = 'loading';
            apiService.studyGroups.get($scope.id).then(
               function(response){
                  $scope.group = response.data.study_group;
                  $scope.group.members = response.data.members;
                  $scope.group.can_edit = response.data.is_editable;
                  $scope.group.is_joined = helper.findById($scope.group.members, 'user_id', $scope.userInfo.id) > -1;
                  $scope.loadStatus = 'success';
               },
               function(){
                  //var response = {"study_group":{"id":"12","uni_id":"24","creator_user_id":"2620","name":"UCROO Study Group","privacy":"closed","picture":"http:\/\/localhost.ucroo\/assets\/images\/study_group\/study_group.png","purpose":"Exam Revision","time_from":"00:00:00","time_to":"00:00:00","time_day":"0","count_views":"0","date_created":"2013-02-05 20:07:52","date_modified":"2016-01-31 06:39:51"},"members":[{"user_id":"2620","profile_picture":"https:\/\/graph.facebook.com\/531445622\/picture?width=50&height=50","name":"Allison Mcymqqjw","details":"Bachelor of Commerce<br \/>\n(Degree with<br \/>\nHonours)<br>Parkville","connect":"true","message":"false"}],"is_editable":"false"};
                  //$scope.group = response.study_group;
                  //$scope.group.members = response.members;
                  //$scope.group.can_edit = response.is_editable;
                  console.log(' ERROR ON PAGE LOAD ');
                  $scope.loadStatus = 'failed';
               }
            );
         }

         $scope.pageStatus = function (status) {
            return $scope.loadStatus == status;
         };

         $scope.follow = function(){
            apiService.studyGroups.join($scope.id).then(
               function(){
                  $scope.group.is_joined = true;
               }
            );
         };
         $scope.unfollow = function(){
            apiService.studyGroups.leave($scope.id).then(
               function(){
                  $scope.group.is_joined = false;
               }
            );
         };

         init();
      })
})();
