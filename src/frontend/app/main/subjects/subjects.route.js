(function() {
   'use strict';

   angular
      .module('subjects')
      .config(function($stateProvider) {
         $stateProvider
            .state('subjects', {
               abstract: true,
               url: '/subjects',
               templateUrl: '/app/main/subjects/subjects.html',
               controller: 'subjectsCtrl',
               parent: 'main'
            });
      });

})();
