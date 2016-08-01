(function() {
	'use strict';

	angular
		.module('stepTwo', [])
		.controller('stepTwoCtrl', function($scope, $state, apiService, userService, dataShareService) {

         if (!dataShareService.signup.university || dataShareService.signup.university === '') {
            $state.go('signUpSelectUniversity');
         }
         $scope.genders = [{
            id: 'male',
            value: 'male',
            title: 'Male'
         }, {
            id: 'female',
            value: 'female',
            title: 'Female'
         }, {
            id: 'other',
            value: 'other',
            title: 'Other'
         }];

         $scope.signupData = dataShareService.signup;

         $scope.nextStep = function (signupForm) {
            if (signupForm.$invalid) {
               console.log('Invalid form data');
               return;
            }
            $state.go('stepThree');
         };
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
