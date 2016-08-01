(function () {
   'use strict';

   angular
      .module('stepOne', [])
      .controller('stepOneCtrl', function ($scope, $stateParams, $timeout, Facebook, apiService, $state, userService, dataShareService, alerts) {
         $scope.isProgressing = true;
         $scope.currentFacebookInfo = {
            didLogin: false,
            facebook_id: '',
            facebook_access_token: ''
         };

         dataShareService.fnResetSignup();

         dataShareService.signup.university = $stateParams.university_id;
         dataShareService.signup.unique_id = $stateParams.unique_id;

         var isEmailSignup = (!!dataShareService.signup.university && dataShareService.signup.university != '');
         var isAAFSignup = (!!dataShareService.signup.unique_id && dataShareService.signup.unique_id != '');

         if (!isAAFSignup && !isEmailSignup) {
            $state.go('signUpSelectUniversity');
         }

         $scope.connectWithFacebook = function () {
            if ($scope.currentFacebookInfo.didLogin == true) {
               dataShareService.signup.facebook.is_connected = true;
               dataShareService.signup.facebook.facebook_id = $scope.currentFacebookInfo.facebook_id;
               dataShareService.signup.facebook.facebook_access_token = $scope.currentFacebookInfo.facebook_access_token;

               Facebook.api('/' + dataShareService.signup.facebook.facebook_id, function(response) {
                  dataShareService.signup.firstname = response.first_name;
                  dataShareService.signup.lastname = response.last_name;
                  dataShareService.signup.gender = response.gender;
                  dataShareService.signup.university_email = response.email;
                  $state.go('stepTwo');
               }, {scope: ['public_profile', 'email', 'user_about_me']});
            } else {
               $scope.isProgressing = true;
               Facebook.login(function (response) {
                  if (response.status == 'connected') {
                     $scope.isProgressing = false;
                     console.log('Facebook connected', response);
                     dataShareService.signup.facebook.is_connected = true;
                     dataShareService.signup.facebook.facebook_id = response.authResponse.userID;
                     dataShareService.signup.facebook.facebook_access_token = response.authResponse.accessToken;
                     Facebook.api('/' + dataShareService.signup.facebook.facebook_id, function(response) {
                        dataShareService.signup.firstname = response.first_name;
                        dataShareService.signup.lastname = response.last_name;
                        dataShareService.signup.gender = response.gender;
                        dataShareService.signup.university_email = response.email;
                        $state.go('stepTwo');
                     }, {scope: ['public_profile', 'email', 'user_about_me']});
                  } else {
                     $scope.isProgressing = false;
                     console.log('failed fb login', response);
                  }
                  $scope.$digest();
               }, {scope: ['public_profile', 'email', 'user_about_me']});
            }
         };

         $scope.getLoginStatus = function () {
            Facebook.getLoginStatus(function (response) {
               if(response.status === 'connected') {

                  console.log('Facebook connected', response);
                  $scope.currentFacebookInfo.didLogin = true;
                  $scope.currentFacebookInfo.facebook_id = response.authResponse.userID;
                  $scope.currentFacebookInfo.facebook_access_token = response.authResponse.accessToken;
               } else {
                  console.log('did not connect ', response);
               }
               $scope.$digest();
            }, function () {
               console.log('unable to connect with facebook with supported web domain');
            });
         };

         $scope.loadAAFInfoFromToken = function () {
            if (isAAFSignup) {
               $scope.isProgressing = true;
               apiService.getSignupData(dataShareService.signup.unique_id).then(function (response) {
                  $scope.isProgressing = false;
                  // dataShareService.signup <= response;
                  dataShareService.signup.firstname = response.firstNameAFF;
                  dataShareService.signup.lastname = response.lastNameAFF;
                  dataShareService.signup.university = response.uniIdAFF;
                  dataShareService.signup.uniIdAFF = response.uniIdAFF;
                  dataShareService.signup.uniAFF = response.uniAFF;
                  dataShareService.signup.position = response.positionAFF;
                  dataShareService.signup.positionAFF = response.positionAFF;
                  dataShareService.signup.group_id = response.group_id_AFF;
                  dataShareService.signup.csu_id = response.csu_id;
                  dataShareService.signup.university_email = response.emailAFF;
               }, function () {
                  $scope.isProgressing = false;
                  alerts.modal('Could not load login information.').closePromise.then(function () {
                     $state.go('signUpSelectUniversity');
                  });
               });
            }
         };

         $scope.$watch(function() {
            return Facebook.isReady();
         }, function(newVal) {
            if (newVal) {
               $scope.isProgressing = false;
            }
         });

         $scope.getLoginStatus();
         $scope.loadAAFInfoFromToken();

      });
})();
