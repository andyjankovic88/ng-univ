(function() {
   'use strict';

   angular
      .module('studyTimer')
      .controller('graphCtrl', function($scope, apiService) {
         $scope.from = moment().startOf('week').format('YYYY-MM-DD');
         $scope.to = moment().endOf('week').format('YYYY-MM-DD');
         $scope.rangeFrom = $scope.from;
         $scope.rangeTo = $scope.to;

         $scope.chartConfig = {
            options: {
               chart: {
                  type: 'column'
               },
               tooltip: {
                  headerFormat: '<b>{series.name}</b><br/>',
                  pointFormat: '{point.x: %A,%b %e,%Y}. {point.y}h',
                  backgroundColor: 'rgba(31, 35, 50, 0.8)',
                  borderColor: 'rgba(31, 35, 50, 0.8)',
                  style: {
                     color: '#ffffff'
                  }
               },
               colors: ['#a8db84', '#ff4062', '#fe9c98', '#749aa0', '#8fc7cf', '#bfedfd'],
               plotOptions: {
                  column: {
                     stacking: 'normal',
                     // colorByPoint: true,
                  }
               },
               legend: {
                  layout:  "vertical",
                  itemMarginBottom: 10,
                  padding: 30,
                  x: 10,
                  width: 470
               },
               title: {
                  text:''
               },
               exporting: {
                  enabled: false
               }
            },
            series: [],
            loading: false,
            //Configuration for the xAxis (optional). Currently only one x axis can be dynamically controlled.
            //properties currentMin and currentMax provided 2-way binding to the chart's maximum and minimum
            xAxis: {
               tickPixelInterval: 0,
               tickLength: 0,
               lineColor: '#e9e9e8',
               type: 'datetime',
               dateTimeLabelFormats: {
                  day: '%e of %b'
               },
               allowDecimals: false,
               labels: {
                  x: 0,
                  y: 20,
                  format: "{value:%d} {value:%b}",
                  style: {
                     color: '#5A5A5A',
                     fontSize: '12px'
                  },
                  align: 'center',
                  step: 1
               },
            },
            yAxis: {
               title: {
                  enabled: false
               },
               labels: {
                  style: {
                     color: '#5A5A5A',
                     fontSize: '12px'
                  }
               }
            },
            useHighStocks: false,
            func: function(chart) {
               //setup some logic for the chart
            }
         };

         updateData();


         $scope.test = {};
         $scope.test.start = moment().subtract(1, 'month');

         $scope.selectDays = function (attr, attrTo) {
            if (attr === "month") {
               $scope.from = moment().startOf('month').format('YYYY-MM-DD');
               $scope.to = moment().endOf('month').format('YYYY-MM-DD');
            }
            if (attr === "last_month") {
               $scope.from = moment().subtract(1, 'month').startOf('month').format('YYYY-MM-DD');
               $scope.to = moment().subtract(1, 'month').endOf('month').format('YYYY-MM-DD');

            }
            if (attr > 0) {
               $scope.from = moment().subtract(attr, 'days').format('YYYY-MM-DD');
               $scope.to = moment().format('YYYY-MM-DD');
            }
            if (moment.isMoment(attr) && moment.isMoment(attrTo)) {
               $scope.from = moment(attr).format('YYYY-MM-DD');
               $scope.to = moment(attrTo).format('YYYY-MM-DD');
            }

            $scope.$broadcast('hideDropdown');
            updateData();

         }
         $scope.cancel = function () {
            $scope.$broadcast('hideDropdown');
            $scope.rangeFrom = moment($scope.from);
            $scope.rangeTo = moment($scope.to);
         }
         $scope.$on('addedSession', function (event, data) {
            updateData();
         });

         function updateData() {
            console.log($scope.from, $scope.to);
            apiService.timer.getGraphData($scope.from, $scope.to).then(
               function(response) {
                  $scope.chartConfig.series = [];
                  angular.forEach(response, function(value, key) {
                     var dataArray = value.map(function(val, index) {
                        return val[1];
                     })
                     $scope.chartConfig.series.push({
                        name: key,
                        data: dataArray,
                        pointStart: value[0][0],
                        pointInterval: 24 * 36e5
                     });
                  });
               }
            );
         }
      });
})();
