(function() {
      "use strict";

      angular.module('message', [])
         .directive('message', function($sce) {
            return {
               restrict: 'E',
               scope: {
                  message: '='
               },
               templateUrl: '/app/components/message/messageDirective.html',
               link: function($scope) {
                  $scope.images = [];
                  $scope.files = [];

                  if($scope.message.attachment_details && $scope.message.attachment_details.file_name) {
                     filterFiles([$scope.message.attachment_details]);
                  }


                  function filterFiles(uploadedFiles) {
                     angular.forEach(uploadedFiles, function (file) {
                        file.file_ext = getExtension(file);
                        file.file_name = getFileName(file);
                        file.url = file.file;

                        if (file.type.indexOf('image/') === 0) {
                           $scope.images.push(file);
                        } else {
                           $scope.files.push(file);
                        }
                     });
                  }
                  function getExtension(file) {
                     return file.file_name.substr(file.file_name.lastIndexOf('.') , 4);
                  }
                  function getFileName(file) {
                     return file.display_name;
                  }
               }
            }
         });
   }
)();
