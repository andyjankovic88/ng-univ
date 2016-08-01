(function() {
    'use strict';

    angular.module('calendarTimeline', [])
        .directive('calendarTimeline', function($interval) {
            // Runs during compile
            return {
                restrict: 'A',
                link: function($scope, iElm, iAttrs, controller) {
                    var
                        template = '<div class="timeline"><div class="time"><span></span></div><div class="line"></div></div>',
                        lineEl,
                        timeGridEl,
                        hInterval,
                        minTime,
                        maxTime,
                        dayDuration,
                        isInitialyzed = false,
                        timeTextEl;


                    function addLine() {
                        if (!timeGridEl) {
                            return;
                        }
                        lineEl = $(template);
                        timeTextEl = lineEl.find('span').first();
                        timeGridEl.append(lineEl);
                    }

                    function removeLine() {
                        lineEl.remove();
                        lineEl = undefined;
                    }

                    function hide() {
                        lineEl.hide();
                    }

                    function show() {
                        lineEl.show();
                        timeTextEl.text(moment().format('hh:mm'));
                    }

                    function shift(shiftInPx) {                        
                        lineEl.css('top', shiftInPx - lineEl.height());
                    }

                    function init(view) {
                        if (!view) {
                            return;
                        }
                        minTime = view.timeGrid.minTime;
                        maxTime = view.timeGrid.maxTime;
                        dayDuration = (maxTime - minTime); // in milliseconds
                        if (!timeGridEl) {
                            timeGridEl = view.timeGrid.el.find('.fc-slats');
                        }
                        isInitialyzed = true;
                        hInterval = $interval(render, 60000); // 1 per minute
                    }

                    function render() {
                        var                            
                            height,
                            now;

                        
                        if(!isInitialyzed) {
                        	return;
                        }
                        
                        now = moment.duration(moment());

                        if (!lineEl) {
                            addLine();
                        }
                        
    					if((now < minTime) || (now > maxTime)) {
    						hide();
    						return;
    					}

                        show();

                        height = timeGridEl.height();
                        shift(Math.round(height / (dayDuration / (now - minTime))));
                    }


                    $scope.$on('calendarRendered', function(event, view) {
                    	init(view);
                        render();
                    });

                    $scope.$on('$destroy', function() {
                    	$interval.cancel(hInterval);
                        removeLine();
                    });

                }
            };
        });

})();
