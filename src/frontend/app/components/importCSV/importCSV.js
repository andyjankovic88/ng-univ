(function () {

   'use strict';

   angular.module('importCSV', [])
      .directive('importCsv', function (apiService, ngDialog, alerts) {
         return {
            restrict: 'E',
            scope: {
               files: '=',
               type: '@'
            },
            templateUrl: '/app/components/importCSV/importCSV.html',
            link: function (scope) {
               scope.importEmailsList = function () {
                  ngDialog.open({
                     template: '/app/components/dialogTemplates/importEmailList.html',
                     scope: scope,
                     className: 'ngdialog-theme-default import-email-list'
                  });
               };

               scope.files = [];
               scope.clearFiles = function () {
                  scope.files = '';
               };
               scope.importCSV = function (file) {
                  if (file) {
                     apiService.uploadCSV(file, scope.type).then(
                        function (response) {
                           if (file) {
                              scope.files.push(response.file_id);
                           }
                        },
                        function (error) {
                           console.log(error);
                           alerts.warning(error);
                        });
                  }
               };
            }
         };
      });

})();