/*
* ToDo should be removed - now created only as temporary solution because we don't have approved behaviour for concepts for main sections in markup
*  - mainly because we don't know what we should do with footer
*  commit hash: "122dc6b3502e66f0b19a0fced98d0b9833e4bba3"
*/
( function() {

   'use strict';

   angular.module('conversation')
      .directive('classOnMiddleSection', function($document, $state) {
         return {
            restrict: 'A',

            link: function($scope) {
               $document.find('.middle-section').addClass('messages-section');
               $scope.$on('$destroy', function() {
                  $document.find('.middle-section').removeClass('messages-section');
               });
            }

         };
      });
}) ();




