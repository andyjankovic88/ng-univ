(function() {
   'use strict';

   angular
      .module('stepThree', [])
      .controller('stepThreeCtrl', function($scope, $state, $q, userGroups, apiService, userService, dataShareService, ngDialog) {
         var i,
            currentMonth = moment(new Date()).month(),
            currentYear = moment(new Date()).year();

         if (currentMonth >= 9) {currentYear += 1;}

         $scope.signupData = dataShareService.signup;
         $scope.isProgressing = false;

         if (!dataShareService.signup.university || dataShareService.signup.university === '') {
            $state.go('signUpSelectUniversity');
            return;
         }

         $scope.isStaffRegister = $scope.signupData.uniIdAFF && $scope.signupData.group_id != userGroups.student;

         function init () {
            $scope.isProgressing = true;
            $scope.courseStartYears = [];
            $scope.courseEndYears = [];
            $scope.faculties = [];
            $scope.campuses = [];
            $scope.courses = [];

            for (i = 0; i < 11; i++) {
               $scope.courseStartYears.push({
                  value: currentYear - 10 + i,
                  title: (currentYear - 10 + i).toString()
               });

               $scope.courseEndYears.push({
                  value: currentYear + i,
                  title: (currentYear + i).toString()
               });
            }
            $q.all([
                  apiService.getFaculties($scope.signupData.university).then(function (response) {
                     angular.extend($scope.faculties, response);
                  }),
                  apiService.getCampuses($scope.signupData.university).then(function (response) {
                     angular.extend($scope.campuses, response);
                  }),
                  apiService.getCourses($scope.signupData.university).then(function (response) {
                     angular.extend($scope.courses, response);
                  })
               ])
               .then(function() {
                  $scope.isProgressing = false;
               });
         }

         $scope.changeDropdownSelect = function (objName, object) {
            if (!$scope.signupForm[objName]) {
               $scope.signupForm[objName] = {};
            }
            $scope.signupForm[objName].$dirty = true;
            if (!object || typeof object.value == 'undefined') {
               $scope.signupForm[objName].$invalid = true;
            }
         };

         $scope.goBack = function (signupForm) {
            $state.go('stepTwo');
         };

         $scope.signUp = function (signupForm) {
            if (signupForm.$invalid) {
               return;
            }
            var signupData = {};
            signupData.email = $scope.signupData.university_email;
            signupData.secondary_email = '';
            signupData.password = $scope.signupData.password;
            signupData.university_id = $scope.signupData.university;
            signupData.campus_id = $scope.signupData.campus;
            signupData.course_id = '';
            signupData.first_name = $scope.signupData.firstname;
            signupData.last_name = $scope.signupData.lastname;
            signupData.gender = $scope.signupData.gender;
            signupData.start_year = $scope.signupData.course_start;
            signupData.completion_year = $scope.signupData.course_end;
            signupData.international = $scope.signupData.isInternationalStudent;
            signupData.faculty_id = $scope.signupData.faculty;
            signupData.positionAFF = $scope.signupData.positionAFF;
            signupData.csu_id = $scope.signupData.csu_id;
            signupData.normal_student_sign_up = $scope.signupData.uniIdAFF ? 0 : 1;
            signupData.course_id = '';
            if ($scope.signupData.course && $scope.signupData.course.id) {
               signupData.course_id = $scope.signupData.course.id;
            }
            if (signupData.staff_type == '') {
               // signupData.staff_type =  'staff_academic';
            }
            if ($scope.signupData.facebook.is_connected) {
               signupData.facebook_id = $scope.signupData.facebook.facebook_id;
               signupData.facebook_access_token = $scope.signupData.facebook.facebook_access_token;
            }

            $scope.isProgressing = true;
            apiService.signup(signupData).then(function (response) {
               $scope.isProgressing = false;
               if (response.data && response.data.message == 'Signup Successfull' ) {
                  ngDialog.open({
                     template: '<h2>You\'ve successfully registered your account. Please login to your account</h2>',
                     plain: true
                  }).closePromise.then(function (data) {
                     $state.go('login');
                  });
               } else {
                  var msg = '';
                  if (response.data && response.data.message) {
                     msg = response.data.message;
                  } else {
                     msg = JSON.stringify(response);
                  }
                  ngDialog.open({
                     template: '<h2>' + msg + '</h2>',
                     plain: true
                  });
               }
            }, function (error) {
               $scope.isProgressing = false;
               var msg = '';
               if (error.data && error.data.message) {
                  msg = error.data.message;
               } else {
                  msg = JSON.stringify(error);
               }
               ngDialog.open({
                  template: '<h2>' + msg + '</h2>',
                  plain: true
               });
            });
         };

         init();
      });



})();
