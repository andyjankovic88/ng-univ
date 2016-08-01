(function() {
   'use strict';

   angular
      .module('studyGroupsList', [])
      .controller('studyGroupsListCtrl', function($scope, apiService, userService) {

         var page = 0;

         $scope.scrollContainer = $('.middle-section').eq(0);

         $scope.listRequestInProgress = false;
         $scope.noMoreData = false;

         $scope.trendingStudygroups = [];
         $scope.allStudygroups = [];

         function init () {
            $scope.listRequestInProgress = true;
            apiService.studyGroups.list(userService.getInfo().id, 0).then(
               function (response) {
                  $scope.listRequestInProgress = false;
                  $scope.trendingStudygroups = response.trending_studygroups;
                  $scope.allStudygroups = response.all_studygroups;
                  // $scope.loadNextPage();
               }, function (err) {
                  $scope.listRequestInProgress = false;
               }
            );
         }

         $scope.loadNextPage = function(reset) {
            if(reset) {
               page = 0;
            }
            //$scope.listRequestInProgress = true;
            //apiService.studyGroups.suggestions(userService.getInfo().id, page).then(
            //   function(response) {
            //      if(angular.isArray(response.suggested_studygroups) && response.suggested_studygroups.length > 0) {
            //         $scope.allStudygroups = reset ? response : $scope.allStudygroups.concat(response.suggested_studygroups);
            //         page++;
            //      } else {
            //         $scope.noMoreData = true;
            //      }
            //      $scope.listRequestInProgress = false;
            //   }, function (err) {
            //      $scope.noMoreData = true;
            //      $scope.listRequestInProgress = false;
            //   }
            //);
            $scope.listRequestInProgress = true;
            apiService.studyGroups.list(userService.getInfo().id, page).then(
               function (response) {
                  if (page === 0) {
                     $scope.trendingStudygroups = $scope.trendingStudygroups.concat(response.trending_studygroups);
                     $scope.allStudygroups = $scope.allStudygroups.concat(response.all_studygroups);
                     // $scope.allStudygroups = $scope.allStudygroups.concat(response.trending_studygroups);
                     page++;
                  } else {
                     if (!response || !response.all_studygroups || response.all_studygroups.length == 0) {
                        $scope.noMoreData = true;
                     } else {
                        console.log('studygroup list', response);
                        $scope.allStudygroups = $scope.allStudygroups.concat(response.all_studygroups);
                        page++;
                     }
                  }
                  $scope.listRequestInProgress = false;
                  // $scope.loadNextPage();
               }, function (err) {
                  $scope.noMoreData = true;
                  $scope.listRequestInProgress = false;
               }
            );
            //apiService.studyGroups.list(page, filters).then(
            //   function (response) {
            //      if (page === 0) {
            //         $scope.filters = response.filters;
            //         $scope.trendingGroups = response.trending_group;
            //      }
            //     if(angular.isArray(response.groups_list)) {
            //        if (response.groups_list.length > 0) {
            //           $scope.groups = reset ? response.groups_list : $scope.groups.concat(response.groups_list);
            //           page++;
            //           $scope.listRequestInProgress = false;
            //        }
            //        if (response.groups_list.length === 0 && page === 0) {
            //           $scope.groups = [];
            //        }
            //     }
            //   }
            //);
         };
         // $scope.loadNextPage();
         // init();
      });

})();
