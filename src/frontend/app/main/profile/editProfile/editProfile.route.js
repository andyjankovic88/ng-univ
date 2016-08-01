(function() {
   'use strict';

   angular
      .module('editProfile')
      .config(function($stateProvider) {
         $stateProvider
            .state('editProfile', {
               url: '/editProfile',
               templateProvider: function($http, $templateCache, userService) {

                  var templateName = userService.getInfo().group_id == 2
                     ? "/app/main/profile/editProfile/editStudentProfile.html"
                     : "/app/main/profile/editProfile/editProfile.html"
                  ;


                  if ($templateCache.get(templateName)) {
                     return $templateCache.get(templateName);
                  }

                  return $http.get(templateName).then(
                     function(tpl){
                        return tpl.data;
                     }
                  );
               },
               controller: 'editProfileCtrl',
               parent: 'main'/*,
               data: {
                  permissions: {
                     only: ['student'],
                     redirectTo: 'profile.connections'
                  }
               }*/
            });
      });

})();
