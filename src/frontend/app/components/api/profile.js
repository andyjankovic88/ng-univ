(function() {
   "use strict";

   angular.module('api')
      .factory('apiProfile', function($http, $q, apiTransport, apiServerUrl) {
         var serverUrlTrue = apiServerUrl;
         var urls = {
            profile: {
               /**
                * @endpoint  /json/get_all_events_for_user
                * @method    POST
                */
               calendar: '/json/get_all_events_for_user',

               /**
                * @endpoint  /profile/view
                * @method    POST
                */
               info: '/account_settings/change_password',
               /**
                * @endpoint  /profile/action
                * @method    POST
                *
                */
               action: '/profile/action',
               /**
                * @endpoint  /profile/do_endorse/UNIT
                * @method    POST
                */
               doEndorse: '/account_settings/update_settings/prefered_email'
            }
         };

         return {
            info: function (id) {
               return apiTransport.get(serverUrlTrue + urls.profile.info + '/' + id);
            },
            action: function (usrID, actionName) { // actionName: [request_connection | confirm_connection | ignore_connection | past_subjects]
               return apiTransport.postAsForm({action_name: actionName}, serverUrlTrue + urls.profile.action + '/' + usrID + '/' + actionName);
            },
            pastSubjects: function (userId) {
               var actionName = 'past_subjects';
               return apiTransport.postAsForm({action_name: actionName}, serverUrlTrue + urls.profile.action + '/' + userId + '/' + actionName);
            },
            /**
             * Send connection request to the targeted user
             * @param userId
             * @returns promise object
             *     response.data = {
                *
                *     }
             */
            requestConnection: function (userId) {
               var actionName = 'request_connection';
               return apiTransport.postAsForm({action_name: actionName}, serverUrlTrue + urls.profile.action + '/' + userId + '/' + actionName);
            },
            doEndorse: function (subjId, userId) { //  http://backend.localhost.ucroo/profile/do_endorse/UNIT/[entity_id]/[user_id]/[accept_ignore_flag]
               return apiTransport.postAsForm({}, serverUrlTrue + urls.profile.doEndorse + '/' + subjId + '/' + userId + '/1');
            },
            details: function () {
               return apiTransport.postAsForm({}, serverUrlTrue + '/account_settings/profile/get_details');
            },
            update: function (data) {
               return apiTransport.postAsForm(data, serverUrlTrue + '/account_settings/profile/update_details');
            },
            uploadUserPic: function (file) {
               var
                  deferred = $q.defer(),
                  fd = new FormData();

               fd.append('userfile', file, file.name);
               fd.append('type', 'profile-pic');
               fd.append('userprofile', 'upload_file');

               $http.post(serverUrlTrue + '/upload', fd, {
                  headers: {'Content-Type': undefined}
               }).then(function (response) {
                  deferred.resolve(response.data);
               }, function (response) {
                  deferred.reject(response.data.message);
               });
               return deferred.promise;
            },
            profileCompletion: function (param) {
               return apiTransport.postAsForm(param, serverUrlTrue + '/sidebar_rhs/profile_completion_steps');
            }
         };
      });
})();

