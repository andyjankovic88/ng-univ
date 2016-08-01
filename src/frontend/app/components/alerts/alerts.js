(function () {
   'use strict';

   angular.module('alerts', [])
      .service('alerts', function (ngDialog) {
         var
            infoShow,
            infoHide;


         function alertsObject() {

            this.close = function() {
               if(angular.isFunction(infoHide)) {
                  infoHide();
               }
            };

         };

            this.warning = function (message) {
               return ngDialog.open({
                  template: '/app/components/alerts/templates/warning.html',
                  controller: ['$scope', function ($scope) {
                     $scope.msg = message;
                  }]
               });
            };
         this.modal = function (message) {
            return ngDialog.open({
               template: '<p>' + message + '</p>' +
               '<div class="ngdialog-buttons">' +
               '    <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="closeThisDialog(1)">OK</button>' +
               '</div>',
               plain: true,
               showClose: false
            });
         };
            this.confirm = function (message) {
               var nestedConfirmDialog = ngDialog.openConfirm({
                  template: '<p>' + message + '</p>' +
                  '<div class="ngdialog-buttons">' +
                  '    <button type="button" class="ngdialog-button ngdialog-button-secondary" ng-click="closeThisDialog(0)">No</button>' +
                  '    <button type="button" class="ngdialog-button ngdialog-button-primary" ng-click="confirm(1)">Yes</button>' +
                  '</div>',
                  plain: true
               });

               // NOTE: return the promise from openConfirm
               return nestedConfirmDialog;
            };
            this.info = function (message) {
               if (angular.isFunction(infoShow)) {
                  infoShow(message);
               }
               return new alertsObject();
            };
            this._registerInfoDirective = function (show, hide) {
               infoShow = show;
               infoHide = hide;
            };
      })
      .directive('alertsInfo', function (alerts) {
         return {
            restrict: 'E',
            scope: true,
            template: '<div class="alerts-info"><span class="message"></span><a class="dismiss" href="#" ng-click="hide()">Dismiss</a></div>',
            link: function ($scope, $elem) {
               var
                  CLASS_ACTIVE = 'active',
                  $container = $elem.children(),
                  $messageEl = $elem.find('.message');


               alerts._registerInfoDirective(show, hide);


               $scope.hide = hide;

               function show(message) {
                  $messageEl.text(message);
                  $container.addClass(CLASS_ACTIVE);
               }
               function hide() {
                  $container.removeClass(CLASS_ACTIVE);
                  $messageEl.text('');
               }


            }
         };
      });


})();
