(function () {
   'use strict';

   angular
      .module('passwordRecovery', [])
      .controller('recoveryCtrl', function ($scope, $state, userService, apiService, alerts, ngDialog) {

         $scope.recoveryEmail = '';
         $scope.emailDoesNotExist = false;

         $scope.requestRecovery = function () {

            if ($scope.recoveryForm.$invalid) return;

            apiService.sendPasswordRecoveryRequest($scope.recoveryEmail)
               .then(
                  function (response) {
                     if (response.error) {
                        angular.element('input[name="email"]').focus();
                        $scope.emailDoesNotExist = true;
                     } else {
                        $state.go('passwordRecovery.success');
                     }
                  },
                  function (msg) {
                     var errorMsg = "error while password recovering: " + msg;
                     ngDialog.open({
                        template: '<h2>' + errorMsg + '</h2>',
                        plain: true
                     });

                  }
               );
         };

         $scope.$watch('recoveryEmail', function () {
            $scope.emailDoesNotExist = false;
         });
      }).controller('recoveryConfirmCtrl', function ($scope, $state, userService, apiService, ngDialog) {
         $scope.resetToken = $stateParams.reset_token;
         $scope.newPassword = '';
         $scope.confirmPassword = '';

         $scope.resetPassword = function (form) {

            if (form.$invalid) return;

            userService.resetPassword($scope.resetToken, $scope.newPassword, $scope.confirmPassword)
               .then(
               function (response) {
                  alerts.modal('You\'ve changed your password successfully.').closePromise.then(function () {
                     $state.go('login');
                  });
               },
               function (msg) {
                  var errorMsg = "error while password recovering: " + msg;
                  ngDialog.open({
                     template: '<h2>' + errorMsg + '</h2>',
                     plain: true
                  });

               }
            );
         };

         $scope.$watch('recoveryEmail', function () {
            $scope.emailDoesNotExist = false;
         });
      }).directive("pwCheck", function() {
         return {
            require: 'ngModel',
            link: function (scope, elem, attrs, ctrl) {
               var firstPassword = '#' + attrs.pwCheck;
               elem.add(firstPassword).on('keyup', function () {
                  scope.$apply(function () {
                     var v = elem.val()===$(firstPassword).val();
                     ctrl.$setValidity('pwmatch', v);
                  });
               });

            }
         };
      });
})();
