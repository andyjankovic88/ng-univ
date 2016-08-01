(function() {

   'use strict';

   angular.module('header')
      .directive('headerSearch', function($state) {
         return {
            restrict: 'E',
            scope: {},
            templateUrl: '/app/components/header/search/search.html',
            link: function($scope, $element) {
               var $input = $element.find('input');

               $scope.terms = '';

               $scope.close = function() {
                  $scope.$emit('closeHeaderWidget');
               };

               $scope.search = function() {
                  if ($scope.terms.length) {
                     $state.go('globalSearch', {
                        terms: $scope.terms
                     });
                  }
               };

               $scope.$on('headerWidgetActivated', function(event, data) {
                  if (data.name === 'search') {                     
                     if(data.data.terms) {
                        $scope.terms = data.data.terms;
                     }
                     window.setTimeout(function() {$input.focus();}, 0);
                  }


               });

            }

         };
      });


})();
