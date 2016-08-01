/*
 * ToDo should be removed - now created only as temporary solution because we don't have approved behaviour for concepts for main sections in markup
 *  - mainly because we don't know what we should do with footer
 *  commit hash: "122dc6b3502e66f0b19a0fced98d0b9833e4bba3"
 */
( function() {

   'use strict';

   angular.module('conversation')
      .directive('moveToBottom', function($document, $state) {
         return {
            restrict: 'A',
            link: function($scope, $el, attrs) {
               var $parent = $el.parent();

               $scope.$watch('oldMessages', timer);
               $scope.$watch('newMessages', timer);

               function timer() {
                  setTimeout(moveToBottom, 250);
               }

               function moveToBottom() {


                  var bottomVal = $el.height() - $parent.height() + 20;



                  if(bottomVal < 0) {
                     $el.css({bottom: bottomVal});
                  } else {
                     $el.css({bottom: 0});
                  }
               }

            }

         };
      });
}) ();


