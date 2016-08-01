(function() {
   "use strict";

   angular.module('api')
      .factory('apiAccounts', function($http, $q, apiTransport, apiServerUrl) {

         var urls = {
            settings: {
               /**
                * @endpoint  /json/search_users/
                * @method    POST
                * @Params:
                */
               get: '/account_settings/get_settings/',

               /**
                * @endpoint  /account_settings/change_password
                * @method    POST
                * @Params:
                * {
                *     "oldPass": "ucroo123",
                *     "newPass": "ucroo321",
                *     "repeatNewPass": "ucroo321"
                * }
                */
               change_password: '/account_settings/change_password',
               privacy: {
                  /**
                   * @endpoint  /account_settings/update_settings/privacy_settings
                   * @method    POST
                   * @Params:
                   * {
                   *     "user_permissions": {
                   *     "122": "everyone",
                   *     "123": "everyone",
                   *     "124": "everyone",
                   *     "125": "everyone",
                   *     "126": "connections",
                   *     "127": "connections",
                   *     "131": "everyone",
                   *     "132": "everyone",
                   *     "133": "everyone",
                   *     "134": "everyone"
                   *     }
                   * }
                   */
                  update: '/account_settings/update_settings/privacy_settings'
               },
               email_notification: {
                  /**
                   * @endpoint  /account_settings/update_settings/email_notification
                   * @method    POST
                   * @Params:
                   * {
                   *     "feeds": 0,
                   *     "messages": 1,
                   *     "ratings": 1,
                   *     "connections": 0,
                   *     "daily_schedule": 1,
                   *     "clubs": 0,
                   *     "study_groups": 1,
                   *     "classes": 1,
                   *     "service_page": 1,
                   *     "mentors": 1,
                   *     "customgroups": 0
                   * }
                   */
                  update: '/account_settings/update_settings/email_notification'
               },
               preferred_email: {
                  /**
                   * @endpoint  /account_settings/update_settings/prefered_email
                   * @method    POST
                   * @Params:
                   * {
                   *   "prefered_email": 1
                   * }
                   */
                  update: '/account_settings/update_settings/prefered_email'
               },
               block_users: {
                  /**
                   * @endpoint  /account_settings/update_settings/block_users/add
                   * @method    POST
                   * @Params:
                   * {
                   *   "user_ids": {
                   *     "0": 22,
                   *     "1": 25,
                   *     "2": 31
                   *   }
                   * }
                   */
                  add: '/account_settings/update_settings/block_users/add',

                  /**
                   * @endpoint  /account_settings/update_settings/block_users/delete
                   * @method    POST
                   * @Params:
                   * {
                   *    "auto_user_id": 22 // auto_id
                   * }
                   */
                  delete: '/account_settings/update_settings/block_users/delete'
               }
            }
         };

         return {
            settings: {
               get: function () {
                  return apiTransport.get(apiServerUrl + urls.settings.get);
               },
               changePassword: function (oldPassword, newPassword, repeatNewPass) {
                  return apiTransport.postAsForm({
                     "oldPass": oldPassword,
                     "newPass": newPassword,
                     "repeatNewPass": repeatNewPass
                  }, apiServerUrl + urls.settings.change_password);
               },
               updatePrivacy: function (params) {
                  return apiTransport.postAsForm(params, apiServerUrl + urls.settings.privacy.update);
               },
               updateEmailNotification: function (params) {
                  return apiTransport.postAsForm(params, apiServerUrl + urls.settings.email_notification.update);
               },
               updatePreferredEmail: function (email) {
                  return apiTransport.postAsForm({prefered_email: email}, apiServerUrl + urls.settings.preferred_email.update);
               },
               blockUser: function (userID) {
                  return apiTransport.postAsForm({
                     'user_ids': { '0': userID}
                  }, apiServerUrl + urls.settings.block_users.add);
               },
               unblockUser: function (userID) {
                  return apiTransport.postAsForm({
                     'auto_user_id': userID
                  }, apiServerUrl + urls.settings.block_users.delete);
               }
            }
         };
      });
})();

