(function () {
   'use strict';

   angular
      .module('ucrAccountOther', [])
      .controller('otherCtrl', function ($scope, $state, apiService, userService, dataShareService, alerts) {
         $scope.settings = dataShareService.account.settings;

         $scope.preferredEmail = '';
         $scope.changePassword = {
            oldPassword: '',
            newPassword: '',
            confirmPassword: ''
         };

         $scope.deleteAccount = function () {
            alerts.confirm('Are you sure you want to close your account?').then(function () {
               $scope.$parent.isProgressing = true;
               apiService.deleteAccount().then(function (res) {
                  $scope.$parent.isProgressing = false;
                  if (res && res.data && res.data.message == 'Success') {
                     alerts.warning('You\'ve closed your account successfully');
                     userService.logout();
                     $state.go('login');
                  } else {
                     alerts.warning('You could not close your account.');
                     console.log('[error delete account]: ', arguments);
                  }
               }, function () {
                  $scope.$parent.isProgressing = false;
                  alerts.warning('You could not close your account.');
                  console.log('[error delete account]: ', arguments);
               });
            });
         };

         $scope.$on('saveAccountSetting', function (event, msg) {

            if ($scope.changePassword.oldPassword !== ''
            || $scope.changePassword.newPassword !== ''
            || $scope.changePassword.confirmPassword !== '') {
               apiService.account.settings.changePassword(
                     $scope.changePassword.oldPassword,
                     $scope.changePassword.newPassword,
                     $scope.changePassword.confirmPassword
                  ).then(function (response) {
                     alerts.warning('Successfully updated your password: ' + JSON.stringify(response));
                  }, function (err) {
                     alerts.warning(JSON.stringify(err));
                  });
            }
            if ($scope.preferredEmail != '') {
               apiService.account.settings.updatePreferredEmail(
                     $scope.preferredEmail
                  ).then(function (response){
                     alerts.warning('Successfully updated your preferred email addrss: ' + JSON.stringify(response));
                  }, function (err) {
                     alerts.warning(JSON.stringify(err));
                  });
            }
         });
      });
})();
