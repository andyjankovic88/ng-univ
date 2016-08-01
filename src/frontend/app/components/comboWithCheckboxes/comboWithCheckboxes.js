(function() {
   "use strict";

   angular.module('comboWithCheckboxes', [])
   .directive('comboWithCheckboxes', function(helper){
      return {
         require: 'ngModel',
         scope: {
            options: '=',
            labelKey: '@',
            idAttrPrefix: '@',
            idKey: '@',
            ngModel: '=',
            defaultText: '@'
         },
         restrict: 'E',
         templateUrl: '/app/components/comboWithCheckboxes/comboWithCheckboxes.html',
         link: function($scope, elem, attrs, ngModel) {
            $scope.selectedText = $scope.defaultText;

            $scope.onHide = function() {
               var newSelected = helper.getList($scope.options, $scope.idKey, 'selected');

               if (!$scope.ngModel) {
                  $scope.ngModel = [];
               }

               if($scope.ngModel.length === 0 && newSelected.length === 0)  { // skip initialization cycles
                  return;
               }
               $scope.ngModel = newSelected;
               summary();
               ngModel.$setDirty();
               if (!$scope.ngModel || !$scope.ngModel instanceof Array || $scope.ngModel.length === 0) {
                  ngModel.$setValidity('isselected', false);
               } else {
                  ngModel.$setValidity('isselected', true);
               }
            };

            $scope.$watch('options', function(newVal, oldVal) {
               if (newVal != oldVal) {
                  $scope.onHide();
               }
            });

            function summary() {
               if($scope.ngModel.length === 1) {
                  $scope.selectedText = findFirstSelected()[$scope.labelKey];
               } else {
                  if(!$scope.ngModel.length) {
                     $scope.selectedText = $scope.defaultText;
                  } else {
                     $scope.selectedText = $scope.ngModel.length + ' of ' + $scope.options.length + ' selected';
                  }
               }
            }
            function findFirstSelected() {
               var
                  ind = 0,
                  list = $scope.options;

               while(ind < list.length && !list[ind].selected) {
                  ind++;
               }

               return list[ind];
            }
            if (!$scope.ngModel || !$scope.ngModel instanceof Array || $scope.ngModel.length == 0) {
               ngModel.$setValidity('isselected', false);
            }
         }
      };
   });




})();
