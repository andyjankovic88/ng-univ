/**
 * Created by Andri on 04/12/2015.
 */
(function() {
   'use strict';

   angular
      .module('club')
      .config(function($stateProvider) {
         $stateProvider
            .state('club', {
               url: '/club/:id',
               templateUrl: '/app/main/clubsSocieties/club/club.html',
               controller: 'clubCtrl',
               parent: 'main',
               params: {
                  id: '',
                  paypalResult: ''
               }
            });
      });


})();
