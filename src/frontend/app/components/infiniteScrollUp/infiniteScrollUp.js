(function () {
      "use strict";

      var SCROLL_THRESHOLD = 30;

      angular.module('infiniteScrollUp', [])
         .directive('infiniteScrollUp', function () {
            return {
               restrict: 'A',
               scope: {
                  infiniteScrollUp: '&', // function should return promise
                  scrollDownEvent: '@'
               },
               link: function ($scope, $elem) {
                  var
                     isBusy = true,
                     isFirstCallback = true;

                  var $targetEl = $elem.parent(); // ToDo: refactor this specialization when markup in conversation will be fixed


                  runCallback();

                  $targetEl.on('scroll', onScroll);
                  $scope.$on('destroy', function() {
                     $targetEl.off('scroll', onScroll);
                  });
                  if($scope.scrollDownEvent) {
                     $scope.$on($scope.scrollDownEvent, function() {
                        scrollDown();
                     });
                  }

                  function scrollDown() {
                     setTimeout(function () {
                        $targetEl.scrollTop($targetEl[0].scrollHeight);
                     }, 0);
                  }
                  function runCallback() {
                     var
                        heightBeforeCallback = $elem.height(),
                        heightAfterCallback;


                     isBusy = true;

                     $scope.infiniteScrollUp().then(function () {
                        if(isFirstCallback) {
                           scrollDown();
                           isFirstCallback = false;
                        } else {
                           heightAfterCallback = $elem.height();
                           console.log('callback', heightBeforeCallback, heightAfterCallback);
                           if(heightBeforeCallback < heightAfterCallback) {

                              $targetEl.scrollTop(heightAfterCallback - heightBeforeCallback);
                           }
                        }
                        isBusy = false;
                     },
                     function(response) {
                        isBusy = false;
                     });
                  }

                  function onScroll() {
                     if(($targetEl.scrollTop() < SCROLL_THRESHOLD) && !isBusy) {
                        runCallback();
                     }
                  }
               }
            }
         });
   })();
