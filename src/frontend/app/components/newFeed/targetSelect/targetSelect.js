(function() {
   'use strict';

   angular.module('newFeed')
      .directive('targetSelect', function(apiService, userService) {
         return {
            restrict: 'E',
            scope: {
               onSave: '&'
            },
            templateUrl: '/app/components/newFeed/targetSelect/targetSelect.html',
            link: function($scope) {
               var $selected = {
                  faculties: [],
                  campuses: [],
                  post_year:0,
                  international: false
               };

               $scope.faculties = [];
               $scope.campuses = [];
               $scope.other = [{id: 1, name: 'Target to International Students'}];

               $scope.year = "";

               $scope.save = function() {
                  $selected.faculties = getSelected($scope.faculties);
                  $selected.campuses = getSelected($scope.campuses);
                  $selected.post_year = $scope.year;
                  $selected.international = $scope.other[0].isSelected;
                  $scope.onSave({$selected: $selected});
               };
               $scope.clear = function () {
                  clear($scope.faculties);
                  clear($scope.campuses);
                  clear($scope.other);
                  $scope.year = "";
               };

               apiService.getFaculties(userService.getUnivInfo().id).then(
                  function(response) {
                     $scope.faculties = response;  //{ id: '', name: ''}
                  }
               );
               apiService.getCampuses(userService.getUnivInfo().id).then(
                  function(response) {
                     $scope.campuses = response; //{ id: '', name: ''}
                  }
               );


               function getSelected(list) {
                  var selected = [];
                  angular.forEach(list, function(item) {
                     if(item.isSelected)
                        selected.push(item);
                  });
                  return selected;
               }
               function clear(list) {
                  angular.forEach(list, function(item) {
                     item.isSelected = false;
                  });
               }
            }
         }
      })
})();
