/**
 * Created by Andri on 04/12/2015.
 */
(function() {
   'use strict';

   angular
      .module('studentServicesView')
      .config(function($stateProvider) {
         $stateProvider
            .state('studentServicesView', {
               url: '/:service_id',
               templateUrl: '/app/main/studentServices/group/group.html',
               controller: 'studentServicesViewCtrl',
               parent: 'studentServices'
            });
      });


})();
