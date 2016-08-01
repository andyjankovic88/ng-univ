(function() {
	'use strict';

	angular
		.module('signUp', [])
		.controller('signUpCtrl', function() {

		})
      .directive('dropdownSelectValidate', function () {
         return {
            restrict: 'A',

            require: 'ngModel',

            link: function ($scope, $ele, $attrs, ngModel) {
               $scope.$watch($attrs.ngModel, function (obj, oldObj) {
                  var isValid = (typeof obj !== 'undefined');
                  ngModel.$setValidity($attrs.ngModel, isValid);
                  if (obj != oldObj) {
                     ngModel.$setDirty();
                  }
               });
            }

         }
      });


})();
