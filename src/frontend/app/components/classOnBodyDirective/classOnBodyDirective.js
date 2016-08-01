( function() {

   'use strict';

   angular.module('classOnBodyDirective', [])
      .directive('classOnBodyDirective', function($document) {
         return {
            restrict: 'A',
            scope: {
               classOnBodyDirective: '@'
            },
            link: function(scope, element, attrs) {
               if(scope.classOnBodyDirective) {
                  $document.find('body').addClass(scope.classOnBodyDirective);
               }
               scope.$on('$destroy', function() {
                  $document.find('body').removeClass(scope.classOnBodyDirective);
               });
            }

         };
      });
}) ();


