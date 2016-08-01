(function () {
   'use strict';

   angular.module('dataShare', [])
      .factory('dataShareService', function ($http, $q, Upload) {
         var data = {
            connections: {
               searchString: ''
            },
            signup: {},
            account: {
               settings: {}
            },
            fnResetSignup : function () {
               data.signup = {
                  utoken: '',
                  university: '',
                  facebook: {
                     is_connected: false,
                     facebook_id: '',
                     facebook_access_token: ''
                  },
                  firstname: '',
                  lastname: '',
                  gender: '',
                  position: '',
                  university_email: '',
                  password: '',
                  confirm_password: '',
                  degree: '',
                  faculty: [],
                  campus: '',
                  course: '',
                  course_start: '',
                  course_end: '',
                  staff_type: ''
               };
            }
         };
         return data;
      });


})();
