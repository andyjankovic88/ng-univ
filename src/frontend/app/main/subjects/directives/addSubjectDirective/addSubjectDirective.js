(function() {
   "use strict";
   angular.module('subjects')
      .directive('addSubject', function(apiService) {
         return {
            restrict: 'E',
            scope: {
            	selectedSubject: '=',
               label: '@'
            },
            templateUrl: '/app/main/subjects/directives/addSubjectDirective/addSubjectDirective.html',
            link: function($scope) {
               $scope.searchResults = [];
               $scope.search = {};
               var searchPromise;
               $scope.searchSubject = function() {
                  if (!$scope.search.keywords.length) {
                     $scope.searchResults = [];
                     return;
                  }
                  apiService.subjects.cancel(searchPromise);
                  searchPromise = apiService.subjects.search($scope.search.keywords);
                  searchPromise.then(
                     function(response) {
                        $scope.searchResults = response;
                     }
                  );
               };               
               $scope.addID = function(subject) {
                  $scope.selectedSubject.push(subject);
                  $scope.search.keywords = '';
                  $scope.searchResults = [];
               };
               
            }
         };
      });

})();
