(function() {
   'use strict';

   var
      ACTIVE_CLASS = 'dropdown-active',
      HIDE_EVENT_NAME = 'hideDropdown',
      TRIGGER_EVENT_NAME = 'triggerDropdown';



   angular.module('dropdown', [])
      .directive('dropdown', function(clickService) { // clickService - see in "clickOutside.js"
         return {
            restrict: 'A',
            scope: true,
            link: function($scope, element) {
               $scope.dropdownActive = function() {
                  element.addClass(ACTIVE_CLASS);
               };
               $scope.dropdownInactive = function() {
                  element.removeClass(ACTIVE_CLASS);
                  if ($scope.search) {
                     $scope.$apply(function () {
                        $scope.search.name = '';
                     });
                  }
               };

               function onClick(target) {
                  var isClickedElementChildOfPopup = isDescendant(element[0], target);

                  if (isClickedElementChildOfPopup) {
                     return;
                  }

                  $scope.$broadcast(HIDE_EVENT_NAME);
                  $scope.dropdownInactive();
               }

               function isDescendant(parent, child) {
                  var node = child.parentNode;
                  while (node !== null) {
                     if (node === parent) {
                        return true;
                     }
                     node = node.parentNode;
                  }
                  return false;
               }

               clickService.register(onClick);

               $scope.$on('$destroy', function() {
                  clickService.unregister(onClick);
               });

            }
         };
      })
      .directive('dropdownTrigger', function() {
         return {
            restrict: 'A',
            link: function($scope, element) {

               function onClick() {
                  $scope.$broadcast(TRIGGER_EVENT_NAME);
               }

               element.on('click', onClick);

               $scope.$on('$destroy', function() {
                  element.off('click', onClick);
               });
            }
         };
      })
      .directive('dropdownInnerTrigger', function() {
         return {
            restrict: 'A',
            link: function($scope, element) {

               function onClick() {
                  $scope.$emit(TRIGGER_EVENT_NAME);
               }

               element.on('click', onClick);

               $scope.$on('$destroy', function() {
                  element.off('click', onClick);
               });
            }
         };
      })
      .directive('dropdownBody', function() {
         return {
            restrict: 'A',
            link: function($scope, element, attr) {
               $scope.$on(TRIGGER_EVENT_NAME, function(event) {
                  if (event.stopPropagation) {
                     event.stopPropagation();
                  }
                  element.toggleClass(ACTIVE_CLASS);
                  if (element.hasClass(ACTIVE_CLASS)) {
                     $scope.dropdownActive();
                  } else {
                     $scope.dropdownInactive();
                  }
               });
               $scope.$on(HIDE_EVENT_NAME, function() {
                  if (element.hasClass(ACTIVE_CLASS)) {
                     element.removeClass(ACTIVE_CLASS);
                     if (attr.onHide) {
                        $scope.$apply(attr.onHide);
                     }

                  }
               });
            }
         };
      });

})();
