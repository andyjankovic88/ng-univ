(function() {
   'use strict';

   angular
      .module('subjects')
      .config(function($stateProvider) {
         $stateProvider
            .state('addSubjectAdmin', {
               url: '/add-subjects-admin/:id',
               templateUrl: '/app/main/subjects/addSubjectAdmin/addSubjectAdmin.html',
               controller: 'addSubjectAdminCtrl',
               parent: 'main',
               params: {
                  id: ''
               }
            });
      });

})();
