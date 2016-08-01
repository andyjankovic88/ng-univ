(function () {
   'use strict';

   angular
      .module('ucroo')
      .constant('ignoreLogin', false)
      .constant('apiServerUrl', BACKEND_SERVER)
      .constant('userGroups',
         {
            admin: 1,
            student: 2,
            academic: 3,
            staff: 4,
            unadmin: 5
         });

})();
