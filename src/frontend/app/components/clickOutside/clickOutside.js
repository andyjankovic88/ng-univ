(function() {

    'use strict';

    angular.module('clickOutside', [])
        .directive('clickOutside', function(clickService) {
            return {
                restrict: 'A',

                link: function(scope, element) {


                    var onClick = function(target) {
                        var isClickedElementChildOfPopup = isDescendant(element[0], target);

                        if (isClickedElementChildOfPopup) {
                            return;
                        }

                        scope.onClickOutside();
                    };

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

                    scope.$on('$destroy', function() {
                        clickService.unregister(onClick);
                    });


                }

            };
        })
        .factory('clickService', function($document) {
            var callbacks = [];


            $document.bind('click', function(event) {

                angular.forEach(callbacks, function(clbk) {
                    clbk(event.target);
                });

            });

            var clickService = {
                register: function(callback) {
                    callbacks.push(callback);
                },
                unregister: function(callback) {
                    var index = callbacks.indexOf(callback);

                    if (index > -1) {
                        callbacks.splice(index, 1);
                    }
                }
            };

            return clickService;

        });


})();
