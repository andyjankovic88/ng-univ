(function() {
      "use strict";

      var ABSENT_FILE_EXT = '';

      angular.module('fileList', [])
         .directive('fileList', function(helper) {
            return {
               restrict: 'E',
               scope: {
                  list: '='
               },
               templateUrl: '/app/components/fileList/fileList.html',
               link: function($scope, $elem, $attr) {
                  $scope.fileType = function(file) {
                     if(angular.isString(file.file_ext))
                        return file.file_ext.substr(1, 3);  // 3 because 'docx' => 'doc'
                     else
                        return ABSENT_FILE_EXT;
                  };
                  $scope.canEdit = $attr.canEdit !== undefined;
                  $scope.canDownload = $attr.canDownload !== undefined;
                  $scope.remove = function(index) {
                     helper.removeElement($scope.list, index);
                  }
               }
            }
         });
   }
)();
