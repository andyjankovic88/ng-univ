(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .directive('mentorGroupsItem', function() {
         return {
            restrict: 'E',
            scope: {
               data: '=',
               join: '&'
            },
            templateUrl: '/app/main/mentorGroups/mentorGroupsList/mentorGroupsItem/mentorGroupsItem.html',
            link: function($scope) {             

            }
         };
      });
})();
