( function() {

    'use strict';

    angular.module('footer', [])
        .directive('footer', function() {
            return {
                restrict: 'E',
                scope: {

                },
                templateUrl: '/app/components/footer/footer.html',
                link: function() {

                }

            };
        });


}) ();
