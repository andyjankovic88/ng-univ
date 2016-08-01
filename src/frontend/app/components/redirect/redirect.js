(function () {
   "use strict";

   angular.module('redirect', [])
      .factory('redirect', function ($document) {


         var redirect = {
            post: function (url, data) {
               createFormPost(url, data);
            },
            get: function (url) {

            }
         };
         return redirect;

         function createFormPost(url, data) {
            var $form = angular.element('<form action="' + url + '" method="post" style="display: none"></form>');
            var $body = $document.find('body');

            $body.append($form);

            angular.forEach(data, function (val, key) {
               $form.append("<input type='hidden' name='" + key + "' value='" + val + "'>")
            });

            $form[0].submit();
         }

      });
})();
