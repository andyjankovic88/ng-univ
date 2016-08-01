(function() {
   "use strict";

   angular.module('feedTypes')
      .directive('feedsFile', function($sce) {
         return {
            restrict: 'E',
            scope: {
               feed: '='
            },
            templateUrl: '/app/components/feedTypes/file/file.html',
            link: function($scope) {
               $scope.images = [];
               $scope.files = [];
               $scope.text = $sce.trustAsHtml($scope.feed.text);

               filterFiles($scope.feed.file_urls);

               function filterFiles(files) {
                  angular.forEach(files, function (file) {
                     file.file_ext = getExtention(file);
                     file.size = '80';
                     file.file_name = getName(file);
                     file.url = file.file;
                     if (file.type.indexOf('image/') === 0) {
                        $scope.images.push(file);
                     } else {
                        $scope.files.push(file);
                     }
                  });
               }
               function getExtention(file) {
                  return file.file.substr(file.file.lastIndexOf('.'));
               }
               function getName(file) {
                  return file.file.substr(file.file.lastIndexOf('/') + 1);
               }

            }
         }
      });
}
)();
