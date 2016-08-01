(function() {
   'use strict';

   angular.module('fieldsList', [])
      .directive('fieldsList', function($q, apiService, helper) {
         return {
            restrict: 'E',
            scope: {
               options: '=',
               selectOptions: '=',
               consultationData: '=',
               field: '@',
               field2: '@',
               placeholder: '@',
               placeholder2: '@',
               dropdownField: '@'
            },
            templateUrl: function(element, attrs) {
               if (attrs.type == "oneField") {
                  return '/app/components/fieldsList/one-field.html';
               };
               if (attrs.type == "twoField") {
                  return '/app/components/fieldsList/two-fields.html';
               };
               if (attrs.type == "twoFieldSelect") {
                  return '/app/components/fieldsList/two-fields-select.html';
               };
               if (attrs.type == "consultationTimes") {
                  return '/app/components/fieldsList/consultation-times.html';
               };
               if (attrs.type == "consultationTimes2") {
                  return '/app/components/fieldsList/consultation-times2.html';
               };
            },
            link: function($scope, elem, attrs) {

               if (attrs.type=="consultationTimes2") {
                  $scope.options.push({
                     campus: ''
                  });
               } else {
                  $scope.options.push({});
               }

               $scope.removeOption = function(index) {
                  if($scope.options.length < 2) return; // To Do: create warning - options count should be at least one
                  helper.removeElement($scope.options, index);
               };
               $scope.addOption = function() {
                  $scope.options.push({});
               };
               $scope.focus = function(element) {
                  element.focus();
               };
            }
         }
      })
})();
