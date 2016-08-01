(function() {
   "use strict";

   // The api ticket is
   // https://ucroo.unfuddle.com/a#/projects/1/tickets/by_number/5755

   angular.module('api')
      .factory('apiStudyGroups', function(apiTransport, apiServerUrl, $q, $http) {
         return {
            /**
             * Create a study group
             * Endpoint : POST /groups/create_study_group
             *
             * @param groupID
             * @returns {*}
             */
            create: function(groupInfo) {
               return apiTransport.postAsForm(groupInfo, apiServerUrl + '/groups/create_study_group');
            },
            /**
             * Get group detail
             * Endpoint : GET /groups/get_studygroup_details/:group_id
             * @param groupID
             * @returns {*}
             */
            get: function(groupID) {
               // return apiTransport.get(apiServerUrl + '/groups/get_studygroup_details/' + groupID);
               return $http({
                  method: 'GET',
                  url: apiServerUrl + '/groups/get_studygroup_details/' + groupID,
                  headers: {
                     'Content-Type': 'application/x-www-form-urlencoded'
                  }
               });
            },
            /**
             * Edit group detail
             * Endpoint : POST /groups/create_study_group/:group_id
             * @param groupID
             * @returns {*}
             */
            edit: function(groupInfo, groupID) {
               return apiTransport.postAsForm(groupInfo, apiServerUrl + '/groups/create_study_group/' + groupID);
            },
            getMembers: function () {
               // Get Study Group members
            },
            /**
             * Get study group list
             * Endpoint : POST /groups/all_studygroups:user_id:page_offset
             * Post Param : optional 1. search_term ( string, optional )
             * @param id, offset, postData
             * @returns {*}
             */
            list: function(id, offset, postData) {
               return apiTransport.postAsForm(postData ? postData : {}, apiServerUrl + '/groups/all_studygroups/' + id + '/' + offset);
            },
            /**
             * Get studygroup suggestion list
             * Endpoint : POST /groups/suggested_studygroups:user_id:page_offset
             * Post Param : optional 1. search_term ( string, optional )
             * @param id, offset, postData
             * @returns {*}
             */
            suggestions: function (id, offset, postData) {
               return apiTransport.postAsForm(postData ? postData : {}, apiServerUrl + '/groups/suggested_studygroups/' + id + '/' + offset);
            },
            /**
             * Delete Study Group
             * End Point : GET /groups/delete_group:group_id
             */
            delete: function(data, editID) {
               return apiTransport.get(apiServerUrl + '/groups/delete_group/' + id);
            },
            getInitialData: function() {
               return apiTransport.get(apiServerUrl + '/groups/create_study_group');
            },
            /**
             * Join study group
             * Endpoint : POST /groups/join/:group_id
             * @param groupID
             * @returns {*}
             */
            join: function(groupID) {
               return apiTransport.postAsForm({}, apiServerUrl + '/groups/join/' + groupID);
            },
            /**
             * Leave study Group
             * End Point : POST /groups/leave/:study_group_id
             * @param groupID
             * @returns {*}
             */
            leave: function(groupID) {
               return apiTransport.postAsForm({'study_group_id': groupID}, apiServerUrl + '/groups/leave');
            }


         };

      });
})();
