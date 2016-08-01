(function() {
   'use strict';

   angular
      .module('subjects')
      .config(function($stateProvider) {
         $stateProvider
            .state('addSubject', {
               url: '/add-subjects',
               templateUrl: '/app/main/subjects/addSubject/addSubject.html',
               controller: 'addSubjectCtrl',
               parent: 'main'
            });
      });

})();
