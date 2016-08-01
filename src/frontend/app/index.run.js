(function() {
    'use strict';

    angular.module('ucroo').run(run);

    /** @ngInject */
    function run(userService, Permission, $q, userGroups) {

        Permission.defineRole('anonymous', function() {

            var deferred = $q.defer();

            if (userService.getInfo()) {
                deferred.reject();
            } else {
                deferred.resolve();
                //if (userService.isKeepLoginStatus()) {
                //    userService.loadMyInfo().then(
                //        function() {
                //           deferred.reject();
                //        },
                //        function() {
                //           deferred.resolve();
                //        }
                //    );
                //} else {
                //    deferred.resolve();
                //}
            }
            return deferred.promise;
        });

        Permission.defineRole('sameUser', function(stateParams) {
            var
                deferred,
                userInfo;


            if (stateParams.userId === '') {
                return true;
            }

            userInfo = userService.getInfo();

            if (userInfo) {
                return parseInt(stateParams.userId) === userInfo.id;
            } else {
                deferred = $q.defer();

                userService.login('', '', true).then(
                    function() {
                        userInfo = userService.getInfo();
                        if (parseInt(stateParams.userId) === userInfo.id) {
                            deferred.resolve();
                        } else {
                            deferred.reject();
                        }
                    },
                    function() {
                        deferred.reject();
                    }
                );

                return deferred.promise;
            }
        });
        Permission.defineRole('firstSteps', function() {

            console.log('role firstSteps');
            return false;
        });


        Permission.defineRole('staff', function() {
           var deferred, userInfo;
           userInfo = userService.getInfo();
           if (userInfo) {
              return userInfo.group_id != userGroups.student;
           } else {
              deferred = $q.defer();

              userService.login('', '', true).then(
                 function() {
                    userInfo = userService.getInfo();
                    if (userInfo.group_id != userGroups.student) {
                       deferred.resolve(true);
                    } else {
                       deferred.reject();
                    }
                 },
                 function() {
                    deferred.reject();
                 }
              );
              return deferred.promise;
           }
        });

        Permission.defineManyRoles(['student', 'unadmin'], function(stateParams, roleName) {
            return userService.hasGroup(roleName);
        });

    }

})();
