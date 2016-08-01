(function() {
    'use strict';

    angular.module('passwordsMatch', [])
        .directive('passwordsMatch', function() {
            return {
                require: 'ngModel',
                link: function(scope, elem, attrs, ctrl) {

                    var me = attrs.ngModel;
                    var matchTo = attrs.passwordsMatch;


                    scope.$watch(me, function(value) {
                        ctrl.$setValidity('pwmatch', scope[me] === scope[matchTo]);
                    });
                    scope.$watch(matchTo, function(value) {
                        ctrl.$setValidity('pwmatch', scope[me] === scope[matchTo]);
                    });


                }
            };
        });
})();
