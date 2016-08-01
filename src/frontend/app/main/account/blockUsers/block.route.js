(function() {
   'use strict';

   angular
      .module('ucrAccountBlock')
      .config(function($stateProvider) {
         $stateProvider
            .state('ucrAccountBlock', {
               url: '/blockusers',
               templateUrl: '/app/main/account/blockUsers/block.html',
               controller: 'blockCtrl',
               parent: 'ucrAccount'
            });
      }).run(["$templateCache", function($templateCache) {
         $templateCache.put("typeahead-match-student.html",
            "<a ng-hide=\"match.model.isNoMatch\">" +
            "<figure class=\"img-holder\">" +
            "<img ng-show=\"match.model.photoUrl\" ng-src=\"{{match.model.photoUrl}}\" class=\"photo\" width=\"38\" height=\"38\">" +
            "<img ng-hide=\"match.model.photoUrl\" src=\"https://background.ucroo.com.au/assets_new/images/user/avatar_male_thumb.jpg\" width=\"38\">" +
            "</figure>" +
            "<div bind-html-unsafe=\"match.label | typeaheadHighlight:query\" class=\"typeahead-label\"></div>" +
            "</a>" +
            "<a ng-show=\"match.model.isNoMatch\" tabindex=\"-1\" bind-html-unsafe=\"match.label\"></a>");
      }]);


})();
