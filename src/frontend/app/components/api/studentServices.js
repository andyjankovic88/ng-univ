(function() {
   "use strict";

   // The api ticket is
   // https://ucroo.unfuddle.com/a#/projects/1/tickets/by_number/5755

   angular.module('api')
      .factory('apiStudentServices', function(apiTransport, apiServerUrl, $q, $http) {
         return {
            /**
             * Create a study group
             * Endpoint : POST /servicepage/addedit
             *
             * @param serviceInfo
             * @returns {*}
             */
            create: function(serviceInfo) {
               return apiTransport.postAsForm(serviceInfo, apiServerUrl + '/servicepage/addedit');
            },
            /**
             * Edit group detail
             * Endpoint : POST /servicepage/addedit/:service_id
             * @param serviceInfo
             * @param serviceID
             * @returns {*}
             */
            edit: function(serviceInfo, serviceID) {
               return apiTransport.postAsForm(serviceInfo, apiServerUrl + '/servicepage/addedit/' + serviceID);
            },
            /**
             * API 4: Student Services View
             * API End Point: /servicepage/view_details/[service_id]
             * API Request Type: GET
             * URL param details:
             * [service_id] (int) - Required
             */
            get: function(serviceID) {
               return apiTransport.get(apiServerUrl + '/servicepage/view_details/' + serviceID);
            },
            /**
             * End Point : GET /servicepage/addedit_form_details
             * @returns {*}
             */
            getInitialData: function(serviceID) {
               if (serviceID) {
                  return apiTransport.get(apiServerUrl + '/servicepage/addedit_form_details/' + serviceID);
               } else {
                  return apiTransport.get(apiServerUrl + '/servicepage/addedit_form_details');
               }
            },
            /**
             * Get group detail
             * Endpoint : GET /groups/get_studygroup_details:group_id
             * @param groupID
             * @returns {*}
             */
            getFollowers: function(serviceID) {
               return apiTransport.get(apiServerUrl + '/servicepage/followers/' + serviceID);
            },
            /**
             * Get study group list
             * Endpoint : POST /groups/all_studygroups:user_id:page_offset
             * Post Param : optional 1. search_term ( string, optional )
             * @param id, offset, postData
             * @returns {*}
             */
            list: function() {
               return apiTransport.get(apiServerUrl + '/servicepage/listing');
            },
            /**
             * Get student service suggestion list
             * Endpoint : POST /groups/suggested_studygroups:user_id:page_offset
             * Post Param : optional 1. search_term ( string, optional )
             * @param id, offset, postData
             * @returns {*}
             */
            suggestions: function () {
               return apiTransport.get(apiServerUrl + '/servicepage/suggested');
            },
            /**
             * API: Student Services Follow
             * API End Point: /servicepage/follow/[service_id]
             * API Request Type: POST
             * URL param details:
             *    [service_id] (int) - Required
             */
            follow: function(serviceID) {
               return apiTransport.postAsForm({}, apiServerUrl + '/servicepage/follow/' + serviceID);
            },
            /**
             * API: Student Services UnFollow
             * API End Point: /servicepage/unfollow/[service_id]
             * API Request Type: POST
             * URL param details:
             *    [service_id] (int) - Required
             */
            unfollow: function(serviceID) {
               return apiTransport.postAsForm({}, apiServerUrl + '/servicepage/unfollow/' + serviceID);
            }


         };

      });
})();
