(function () {
   'use strict';

   angular
      .module('conversation', [])
      .controller('conversationPersonCtrl', function ($scope, apiService, $stateParams, $sce, userService, $q, alerts) {
         var
            conversationId = $stateParams.id,
            page = 0,
            isFirstReadReached = false,
            isAlreadyRead = false,
            totalPagesCount = 1,
            fileId;


         var message = {
            attachment_details: [],
            how_long_ago: 'now',
            is_blocked: false,
            is_read: 0,
            message_text: '',
            profile_pic: userService.getInfo().profilePic,
            user_id: userService.getInfo().id,
            username: userService.getInfo().userName
         };
         $scope.attachment = {
            images: [],
            files: []
         };

         $scope.listRequestInProgress = false;

         $scope.oldMessages = [];
         $scope.newMessages = [];

         $scope.newMessage = '';
         $scope.title = $stateParams.title;
         $scope.profilePic = message.profile_pic;


         $scope.postMessage = function () {
            apiService.messages.post(conversationId, $scope.newMessage, fileId).then(
               function () {
                  readAll();
                  addMessageToList($scope.newMessage, fileId);
               }
            );
         };

         $scope.uploadFiles = function (files) {
            if (files && files.length) {
               apiService.messages.file(files).then(
                  function onFileUploaded(response) {
                     var filesArray = [];
                     filesArray.push(response.file_id);
                     fileId = response.file_id.file_id;
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

         $scope.loadNextPage = function (reset) {
            var deferred = $q.defer();

            if (reset) {
               page = 0;
            }

            if (page < totalPagesCount ) {
               if (page === 1) {
                  readAll();
               }
               $scope.listRequestInProgress = true;
               apiService.messages.conversations(page, conversationId).then(
                  function (response) {
                     $scope.listRequestInProgress = false;
                     if(!$scope.title) {
                        $scope.title = response.title;
                     }
                     if(page === 0) {
                        totalPagesCount = response.total_pages_count;
                     }
                     page++;
                     if (angular.isArray(response.messages)) {
                        if (response.messages.length > 0) {
                           angular.forEach(response.messages, function (val) {
                              val.message_text = $sce.trustAsHtml(val.message_text);
                           });
                           if (response.messages.length > 0) {
                              processMessages(response.messages);
                           }
                           $scope.listRequestInProgress = false;
                        }
                     }
                     return deferred.resolve();
                  },
                  function () {
                     $scope.listRequestInProgress = false;
                     return deferred.reject();
                  }
               );
            }

            return deferred.promise;
         };


         function addMessageToList(text) {
            message.message_text = $sce.trustAsHtml(text);

            makeAttachment();
            $scope.oldMessages.push(angular.copy(message)); // may be copy is unnecessary, because right after we pushed new message we should update list
            $scope.newMessage = '';

            $scope.attachment = {
               images: [],
               files: []
            };
         }


         function readAll() {
            if(isAlreadyRead) {
               return;
            }
            apiService.messages.markAsRead(conversationId);
            isFirstReadReached = true;
            $scope.oldMessages = $scope.newMessages.concat($scope.oldMessages);
            $scope.newMessages = [];
            isAlreadyRead = true;
         }

         function makeAttachment() {
            var file = $scope.attachment.images[0] || $scope.attachment.files[0];

            if(file) {
               message.attachment_details = {
                  display_name: file.file_name,
                  file: file.url,
                  file_name: file.url,
                  type: file.file_type
               };
            }
         }

         function processMessages(messagesPage) {
            var
               firstReadInd = 0;

            if (isFirstReadReached) {
               $scope.oldMessages = messagesPage.concat($scope.oldMessages);
            } else {
               firstReadInd = findFirstRead(messagesPage);
               if (firstReadInd >= 0) {
                  isFirstReadReached = true;
                  $scope.oldMessages = messagesPage.slice(firstReadInd).concat($scope.oldMessages);
                  $scope.newMessages = messagesPage.slice(0, firstReadInd).concat($scope.newMessages);
               } else {
                  $scope.newMessages = messagesPage.concat($scope.newMessages);
               }
            }
         }
         function findFirstRead(messagesPage) {
            var ind = messagesPage.length - 1;

            while ((ind >= 0) && (messagesPage[ind].is_read === 0)) {
               ind--;
            }
            return ind; // if haven't found - return -1;
         }
         function filterFiles(uploadedFiles) {
            angular.forEach(uploadedFiles, function (file) {
               if (file.file_type.indexOf('image/') === 0) {
                  $scope.attachment.images.push(file);
               } else {
                  $scope.attachment.files.push(file);
               }
            });
         }

      });

})();
