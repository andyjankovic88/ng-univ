(function () {
   'use strict';

   angular.module('api', [])
      .factory('apiService', function($http, $q, Upload, apiServerUrl, apiTransport,
            apiMentorGroups,
            apiMessages,
            apiFeeds,
            apiCustomGroups,
            apiStudyGroups,
            apiStudentServices,
            apiAccounts,
            apiMarketplace,
            apiClubs,
            apiCommon,
            apiFirstSteps,
            apiGlobalSearch
            ) {

         //var serverUrl = '/assets_new/api';
         var serverUrlTrue = apiServerUrl;


         var urls = {
            universities: '/universities',
            login: '/user_login',
            passwordRecovery: '/forgot_password/',
            resetPassword: '/general/reset_password',
            sidebarRHS: '/sidebar_rhs/general',
            courses: '/general/courses',
            campuses: '/general/campuses',
            faculties: '/general/faculty/',
            singupdata: '/general/get_signup_data',
            signup: '/signup/signup',
            deleteAccount: '/account_settings/delete_account',
            profile: {
               calendar: ' /json/get_all_events_for_user',
               info: '/profile/view',
               action: '/profile/action',
               doEndorse: '/profile/do_endorse/UNIT'
            },
            ucrooNews: {
               get: '/feeds/list/university_rss'

            },
            feeds: {
               comments: {
                  get: '/feeds/posts/',                     // /feeds/posts/:post_id/comments[/page/1]
                  // /feeds/comments/:feed_post_id/add
                  // /feeds/comments/:comment_id/edit
                  // /feeds/comments/:comment_id/delete
                  comments: '/feeds/comments/'

               }
            },
            connections: {
               suggested: {
                  get: '/connections/suggested_connection',  // GET /suggested_connection/:num_of_records(int)
                  filter: '/connections/filter_connections' // POST /filter_connections - search_term - string - filtert_term - array
               },
               connect: '/connections/connect/connectuser', // POST /connections/connect:action Following Param Required 1. user_id_1 2. user_id_2
               accept: '/connections/connect/accept',
               block: '/connections/connect/block',
               get: '/connections/myconnections',   // GET /connections/myconnections:user_id3:pagination
               close_connection: '/connections/removeconnection/', // GET /connections/removeconnection:user_id
               filter_categories: '/connections/filter_categories',
               connection_requests: '/connections/myconnections_requests/'
            },
         };



         var ApiService = {
            getUniversities: function () {
               return apiTransport.get(serverUrlTrue + urls.universities, true);
            },
            getMyInfo: function () {
               return apiTransport.get(serverUrlTrue + urls.profile.info + '/1');
            },
            login: function (login, pass) {
               return apiTransport.postAsForm({
                     email: login,
                     password: pass
                  },
                  serverUrlTrue + urls.login
               );
            },
            fbLogin: function (facebookID, facebookToken) {
               return apiTransport.postAsForm({
                     facebook_id: facebookID,
                     facebook_access_token: facebookToken
                  },
                  serverUrlTrue + urls.login
               );
            },
            sendPasswordRecoveryRequest: function (email) {
               return apiTransport.postAsForm({
                     email: email
                  },
                  serverUrlTrue + urls.passwordRecovery
               );
            },
            resetPassword: function (resetToken, newPwd, newPwdConfirm) {
               return apiTransport.postAsForm({
                     'code': resetToken,
                     'new': newPwd,
                     'new_confirm': newPwdConfirm
                  },
                  serverUrlTrue + urls.resetPassword
               );
            },
            marketplace: apiMarketplace,
            globalSearch: apiGlobalSearch,
            getRHS: function () {
               var
                  cacheKey = 'rhs';

               return apiTransport.concurrentCachedGet(cacheKey, serverUrlTrue + urls.sidebarRHS, 'POST', {blocks: "at_university,suggested_connection"});

            },
            getSpecificRHS: function (type, id) {
               var id = id ? id : '';
               return apiTransport.postAsForm({}, serverUrlTrue + '/sidebar_rhs/group_specific/' + type + '/' + id);
            },
            clubs: apiClubs,
            getCourses: function (univID) {
               if (!univID) {
                  console.log('Warning! wrong univID in [apiService.getCourses]');
               }
               return apiTransport.get(serverUrlTrue + urls.courses + '/' + univID);
            },
            getCampuses: function (univID) {
               if (!univID) {
                  console.log('Warning! wrong univID in [apiService.getCampuses]');
               }

               return apiTransport.get(serverUrlTrue + urls.campuses + '/' + univID);
            },
            getFaculties: function (univID) {
               if (!univID) {
                  console.log('Warning! wrong univID in [apiService.getCampuses]');
               }

               return apiTransport.get(serverUrlTrue + urls.faculties + univID);
            },
            /**
             *  {
             *  'email'
             *  'secondary_email'
             *  'password'
             *  'university_id'
             *  'campus_id'
             *  'course_id'
             *  'first_name'
             *  'last_name'
             *  'gender'
             *  'start_year'
             *  'completion_year'
             *  'international'
             *  'faculty_id'
             *  }
             */
            signup: function (formData) {
               return apiTransport.postAsFormPureRes(formData, serverUrlTrue + urls.signup);
            },
            getSignupData: function (uniqueID) {
               return apiTransport.postAsForm({ token: uniqueID}, serverUrlTrue + urls.singupdata);
            },
            deleteAccount: function () {
               return apiTransport.postAsFormPureRes({}, serverUrlTrue + urls.deleteAccount);
            },
            timer: {
               start: function (subjectId) {
                  return apiTransport.postAsForm({
                     unit_selected: subjectId
                  }, serverUrlTrue + '/study_timer/start');

               },
               stop: function (subjectId) {
                  return apiTransport.postAsForm({
                     unit_selected: subjectId
                  }, serverUrlTrue + '/study_timer/stop');
               },
               getGraphData: function(fromDate, toDate) {
                  return apiTransport.postAsForm({from_date: fromDate, to_date: toDate}, serverUrlTrue + '/study_timer/study_graph');
                     // return apiTransport.get(serverUrl + '/graph');
               },
               getTimes: function() {
                  return apiTransport.get(serverUrlTrue + '/study_timer/time_select_list');
               },
               addSession: function(data) {
                  return apiTransport.postAsForm(data, serverUrlTrue + '/study_timer/study_session_add');
               },
               getList: function (page) {
                  var page = page ? page : 1;
                  return apiTransport.get(serverUrlTrue + '/study_timer/study_session_list/' + page);
               },
               removeSession: function (id) {
                  return apiTransport.postAsForm({study_log_id: id}, serverUrlTrue + '/study_timer/study_session_delete');
               }
            },
            profile: {
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
               }

            },
            ucrooNews: {
               get: function (universityId, postId) {
                  postId = postId ? '/' + postId : '';
                  return apiTransport.postAsForm({}, serverUrlTrue + urls.ucrooNews.get + '/' + universityId + postId);
               }
            },
            messages: apiMessages,
            mentorGroups: apiMentorGroups,
            comments: {
               get: function (feedType, objectId, postId) { // /feeds/posts/:post_id/comments[/page/1]
                  return apiTransport.postAsForm({
                     object_type: feedType,
                     object_id: objectId
                  }, serverUrlTrue + urls.feeds.comments.get + postId + '/comments');
               },
               edit: function (feedType, objectId, commentId, text) { //// /feeds/comments/:comment_id/edit
                  return apiTransport.postAsForm({
                     object_type: feedType,
                     object_id: objectId,
                     text: text
                  }, serverUrlTrue + urls.feeds.comments.comments + commentId + '/edit');
               },
               add: function (feedType, objectId, postId, text) {
                  return apiTransport.postAsForm({
                     text: text,
                     object_type: feedType,
                     object_id: objectId
                  }, serverUrlTrue + '/' + urls.feeds.comments.comments + postId + '/add');
               },
               delete: function (feedType, objectId, commentId) { // /feeds/comments/:comment_id/delete
                  return apiTransport.postAsForm({
                     object_type: feedType,
                     object_id: objectId
                  }, serverUrlTrue + urls.feeds.comments.comments + commentId + '/delete');
               }
            },
            feeds: apiFeeds,
            customGroups: apiCustomGroups,
            studyGroups: apiStudyGroups,
            studentServices: apiStudentServices,
            events: {
               getEvents: function (type, id) {
                  if (type === "club") {
                     return apiTransport.get(serverUrlTrue + '/club/events/' + id);
                  }
                  if (type === "servicepage") {
                     return apiTransport.get(serverUrlTrue +'/'+ type + '/event_lists/' + id);
                  }
                  return apiTransport.get(serverUrlTrue + '/ucroo_events/listing/' + type + '/' + id);
               },
               getEvent: function (type, id) {
                  if (type === "club") {
                     return apiTransport.get(serverUrlTrue + '/' + type +'/event_view/' + id);
                  }
                  if (type === "servicepage") {
                     return apiTransport.get(serverUrlTrue + '/' + type +'/event_view/' + id);
                  }
                  return apiTransport.get(serverUrlTrue + '/ucroo_events/view/' + type + '/' + id);
                //  GET /servicepage/event_view/:event_id               wait for add
               },
               joinEvent: function(type, groupID, eventID) {
                  if (type === 'servicepage') {
                     eventID = groupID;
                     return apiTransport.postAsForm({}, serverUrlTrue + '/' + type + '/event_join/' + eventID);
                  }
                  return apiTransport.get(serverUrlTrue + '/ucroo_events/join/' + type + '/' + groupID + '/' + eventID);
               },
               leaveEvent: function(type, groupID, eventID) {
                  if (type === 'servicepage') {
                     eventID = groupID;
                     return apiTransport.postAsForm({}, serverUrlTrue + '/servicepage/event_leave/' + eventID);
                  }
                  return apiTransport.get(serverUrlTrue + '/ucroo_events/leave/' + type + '/' + groupID + '/' + eventID);
               },
               createNewEvent: function (group_type, group_id, data){

                  var deferred = $q.defer(),
                     fd = new FormData();

                  angular.forEach(data, function(val, key) {
                     if ($.isArray(val)) {
                        angular.forEach(val, function(_val) {
                           fd.append(key + "[]", _val);
                        });
                     } else {
                        fd.append(key, val);
                     }

                  });

                  var link_upload = '';
                  if (group_type === "club") {
                     link_upload = '/club/event_edit/' + group_id
                  } else
                  if(group_type === "servicepage"){
                     link_upload = '/' + group_type + '/event_addedit/' + group_id
                  } else
                  link_upload = '/ucroo_events/action/' + group_type + '/' + group_id +'/new';


                  $http.post(apiServerUrl + link_upload, fd, {
                     headers: {
                        'Content-Type': undefined
                     }
                  }).then(function(response) {
                     deferred.resolve(response.data.response);
                  }, function(response) {
                     deferred.reject(response.data.message);
                  });
                  return deferred.promise;
               },
               getData: function(uni_id){
                  return apiTransport.postAsForm({}, serverUrlTrue + '/ucroo_events/action/university/'+ uni_id +'/new');
               },
               editEvent: function(type, groupID, eventID, new_event){
                  if(type === "club"){
                     return apiTransport.postAsForm(new_event, serverUrlTrue + '/'+ type+ '/' + groupID + '/edit/' + eventID);
                  }
                  if(type === "servicepage"){
                     return apiTransport.postAsForm(new_event, serverUrlTrue + '/'+ type+ '/event_addedit/' + groupID + '/' + eventID);
                  }
                  return apiTransport.postAsForm(new_event, serverUrlTrue + '/ucroo_events/action/'+ type+ '/' + groupID + '/edit/' + eventID);
               },
               deleteEvent: function(type, groupID, eventID){
                  if(type === "servicepage"){
                     return apiTransport.get(serverUrlTrue + '/'+ type+ '/event_delete/' + eventID);
                  }
                  return apiTransport.get(serverUrlTrue + '/ucroo_events/delete/'+ type+ '/' + groupID + '/' + eventID);
               },
               getAllEvents: function(){
                  return apiTransport.get(serverUrlTrue + '/club/events');
               }


            },
            subjects: {
               getList: function() {
                  return apiTransport.get(serverUrlTrue + '/subject/get_enrolled');
               },
               search: function(keywords) {

                  var httpTimeout = $q.defer();

                  var promise = $http({
                     method: 'POST',
                     url: serverUrlTrue + '/subject/search_not_enrolled/1',
                     data: $.param({search_term: keywords}),
                     timeout: httpTimeout.promise,
                     headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                     }
                  }).then(
                     function (response) {
                        return response.data.response;
                     }
                  );

                  promise._httpTimeout = httpTimeout;

                  return promise;
               },
               getSuggestions: function() {
                  return apiTransport.post(null, serverUrlTrue + '/subject/suggested');
               },
               cancel: function(promise) {
                  if (promise && promise._httpTimeout && promise._httpTimeout.resolve ) {
                     promise._httpTimeout.resolve();
                 }
               },
               enrollSubjects: function (data, userID) {
                  return apiTransport.postAsForm({subject_ids: data}, serverUrlTrue + '/subject/enrol_multiple/' + userID);
               },
               details: function(id) {
//                  return apiTransport.get(serverUrl + '/subject_details');
                  return apiTransport.get(serverUrlTrue + '/subject/setup_details/' + id);
               },
               setup: function(data, id) {
                  var deferred = $q.defer(),
                     fd = new FormData();

                  angular.forEach(data, function (val, key) {
                     if ($.isArray(val)) {
                        angular.forEach(val, function(_val){
                           fd.append(key + "[]", _val);
                        });
                     } else {
                        fd.append(key, val);
                     }

                  });

                  $http.post(serverUrlTrue + '/subject/setup/' + id, fd, {
                     headers: {'Content-Type': undefined}
                  }).then(function (response) {
                     deferred.resolve(response.data.response);
                  }, function (response) {
                     deferred.reject(response.data.message);
                  });
                  return deferred.promise;
               },
               leave: function (id) {
                  return apiTransport.postAsForm({}, serverUrlTrue + '/subject/unenrol/' + id);
               }

            },
            connections: {
               getList: function (user, page) {
                  return apiTransport.get(serverUrlTrue + urls.connections.get + '/' + user + '/' + page);
               },
               getSuggestions: function (numOfRecords) {
                  if (!isNaN(numOfRecords)) {
                     return apiTransport.get(serverUrlTrue + urls.connections.suggested.get + '/' + numOfRecords);
                  } else {
                     return apiTransport.get(serverUrlTrue + urls.connections.suggested.get);
                  }
               },
               /**
               * @params
               *      filter : Object { search_term: '', filtert_term: [] }
               **/
               getSuggestionsFilter: function (filter) {
                  return apiTransport.postAsForm(filter, serverUrlTrue + urls.connections.suggested.filter);
               },
               connect: function (me, follower) {
                  return apiTransport.postAsForm({user_id_1: me, user_id_2: follower},serverUrlTrue + urls.connections.connect);
               },
               accept: function(me, follower) {
                  return apiTransport.postAsForm({user_id_1: me, user_id_2: follower},serverUrlTrue + urls.connections.accept);
               },
               block: function(me, follower) {
                  return apiTransport.postAsForm({user_id_1: me, user_id_2: follower},serverUrlTrue + urls.connections.block);
               },
               myconnections: function(group) {
                  return apiTransport.get(serverUrlTrue + urls.connections.get);
               },
               requests: function (currentUserID) {
                  return apiTransport.get(serverUrlTrue + urls.connections.connection_requests + currentUserID);
               },
               filter_categories: function () {
                  return apiTransport.get(serverUrlTrue + urls.connections.filter_categories);
               },
               close_connection: function (follower) {
                  return apiTransport.get(serverUrlTrue + urls.connections.close_connection + follower);
               }
            },
            uploadCSV: function(file, type) {
               var
                  deferred = $q.defer(),
                  fd = new FormData();


                  fd.append('userfile', file, file.name);

               $http.post(serverUrlTrue + '/' + type + '/import_members', fd, {
                  headers: {'Content-Type': undefined}
               }).then(function (response) {
                  deferred.resolve(response.data.response);
               }, function (response) {
                  deferred.reject(response.data.message);
               });
               return deferred.promise;
            },
            account: apiAccounts,
            common: apiCommon,
            calendar: {
               getSetupInfo: function() {
                  return apiTransport.get(serverUrlTrue + '/calendar/university_calendar_setup');
               },
               getClassTimes: function (id) {
                  return apiTransport.get(serverUrlTrue + '/calendar/class_timings/' + id);
               },
               addEvent: function(data) {
                  var deferred = $q.defer(),
                     fd = new FormData();

                  angular.forEach(data, function (val, key) {
                     if ($.isArray(val)) {
                        angular.forEach(val, function(_val){
                           fd.append(key + "[]", _val);
                        });
                     } else {
                        fd.append(key, val);
                     }

                  });

                  $http.post(serverUrlTrue + '/calendar/university_calendar_setup', fd, {
                     headers: {'Content-Type': undefined}
                  }).then(function (response) {
                     deferred.resolve(response.data.message);
                  }, function (response) {
                     deferred.reject(response.data.message);
                  });
                  return deferred.promise;
               },
               removeEvent: function (id) {
                  return apiTransport.get(serverUrlTrue + '/calendar/remove_calendar_event/' + id);
               },
               uploadICS: function(file) {
                  var
                     deferred = $q.defer(),
                     fd = new FormData();


                     fd.append('file_ics', file, file.name);

                  $http.post(serverUrlTrue + '/calendar/university_calendar_ics', fd, {
                     headers: {'Content-Type': undefined}
                  }).then(function (response) {
                     deferred.resolve(response.data.message);
                  }, function (response) {
                     deferred.reject(response.data.message);
                  });
                  return deferred.promise;
               }
            },
            recentActivity: {
               getList: function (page) {
                  return apiTransport.get(serverUrlTrue + '/activity/list/?page=' + page);
               }
            },
            notifications: {
               getList: function () {
                  return apiTransport.get(serverUrlTrue + '/notification/list/');
               },
               remove: function (id) {
                  return apiTransport.get(serverUrlTrue + '/notification/delete/' + id);
               }
            },
            firstSteps: apiFirstSteps
         };

         return ApiService;

      });


})();
