(function() {
   'use strict';

   angular
      .module('customgroups')
      .filter('removeSpaces', [function() {
         return function(string) {
            if (!angular.isString(string)) {
               return string;
            }
            return string.replace(/[^a-zA-Z0-9]/g, '').toLowerCase();
         };
      }])
      .controller('customGroupsListCtrl', function($scope, apiService) {

         var page = 0,
             filters = [];

         $scope.listRequestInProgress = false;

         $scope.groups = [];

         $scope.loadNextPage = function(reset) {
            $scope.listRequestInProgress = true;

            if(reset) {
               page = 0;
            }

            $scope.loaderActive = true;

            apiService.customGroups.getList(page, filters).then(
               function (response) {
                  $scope.loaderActive = false;
                  if (page === 0) {
                     $scope.filters = response.filters;
                     $scope.trending_group = response.trending_group;
                  }
                 if(angular.isArray(response.groups_list)) {
                    if (response.groups_list.length > 0) {
                       $scope.groups = reset ? response.groups_list : $scope.groups.concat(response.groups_list);
                       page++;
                       $scope.listRequestInProgress = false;
                    }
                    if (response.groups_list.length === 0 && page === 0) {
                       $scope.groups = [];
                    }
                 }
               }, function () {
                  $scope.loaderActive = false;
               }
            );
         };
         $scope.filterList = function(id) {
            if (!~filters.indexOf(id)) {
               filters.push(id);
            } else {
               filters.splice(filters.indexOf(id), 1);
            }
            $scope.loadNextPage(true);
            console.log(filters);
         }

      });

})();
