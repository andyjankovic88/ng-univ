(function () {
   'use strict';

   angular
      .module('connections', [])
      .constant('suggestionFilters',[
            {
               text: 'Friends on Facebook',
               id: '1'
            }, {
               text: 'Mutual Connections',
               id: '2'
            }, {
               text: 'Same Classes',
               id: '3'
            }, {
               text: 'Same Interest & Hobby',
               id: '4'
            }, {
               text: 'Same Home Town/Suburb',
               id: '5'
            }, {
               text: 'Same Current Town/Suburb',
               id: '6'
            }, {
               text: 'Same Skills',
               id: '7'
            }, {
               text: 'Same Education',
               id: '8'
            }, {
               text: 'Same Work',
               id: '9'
            }, {
               text: 'Same Subjects',
               id: '10'
            }, {
               text: 'Same Public Groups/Pages',
               id: '11'
            }, {
               text: 'Same Degree',
               id: '12'
            }, {
               text: 'Same Campus',
               id: '13'
            }, {
               text: 'Home Country',
               id: '14'
            }, {
               text: 'Same Year of Commencement',
               id: '15'
            }, {
               text: 'Same Year of Completion',
               id: '16'
            }
         ])
      .controller('connectionsCtrl', function ($scope, apiService, userService, $sce, dataShareService) {
         $scope.connectionsData = dataShareService.connections;

         $scope.doSearch = function () {
            $scope.$broadcast('doConnectionSearch', $scope.connectionsData.searchString);
            return false;
         };
      }).filter('uppercaseEx', function() {
         return function(input, replaceChar) {
            var result = input.replace(new RegExp(replaceChar, 'g'), ' ');
            return result.replace(/(?:^|\s)\S/g, function(a) { return a.toUpperCase(); });
         };
      });

})();
