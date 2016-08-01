(function() {
   'use strict';

   angular
      .module('subjects')
      .config(function($stateProvider) {
         $stateProvider
            .state('subjectsList', {
               url: '/subjects-list',
               templateUrl: '/app/main/subjects/subjectsList/subjectsList.html',
               controller: 'subjectsListCtrl',
               parent: 'subjects'
            });
      });

})();
