(function() {
   'use strict';

   angular
      .module('globalSearch', [])
      .controller('globalSearchCtrl', function($scope, apiService, $stateParams, $state, header) {
         var
            terms = $stateParams.terms,
            page = 0,
            perPage = 30;

         $scope.list = [];
         $scope.$state = $state;
         $scope.loaderActive = true;
         $scope.listRequestInProgress = false;

         $scope.loadNextPage = function() {
            if (terms.length) {
               page++;
               $scope.listRequestInProgress = true;
               apiService.globalSearch.list(terms, page, perPage).then(
                  function(response) {
                     if(response.length >= perPage) {
                        $scope.listRequestInProgress = false;
                     }                     
                     header.activateWidget('search', true, { terms: terms });
                     $scope.loaderActive = false;                     
                     $scope.list = $scope.list.concat(response);
                     angular.forEach($scope.list, function(item) {
                        addUrlData(item);
                     });
                  },
                  function() {

                  }
               );
            }
         };

         function addUrlData(item) {
            var
               stateData = {
                  name: '',
                  params: {
                     id: item.id
                  }
               };

            switch (item.category) {
               case 'Customgroup':
                  stateData.name = 'customGroupsFeed';
                  break;
               case 'Subject':
                  stateData.name = 'subjectFeed';
                  break;
               case 'User':
                  stateData.name = 'profile';
                  break;
               case 'Club':
                  stateData.name = 'clubFeed';
                  break;
               case 'Studygroup':
                  stateData.name = 'studyGroupsFeed';
                  break;

            }

            item.stateData = stateData;
         }


      });

})();
