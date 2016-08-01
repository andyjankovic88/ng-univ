(function () {
   'use strict';
   angular
      .module('customgroups')
      .controller('createCustomGroupCtrl', function ($scope, apiService, userService, alerts, $state, $stateParams, $q) {
         $scope.newCGroup = {
            name: '',
            userfile: null,
            description: '',
            privacy: 0,
            faculty_id: '',
            category_id: '',
            campus_id: '',
            member_email: [],
            member_user_id: [],
            file_id: ''
         };


         $scope.privacyStatus = [
            {
               name: "Public",
               value: 0
            },
            {
               name: "Private",
               value: 1
            }
         ];
         $scope.selectedPrivacy = {
            name: "Public",
            value: 0
         };
         $scope.selectedCategory = {
            id: -1,
            category_name: "Select"
         };
         $scope.selectedFaculty = {
            id: -1,
            name: "Not related to a specific Faculty"
         };
         $scope.selectedCampus = {
            id: -2,
            name: "Not related to a specific Campus"
         };
         $scope.notCampus = {
            id: -1,
            name: "- Not applicable"
         };


         $scope.categories = [];
         $scope.faculty = [];
         $scope.campus = [];
         $scope.connections = [];
         $scope.connectedUsersID = [];

         $scope.editID = $stateParams.edit_id;
         if ($scope.editID) {
            apiService.customGroups.getDetails($scope.editID).then(
               function(response) {
                  if (!response.can_edit) {
                     alerts.warning("You can not edit this group");
                     $state.go('customgroup', {id: $scope.editID});
                     return;
                  }
                  if (response.members && response.members.users) {
                     $scope.connectedUsers = response.members.users.map(function(user){
                        return {
                           id: user.user_id,
                           name: user.userName,
                           photo_url: user.profilePic,
                           added: true
                        };
                     });
                     $scope.connectedUsersID = $scope.connectedUsers.map(function(user){return user.id;});
                  }

                  $q.all(promises).then (
                     function() {
                        $scope.newCGroup.name         =  response.name,
                        $scope.newCGroup.description  =  response.description,
                        $scope.selectedPrivacy        =  $scope.privacyStatus.filter(function(obj){return obj.value === response.privacy})[0];
                        $scope.selectedCategory       =  $scope.categories.filter(function(obj){return obj.id == response.category_id})[0];
                        $scope.selectedFaculty        =  $scope.faculty.filter(function(obj){return obj.id == response.faculty_id})[0];
                        $scope.selectedCampus         =  $scope.campus.filter(function(obj){return obj.id == response.campus_id})[0];
                        $scope.connections = $scope.connections.filter(function(obj){
                           return !~$scope.connectedUsersID.indexOf(obj.id);
                        });
                     }
                  );
               },
               function() {

               }
            );
         }


         var promises = [
            getData(apiService.customGroups.getList(), 'categories', 'filters'),
            getData(apiService.getFaculties(userService.getUnivInfo().id), 'faculty'),
            getData(apiService.getCampuses(userService.getUnivInfo().id), 'campus'),
            getData(apiService.profile.info(userService.getInfo().id), 'connections', 'connections')
         ];


         function getData(apiData, innerObj, responseObj){
            var deferred = $q.defer();
            apiData.then(
               function(response){
                  if (responseObj) {
                     $scope[innerObj]=response[responseObj];
                     return deferred.resolve();
                  }
                  $scope[innerObj]=response;
                  if (innerObj === 'campus') {
                     $scope[innerObj].unshift($scope.notCampus);
                  }
                  return deferred.resolve();
               },
               function () {
                  return deferred.reject();
               }
            );
            return deferred.promise;
         }





         $scope.usersEmail = [];

         $scope.requiredAll = function () {
            if ($scope.selectedCategory && $scope.selectedCategory.id > 0 && $scope.selectedFaculty && $scope.selectedFaculty.id > 0 && $scope.selectedCampus && $scope.selectedCampus.id != -2  && $scope.newCGroup.name) {
               return false;
            } else {
               return true;
            }
         };

         $scope.uploadLogo = function(file) {
            if (file) {
               $scope.newCGroup.userfile = file;
            }
         };

         $scope.submit = function () {
            var emails = $scope.usersEmail.map(function(email) { return email.email; });
            if (emails[0]) {
               $scope.newCGroup.member_email =  emails;
            }
            $scope.newCGroup.category_id  =  $scope.selectedCategory.id;
            $scope.newCGroup.privacy      =  $scope.selectedPrivacy.value;
            $scope.newCGroup.faculty_id   =  $scope.selectedFaculty.id;
            $scope.newCGroup.campus_id    =  $scope.selectedCampus.id;
            $scope.newCGroup.file_id      =  ($scope.csvFiles.length) ? $scope.csvFiles[0].file_id : '';
            angular.forEach($scope.connections, function(member) {
               if(member.added === true) $scope.newCGroup.member_user_id.push(member.user_id);
            });
            if ($scope.connectedUsersID.length) $scope.newCGroup.member_user_id = $scope.newCGroup.member_user_id.concat($scope.connectedUsersID);

            apiService.customGroups.create($scope.newCGroup, $scope.editID).then(function (response) {
               if (response && response.id) {
                  $state.go('customGroupEvents', {id: response.id});
                  return;
               }
               $state.go('customGroupsList');
            }, function (error) {
               alerts.warning(error);
            });

         };

         $scope.cancel = function () {
            $state.go('customGroupsList');
         };
      });

})();
