(function() {
   'use strict';

   angular
      .module('mentorGroups')
      .directive('multiselectList', function(helper) {
         return {
            restrict: 'E',
            scope: {
               list: '=',
               selected: '=',
               isChanged: '='
            },
            templateUrl: '/app/main/mentorGroups/mentorGroupsList/multiselectList/multiselectList.html',
            link: function($scope) {
               $scope.isNotApplicable = true;

               $scope.select = function(index) {
                  var
                     selectedObj,
                     indexOfId;


                  if (index === -2) {
                     $scope.isNotApplicable = true;
                     unselectAll();
                  } else {
                     selectedObj = $scope.list[index];
                     indexOfId = $scope.selected.indexOf(selectedObj.id);

                     if (indexOfId >= 0) {
                        helper.removeElement($scope.selected, indexOfId);
                        selectedObj.selected = false;
                     } else {
                        $scope.selected.push(selectedObj.id);
                        selectedObj.selected = true;
                        $scope.isNotApplicable = false;
                     }

                  }

                  $scope.isChanged = true;

               };

               function unselectAll() {
                  $scope.selected = [];
                  angular.forEach($scope.list, function(item) {
                     if (item.selected) {
                        item.selected = false;
                     }
                  });
               }
            }
         };
      });
})();
