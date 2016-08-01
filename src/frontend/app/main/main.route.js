(function() {
    'use strict';

    angular
        .module('main')
        .config(routeConfig);

    /** @ngInject */
    function routeConfig($stateProvider) {
        $stateProvider
            .state('main', {
                abstract: true,
                url: '',
                resolve: {
                    initServices: function($q, userService) {
                        var deferred = $q.defer();
                        if (!userService.getInfo()) {
                            userService.login('', '', true).then(
                                function() {
                                    deferred.resolve();
                                },
                                function() {
                                    deferred.reject();
                                }
                            );
                        } else {
                            deferred.resolve();
                        }

                        return deferred.promise;
                    }
                },
                views: {
                    '@': {
                        templateUrl: '/app/main/main.html',
                        controller: 'MainCtrl',
                    },
                    'right_side@main': {
                        templateUrl: '/app/main/default-right-side.html',
                        controller: 'defaultRightSideCtrl'
                    },
                },
                data: {
                    permissions: {
                        except: ['anonymous'],
                        redirectTo: function (toState, toParams, state) {
                           return {
                              name: 'login',
                              params: {
                                 redirectTo: state.href(toState.name, toParams)
                              }
                           };
                        }
                    }
                }
            });

    }

})();
