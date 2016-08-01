(function() {
   "use strict";

   angular.module('api')
      .factory('apiCommon', function($http, $q, apiTransport, apiServerUrl) {

         var urls = {
            /**
             * @endpoint  /json/search_users/
             * @method    POST
             * @Params:
             * {
             *     "action": "search",
             *     "term": "mi",           // keyword input
             *     "except_ids": "3,21"    // comma separated user ids to exclude from result
             * }
             */
            searchUsers: '/json/search_users/',
            /**
             * API End Point: http://backend.localhost.ucroo/json/search_staff
             * API Request Type: POST
             * Request Post Data:
             * except_ids (comma-separated) e.g 2,1
             * term - (string)
             * action - (string) - value:search
             * @param formData
             * @returns {*}
             */
            staffMembers: '/json/search_staff'
         };

         return {
            searchUsers: function (searchTerm, exceptIDs) {
               return apiTransport.postAsForm({
                     action: 'search',
                     term: searchTerm,
                     except_ids: exceptIDs
                  },
                  apiServerUrl + urls.searchUsers);
            },

            getStaffMembers: function (exceptIDs, term, action) {
               return apiTransport.postAsForm({
                  except_ids: exceptIDs,
                  term: term,
                  action: 'search'
               }, apiServerUrl + urls.staffMembers);
            }
         };
      });
})();
