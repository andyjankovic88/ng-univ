(function() {
    'use strict';

    angular
        .module('login', [])
        .controller('LoginCtrl', function($scope, $location, $state, $stateParams, $interval, userService, apiService, ngDialog, Facebook, userGroups) {

            $scope.password = '';
            $scope.isLoginPage = true;
            $scope.selectedUniversity = null;
            $scope.isProgressing = false;

            $scope.loginHoldTime = userService.getLoginHoldTime();
            $scope.isLoginLocked = userService.isLoginLocked();
            $scope.lockTimeCounter = null;

            $scope.redirectTo = $stateParams.redirectTo;

            if ($scope.isLoginLocked) {
                startHoldTimeCounter();
            }

            $scope.login = function(loginForm) {
                if ($scope.isLoginLocked) {
                    return; }
                if (loginForm.$invalid) {
                    return; }
                if (!$scope.userName || !$scope.password) return;
                $scope.isProgressing = true;
                userService.login($scope.userName, $scope.password, $scope.isRememberUser)
                    .then(
                        function() {
                            $scope.isProgressing = false;
                            saveLoginInfo();
                            userService.resetFailedLoginAttempt();

                            goNext();
                        },
                        function(msg) {
                            $scope.isProgressing = false;
                            var errorMsg = "error while login: " + msg;
                            $scope.isLoginLocked = userService.increaseFailedLoginAttempt();
                            if ($scope.isLoginLocked) {
                                $scope.loginHoldTime = userService.getLoginHoldTime();
                                startHoldTimeCounter();
                            }
                            ngDialog.open({
                                template: '<h2>' + errorMsg + '</h2>',
                                plain: true
                            });
                        }
                    );
            };

            function doFacebookLogin(userID, accessToken) {
                userService.fbLogin(userID, accessToken)
                    .then(
                        function() {
                            $scope.isProgressing = false;
                            goNext();
                        },
                        function(msg) {
                            $scope.isProgressing = false;
                            var errorMsg = "error while login: ";
                            if (msg && msg.data && msg.data.message) {
                                errorMsg += msg.data.message;
                            } else {
                                errorMsg += JSON.stringify(msg);
                            }
                            ngDialog.open({
                                template: '<h2>' + errorMsg + '</h2>',
                                plain: true
                            });
                        }
                    );
            }

            $scope.universities = [];

            $scope.loginWithFacebook = function() {
                if (!Facebook.isReady()) {
                    return;
                }
                $scope.isProgressing = true;
                var authInfo = window.FB.getAuthResponse();
                if (authInfo) {
                    doFacebookLogin(authInfo.userID, authInfo.accessToken);
                } else {
                    Facebook.login(function(response) {
                        if (response.status == 'connected') {
                            doFacebookLogin(response.authResponse.userID, response.authResponse.accessToken);
                        } else {
                            $scope.isProgressing = false;
                            console.log('failed fb login', response);
                        }
                    });
                }
            };

            apiService.getUniversities().then(function(response) {
                $scope.universities = response;
            });
            loadLoginInfo();

            function saveLoginInfo() {
                var univForSave = $scope.isRememberUniv ? $scope.selectedUniversity : {};

                userService.saveLoginInfo(univForSave, $scope.userName);
            }

            function loadLoginInfo() {
                var savedFormData = userService.getLoginInfo();

                if (savedFormData.univ && savedFormData.univ.name) {
                    $scope.selectedUniversity = savedFormData.univ;
                    $scope.isRememberUniv = true;
                } else {

                    //{
                    //   name: "Select your university to get started",
                    //   aaf: true,
                    //   id: 0
                    //};
                    $scope.isRememberUniv = false;
                }
                $scope.userName = savedFormData.email || '';
            }

            function startHoldTimeCounter() {
                $scope.lockTimeCounter = $interval(function() {
                    if (!userService.isLoginLocked()) {
                        $scope.loginHoldTime = 0;
                        $scope.isLoginLocked = false;
                        $interval.cancel($scope.lockTimeCounter);
                        $scope.lockTimeCounter = null;
                    }
                }, 5000);
            }

            function goNext() {
                var userData =  userService.getInfo();
                if (!userData) {
                    return;
                }


                if (userData.firstSteps) {
                    if (userData.group_id === userGroups.staff) {
                        $state.go('firstStepsStaffOne');
                    } else {
                        $state.go('firstStepsOne');
                    }
                } else {
                    if ($scope.redirectTo) {
                       $location.url($scope.redirectTo);
                    } else {
                       $state.go('recentActivity');
                    }
                }

            }

            $scope.$on('$destroy', function() {
                if ($scope.lockTimeCounter) {
                    $timeout.cancel($scope.lockTimeCounter);
                }
            });

        });

})();
