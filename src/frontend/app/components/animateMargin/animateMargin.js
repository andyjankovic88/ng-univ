(function() {
    'use strict';

    angular.module('animateMargin', [])
        .animation('.animate-margin', [function() {
            return {
                enter: function(element, doneFn) {
                    var
                        animatingEl = element.find('div.animate-target'),
                        parentHeight = element.parent().height();


                    animatingEl.css('margin-top', '-' + parentHeight + 'px');
                    animatingEl.css('display', 'block');
                    $.Velocity(animatingEl, {
                        'margin-top': 0
                    }, {
                        duration: 300
                    });
                    $.Velocity(animatingEl, {
                        opacity: 1
                    }, {
                        duration: 300,
                        complete: doneFn
                    });

                },

                leave: function(element, doneFn) {
                    var
                        animatingEl = element.find('div.animate-target'),
                        parentHeight = element.parent().height();


                    $.Velocity(animatingEl, {
                        opacity: 0
                    }, {
                        duration: 300
                    });
                    $.Velocity(animatingEl, {
                        'margin-top': -parentHeight
                    }, {
                        duration: 300,
                        complete: doneFn
                    });

                }
            };
        }]);

})();
