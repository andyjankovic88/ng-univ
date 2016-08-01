(function () {

   'use strict';

   angular.module('selectUser', [])
      .directive('selectUser', function (apiService, userService, alerts) {
         return {
            restrict: 'E',
            scope: {
               initialUser: '=?',
               selectedUsers: '=',
               placeholder: '@'
            },
            templateUrl: '/app/components/selectUsers/selectUsers.html',
            link: function (scope, element, attrs) {
               scope.connections = [];
               scope.search = {};
               var currentUserID = userService.getInfo().id;
               apiService.connections.myconnections().then(function (response) {
                     scope.connections = response;
                     if(scope.initialUser){
                        addInitialUser(scope.initialUser);
                     }
                  },
                  function () {
                     alerts.warning("Please reload page or try again later");
                  });

               scope.selectedUsers = [];
               scope.addUser = function (user) {
                  if (user && !~scope.selectedUsers.indexOf(user)) {
                     scope.selectedUsers.push(user)
                  };
               };
               scope.removeUser = function (user) {
                  var index = scope.selectedUsers.indexOf(user);
                  scope.selectedUsers.splice(index, 1);
               };

               function addInitialUser(initial_user_id) {
                  var initial_user = {};
                  angular.forEach(scope.connections, function (item) {
                     if (item['user_id'] == initial_user_id){
                        initial_user = item;
                     }
                  });
                  scope.addUser(initial_user);
               }


            }
         };
      });

})();
