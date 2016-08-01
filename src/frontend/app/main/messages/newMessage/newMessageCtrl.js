(function () {
   'use strict';

   angular
      .module('newMessage', [])
      .controller('newMessageCtrl', function ($scope, apiService,ngDialog, alerts, $state, $stateParams) {
         $scope.message = {
            text: '',
            recipient: [],
            attachment: ''
         };
         $scope.attachment = {
            images: [],
            files: []
         };


         $scope.initialUser=$stateParams.recepient;

         $scope.uploadFiles = function (files) {
            if (files && files.length) {
               apiService.messages.file(files).then(
                  function onFileUploaded(response) {
                     var filesArray = [];
                     filesArray.push(response.file_id);
                     if (angular.isArray(filesArray) && filesArray.length > 0) {
                        filterFiles(filesArray);
                     }
                  },
                  function onFileUploadedError(message) {
                     alerts.warning(message);
                  }
               );
            }
         };

         $scope.cancel = function () {
            $state.go('conversationList');
         };


         $scope.postMessage = function () {
            if ($scope.message.text === "") {
               alerts.warning("Please enter a text");
               return;
            }
            if ($scope.selectedUsers.length === 0) {
               alerts.warning("Please select a user");
               return;
            }
            $scope.message.recipient = $scope.selectedUsers.map(function (user) {
               return user.user_id;
            });
            apiService.messages.postNew($scope.message).then(function (response) {
               $state.go("conversation", {"id": response.conversation_id});
            });
         };

         function filterFiles(uploadedFiles) {
            angular.forEach(uploadedFiles, function (file) {
               if (file.file_type.indexOf('image/') === 0) {
                  $scope.attachment.images.push(file);
               } else {
                  $scope.attachment.files.push(file);
               }
               $scope.message.file_id=file.file_id;
            });
         }
      });

})();
