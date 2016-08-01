(function () {
   'use strict';

   angular.module('user', [])
      .factory('userService', function ($q, apiService, ignoreLogin, $rootScope) {
         var
            userData,
            errorMessage,
            selectedUniv,
            isRememberLogin = 0,
            group = '';
         var LOGIN_TRY_COUNT = 5;
         var LOCKTIME = 1000 * 60 * 10;


         function save (state) {
            isRememberLogin = state ? 1 : 0;
            localStorage.setItem('is_remember_login', isRememberLogin);
            if (isRememberLogin) {
               localStorage.setItem('userData', JSON.stringify(userData));
            }
         }

         function load (state) {
            if (localStorage.getItem('is_remember_login')) {
               isRememberLogin = parseInt(localStorage.getItem('is_remember_login'));
               if (isNaN(isRememberLogin)) {
                  isRememberLogin = 0;
               }
            } else {
               isRememberLogin = 0;
            }

            if (isRememberLogin) {
               try {
                  userData = JSON.parse(localStorage.getItem('userData'));
               } catch(e) {

               }
            }
         }



         function getData(key) {
            if (userData) {
               return userData[key];
            } else {
               return undefined;
            }
         }

         load();
         var User = {
            login: function (login, pass, isSaveUserInfo) {
               var deferred = $q.defer();

               if(userData) { // we already logged in
                  deferred.resolve();
               } else {
                  apiService.login(login, pass).then(
                     function (response) {
                        userData = response;
                        save(isSaveUserInfo);
                        errorMessage = response.message;
                        if (errorMessage) {
                           deferred.reject(errorMessage);
                        }
                        deferred.resolve();
                     },
                     function (response) {
                        if(!ignoreLogin) {
                           errorMessage = response.data.message;
                           deferred.reject(errorMessage);
                        } else {
                           deferred.resolve(errorMessage);
                        }
                     }
                  );
               }

               return deferred.promise;
            },
            fbLogin: function (facebookID, facebookToken) {
               var deferred = $q.defer();

               if(userData) { // we already logged in
                  deferred.resolve();
               } else {
                  return apiService.fbLogin(facebookID, facebookToken).then(
                     function (response) {
                        userData = response;
                        errorMessage = response.message;
                        if (errorMessage) {
                           deferred.reject(errorMessage);
                        }
                        deferred.resolve();
                     },
                     function (response) {
                        if(!ignoreLogin) {
                           errorMessage = response.data.message;
                           deferred.reject(errorMessage);
                        } else {
                           deferred.resolve(errorMessage);
                        }
                     }
                  );
               }

               return deferred.promise;
            },
            loadMyInfo: function () {
               var deferred = $q.defer();
               apiService.getMyInfo().then(
                  function (response) {
                     errorMessage = response.message;
                     if (errorMessage) {
                        deferred.reject(errorMessage);
                     } else {
                        userData = response;
                        deferred.resolve(userData);
                     }
                  }, function (response) {
                     errorMessage = response.message;
                     if (!errorMessage) {
                        errorMessage = JSON.stringify(response.message);
                     }
                     deferred.reject(errorMessage);
                  }
               );
               return deferred.promise;
            },
            setGroup: function(groupName) {
               group = groupName;
            },
            hasGroup: function (groupName) {
               return group === groupName;
            },
            logout: function () {

               $rootScope.$broadcast('logoutEvent','');
               userData = undefined;
               isRememberLogin = 0;
               localStorage.removeItem('is_remember_login');

            },
            isLoggedIn: function () {
               return !!userService.getInfo() || isRememberLogin;
            },
            isKeepLoginStatus: function () {
               return isRememberLogin;
            },
            getMenu: function () {
               if (userData) {
                  return userData.mainMenu;
               } else {
                  return undefined;
               }
            },
            getUnivInfo: function () {
               if (userData) {
                  return userData.eduInstitution;
               } else {
                  return undefined;
               }

            },
            getInfo: function () {
               return getData('user');
            },
            isFirstVisit: function () {
               return getData('first_steps');
            },
            selectedUniv: function (newSelectedUniv) {
               var selUnivJSON;

               if (newSelectedUniv) {
                  selectedUniv = newSelectedUniv;
                  localStorage.setItem('selectedUniv', angular.toJson(selectedUniv));
               } else {
                  selUnivJSON = localStorage.getItem('selectedUniv');
                  if (selUnivJSON && selUnivJSON !== 'undefined') {
                     selectedUniv = angular.fromJson(selUnivJSON);
                  }
               }
               return selectedUniv;
            },
            saveLoginInfo: function(univ, email) {
               localStorage.setItem('loginInfo', angular.toJson({univ: univ, email: email}));
            },
            getLoginInfo: function() {
               var loginInfo;

               if (localStorage.getItem('loginInfo')) {
                  loginInfo = angular.fromJson(localStorage.getItem('loginInfo'));
               }
               return loginInfo || {};
            },
            getFailedLoginAttempt: function () {
               return localStorage.getItem('failedLoginCount') || 0;
            },
            resetFailedLoginAttempt: function () {
               localStorage.setItem('loginHoldTime', 0);
               localStorage.setItem('failedLoginCount', 0);
            },
            increaseFailedLoginAttempt: function () {
               var loginCount = parseInt(User.getFailedLoginAttempt());
               if (isNaN(loginCount)) {
                  loginCount = 1;
               } else {
                  loginCount++;
               }
               localStorage.setItem('failedLoginCount', loginCount);
               if (loginCount > LOGIN_TRY_COUNT) { // register login hold time
                  localStorage.setItem('loginHoldTime', (new Date()).getTime());
               }
               return loginCount > LOGIN_TRY_COUNT;
            },
            getLoginHoldTime: function () {
               var holdTime = localStorage.getItem('loginHoldTime');
               return holdTime ? holdTime : 0;
            },
            isLoginLocked: function () {
               var curTime = (new Date()).getTime();
               var isTimeout = curTime - User.getLoginHoldTime() > LOCKTIME;
               var isLocked;
               if (User.getFailedLoginAttempt() == 0) {
                  isLocked = false;
               } else if (User.getFailedLoginAttempt() > LOGIN_TRY_COUNT && isTimeout) {
                  User.resetFailedLoginAttempt();
                  isLocked = false;
               } else if (User.getFailedLoginAttempt() <= LOGIN_TRY_COUNT) {
                  isLocked = false;
               } else {
                  isLocked = true;
               }
               return isLocked;
            }
         };


         return User;
      });
})();
