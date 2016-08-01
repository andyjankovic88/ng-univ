(function() {
   'use strict';

   var YEARS_RANGE = 50; //range for educations years

   angular
      .module('editProfile', [])
      .controller('editProfileCtrl', function($scope, $state,  apiService, userService, userGroups, alerts) {

         $scope.userId = userService.getInfo().id;
         $scope.user_name = userService.getInfo().userName;
         $scope.userGroups = userGroups;
         angular.forEach(userGroups, function(value, key) {
            if (value == userService.getInfo().group_id) {
               $scope.position = key;
            }
         });

         $scope.works = [];
         $scope.languages = [];
         $scope.skills = [];
         $scope.interests = [];
         $scope.education = [];
         $scope.selectedFaculties = [];
         $scope.search ={};

         $scope.years = [];
         var currentYear = new Date().getFullYear();
         for (var i = 0; i < YEARS_RANGE + 1; i++){
            $scope.years.push(currentYear - i);
         }

         apiService.profile.details().then(
            function(response) {
               $scope.details = response;

               if ($scope.details.completion_year && $scope.details.start_year) {
                  delete $scope.details.completion_year.options[""];
                  delete $scope.details.start_year.options[""];

                  $scope.details.completion_year.current = String($scope.details.completion_year.current);
                  $scope.details.start_year.current = String($scope.details.start_year.current);
               }

               if ($scope.details.work_experience && $scope.details.work_experience.length) {
                  $scope.works = $scope.details.work_experience;
               }
               if ($scope.details.languages && $scope.details.languages.length) {
                  $scope.languages = $scope.details.languages.map(function(value){
                     return {
                        title: value
                     };
                  });
               }
               if ($scope.details.skills && $scope.details.skills.length) {
                  $scope.skills = $scope.details.skills.map(function(value){
                     return {
                        title: value
                     };
                  });
               }
               if ($scope.details.interests && $scope.details.interests.length) {
                  $scope.interests = $scope.details.interests.map(function(value){
                     return {
                        title: value
                     };
                  });
               }
               if ($scope.details.education && $scope.details.education.length) {
                  $scope.education = $scope.details.education;
               }
               if ($scope.details.faculties && $scope.details.faculties.options && $scope.details.faculties.options.length && response.faculties.current && response.faculties.current.length) {
                  angular.forEach($scope.details.faculties.options, function(faculty){
                     if (response.faculties.current.indexOf(faculty.id) != -1) {
                        faculty.selected = true;
                     }
                  });
               }
               if ($scope.details.courses && $scope.details.courses.options.length) {
                  $scope.degree  = $scope.details.courses.options.filter(function(course){
                     if (course.id == $scope.details.courses.current) {
                        return true;
                     }
                  })[0];
                  $scope.search.label = $scope.degree.label;
               }
               $scope.showVET = function() {
                     if(userService.getUnivInfo().id==4 && response.user_group_id=="2"){
                        return true;
                     }
                     else{
                        return false;
                     }

               };
            }
         );

         $scope.uploadUserPic = function (file) {
            if (file) {
               apiService.profile.uploadUserPic(file).then(
                  function(response) {
                     $scope.details.profile_pic = response[0].url;
                  }
               );
            }
         };

         $scope.select = function(course) {
            $scope.degree = course;
            $scope.search.label = course.label;
         };

         $scope.updateProfile = function() {
            var data = {
               campus: $scope.details.campus.current,
               international: $scope.details.international,
               position: $scope.position
            };

            if ($scope.selectedFaculties) {
               var facultiesObj = {};
               angular.forEach($scope.selectedFaculties, function(value, index){
                  facultiesObj[index] = value;
               });
               data.faculty = facultiesObj;
            }

            apiService.profile.update(data).then(
               function() {
                  alerts.info("Your details have been updated successfully.");

               },
               function(response) {
                  alerts.info(response.data.message);
                  console.error(response.data.message);
               }
            );
         };

         $scope.updateStudentProfile = function () {
            console.log($scope.education);
            console.log($scope.works);
            var data = {
               campus: $scope.details.campus.current,
               course_name:$scope.degree.label,
               course: $scope.degree.id,
               start_year: $scope.details.start_year.current,
               completion_year: $scope.details.completion_year.current,
               international: $scope.details.international,
               education: $scope.education,
               work_experience: $scope.works,
               places: {
                  Town: $scope.details.places.town,
                  Currtown: $scope.details.places.currtown,
                  Country: $scope.details.places.country
               },
               skills: $scope.skills.map(function(skill){
                  return skill.title;
               }),
               interests: $scope.interests.map(function(skill){
                  return skill.title;
               }),
               languages: $scope.languages.map(function(skill){
                  return skill.title;
               })
            };
            if ($scope.selectedFaculties) {
               var facultiesObj = {};
               angular.forEach($scope.selectedFaculties, function(value, index){
                  facultiesObj[index] = value;
               });
               data.faculty = facultiesObj;
            }
            if ($scope.details.vet) {
                  data.vet = $scope.details.vet;
            }

            console.log(data);
            apiService.profile.update(data).then(
               function() {
                  alerts.info("Your details have been updated successfully.");
                  $state.go('profile', {id:$scope.userId});
               },
               function(response) {
                  alerts.info(response.data.message);
                  console.error(response.data.message);
               }
            );
         };

      });

})();
