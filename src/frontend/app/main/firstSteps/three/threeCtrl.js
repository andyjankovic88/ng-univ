(function() {

   'use strict';

   angular
      .module('firstSteps')
      .controller('firstStepsThreeCtrl', function($scope, apiService, helper, firstStepsService, $q) {
         var
            searchInProgress = false,
            deferredSearch = false;

         $scope.search = {};
         $scope.searchResults = [];
         $scope.selectedGroups = [];


         $scope.searchGroups = function() {
            if (searchInProgress) {
               deferredSearch = true;
               return;
            }

            if (!$scope.search.keywords.length) {
               return;
            }
            searchInProgress = true;
            apiService.firstSteps.searchGroups($scope.search.keywords).then(
               function(response) {
                  searchInProgress = false;
                  if (deferredSearch) {
                     deferredSearch = false;
                     $scope.searchGroups();
                  }
                  $scope.searchResults = response.groups;
               },
               function() {

               }
            );
         };

         $scope.select = function(group) {
            $scope.selectedGroups.push(group);
            $scope.searchResults = [];
            $scope.search = {};
         };

         function join() {
            var
               selectedGroupsCount = $scope.selectedGroups.length,
               deferred = $q.defer();

            if (selectedGroupsCount) {
               angular.forEach($scope.selectedGroups, function(group) {
                  apiService.firstSteps.joinGroup(group.id).then(
                     function() {
                        selectedGroupsCount--;
                        if (selectedGroupsCount === 0) {
                           deferred.resolve();
                        }
                     },
                     function() {
                        deferred.resolve();
                     }
                  );
               });
            } else {
            	deferred.resolve();
            	
            }            


            return deferred.promise;
         }

         firstStepsService.registerGoCallback(join);
      });


})();
