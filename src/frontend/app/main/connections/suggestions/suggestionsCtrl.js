(function() {
   'use strict';

   angular
      .module('connectionsSuggestions', [])
      .controller('connectionsSuggestionsCtrl', function($scope, apiService, userService, suggestionFilters, dataShareService) {
         $scope.listSuggestions = [];

         $scope.suggestionFilterOptions = [];
         $scope.connectionsData = dataShareService.connections;

         $scope.selectedFilters = [];
         $scope.suggestionFilter = {};
         $scope.searchTerm = $scope.connectionsData.searchString;

         $scope.noSuggestions = false;
         $scope.noMoreData = false;
         $scope.listRequestInProgress = false;

         var page = 0;
         $scope.scrollContainer = $('.middle-section').eq(0);

         function fetchFilterCategories () {
            apiService.connections.filter_categories().then(function (response) {
               if ( response.filter_category ) {

                  // $scope.suggestionFilterOptions = response.filter_categroy.shift();
                  // response.filter_categroy.shift();
                  $scope.suggestionFilterOptions = [];
                  angular.forEach(response.filter_category, function (item, idx) {
                     if (idx === '') {
                        return;
                     }
                     $scope.suggestionFilterOptions.push({
                        text: item,
                        id: parseInt(idx)
                     });
                  });
               } else {
               }
            });
         }

         $scope.fetchSuggestions = function (reset) {
            var term = $scope.searchTerm, filter = $scope.selectedFilters;
            $scope.listRequestInProgress = true;
            if ((!term || term === '' ) && (!filter || filter.length == 0)) {
               if (reset) {page = 0; $scope.noMoreData = false;}
               apiService.connections.getSuggestions(page).then(function (response) {
                  $scope.listRequestInProgress = false;
                  page++;
                  if (angular.isArray(response.suggested_connections) &&
                     response.suggested_connections.length > 0) {

                     $scope.listSuggestions = $scope.listSuggestions.concat(response.suggested_connections);
                  } else {
                     $scope.listSuggestions = [];
                     $scope.noMoreData = true;
                  }
               }, function (err) {
                  $scope.listRequestInProgress = false;
                  $scope.listSuggestions = [];
                  if (page == 0) { $scope.noSuggestions = true; }
                  $scope.noMoreData = true;
               });
            } else {
               var filterIDs = filter.map(function (obj) {
                  return obj.id;
               });
               apiService.connections.getSuggestionsFilter({
                  is_searched: (!term || term === '' ) ? 0 : 1,
                  search_term: term ? term : '',
                  is_filtered: (filterIDs.length === 0) ? 0 : 1,
                  filter_term: filterIDs
               }).then(function (response) {
                  $scope.noMoreData = true;
                  $scope.listRequestInProgress = false;
                  if (angular.isArray(response.suggested_connections) &&
                     response.suggested_connections.length > 0) {

                     $scope.listSuggestions = response.suggested_connections;
                  } else {
                     $scope.listSuggestions = [];
                     $scope.noSuggestions = true;
                  }
               }, function (err) {
                  $scope.noMoreData = true;
                  $scope.listRequestInProgress = false;
                  $scope.listSuggestions = [];
                  $scope.noSuggestions = true;
               });
            }
         };

         function init () {
            fetchFilterCategories();
         }

         $scope.suggestionFilterChanged = function (selectedFilter) {
            $scope.listSuggestions = [];
            var isExist = $scope.selectedFilters.find(function (obj, idx) {
               return obj.id === selectedFilter.id;
            });
            if (isExist) {
               return;
            }
            // $scope.selectedFilters.push(selectedFilter); //multiple filter
            $scope.selectedFilters = [selectedFilter];
            $scope.listSuggestions.splice(0);
            $scope.fetchSuggestions(true);
         };

         $scope.removeFilter = function ($index) {
            $scope.listSuggestions = [];
            $scope.selectedFilters.splice($index, 1);
            $scope.listSuggestions.splice(0);
            $scope.fetchSuggestions(true);
         };

         $scope.sendConnectRequest = function ($index, following) {
            apiService.connections.connect(userService.getInfo().id, following).then(function (response) {
               $scope.listSuggestions.splice($index, 1);
            }, function (err) {

            });
         };

         //$scope.$watch('connectionsData.searchString', function (newValue, oldValue) {
         //   // console.log(newValue);
         //});

         $scope.$on('doConnectionSearch', function (evt, searchString) {
            $scope.listSuggestions.splice(0);
            $scope.searchTerm = searchString;
            $scope.fetchSuggestions(true);
         });

         init();
      });
})();
