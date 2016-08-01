(function () {
    'use strict';

    angular
        .module('signUpSelectUniversity', [])
        .controller('selectUniversityCtrl', function ($scope, apiService, $state, userService, dataShareService) {
            var defaultOption = null;

            $scope.selectedUniversity = defaultOption;

            $scope.universities = [];

            apiService.getUniversities().then(function (response) {

                $scope.universities = response;
                $scope.selectedUniversity = userService.selectedUniv() || defaultOption;

            });

            $scope.nextStep = function (form) {
               if (form.$invalid) {
                  return;
               }
               if(!$scope.selectedUniversity || !$scope.selectedUniversity.id) {
                  return;
               }
               userService.selectedUniv($scope.selectedUniversity);
               dataShareService.fnResetSignup();
                if ($scope.selectedUniversity.aaf) {
                   // console.log('/user/signup/?web_signup=' + $scope.selectedUniversity.name);
                   window.location.href = '/user/signup/?web_signup=' + $scope.selectedUniversity.name;
                }
                else {
                    $state.go('stepOne', {university_id: $scope.selectedUniversity.id});
                }
            };

        });


})();
