(function() {

    'use strict';

    var activeEl;
    var defaultActive;
    var submenuEl;


    angular.module('mainMenu', [])
        .directive('mainMenu', function(userService, $state, userGroups) {
            return {
                restrict: 'E',
                scope: {

                },
                templateUrl: '/app/components/mainMenu/mainMenu.html',
                link: function(scope, element, attrs) {
                    scope.isSub = false;
                    scope.dataKey = '';
                    scope.subList = [];
                    scope.isStaff = userService.getInfo().group_id != userGroups.student;
                    scope.menu = userService.getMenu();
                    scope.univMenu = userService.getUnivInfo().menu;

                    scope.subIcon = '';
                    scope.subTitle = '';
                    scope.goSub = function($event, dataKey, title, icon, subState) {
                        scope.isSub = true;
                        scope.subIcon = icon;
                        scope.subTitle = title;
                        scope.subList = scope.menu[dataKey];
                        scope.subState = subState;
                        scope.sectionState = $($event.currentTarget).attr('ui-sref');

                        if (activeEl) {
                            activeEl.removeClass('active');
                        }
                        activeEl = element.find('.submenu>a.item');
                        activeEl.addClass('active');


                        $.Velocity(submenuEl, {
                            'left': '0%',
                            'opacity': '1'
                        }, {
                            duration: 200
                        });



                    };
                    scope.inMenu = function (key) {
                       if (userService && userService.getMenu()) {
                          var keysArray = Object.keys(userService.getMenu());
                          return keysArray.indexOf(key) > -1;
                       }
                    };
                    scope.isStudent = function () {
                       if (userService && userService.getInfo()) {
                          return userService.getInfo().group_id === userGroups.student;
                       }
                    };
                    scope.goRoot = function() {
                        scope.isSub = false;
                        if (activeEl)
                            activeEl.removeClass('active');
                        activeEl = defaultActive;
                        activeEl.addClass('active');

                        $.Velocity(submenuEl, {
                            'left': '-100%',
                            'opacity': '0'
                        }, {
                            duration: 200
                        });

                    };
                    scope.univLogo = userService.getUnivInfo().logo;



                },

            };
        })
        .directive('rootMenu', function() {
            return {
                restrict: 'E',
                templateUrl: '/app/components/mainMenu/rootMenu.html',
                link: function(scope, element) {
                    defaultActive = element.find('a.active');
                    activeEl = defaultActive;
                },

            };
        })
        .directive('submenu', function($state) {
            return {
                restrict: 'E',
                templateUrl: '/app/components/mainMenu/submenu.html',
                link: function(scope, element, attrs) {
                    submenuEl = element.children(":first");
                    scope.goTo = function(state, id){
                       $state.go(state, {id: id})
                    };
                }
            };
        })
        .directive('activate', function() {
            return {
                restrict: 'A',
                link: function(scope, element, attrs) {


                    function activate() {
                        if (activeEl) activeEl.removeClass('active');
                        element.addClass('active');
                        activeEl = element;
                    }
                    element.on('click', activate);
                    scope.$on('$destroy', function() {
                        element.off('click', activate);
                        //activeEl = undefined;
                    });
                }
            };
        });


})();
