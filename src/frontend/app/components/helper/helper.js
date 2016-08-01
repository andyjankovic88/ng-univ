(function () {
   "use strict";

   angular.module('helper', [])
      .factory('helper', function () {
         return {
            findById: function (arr, key, val) {
               var ind = 0;

               if (!arr) {
                  return -1;
               }
               while ((ind < arr.length) && (arr[ind][key] !== val)) {
                  ind++;
               }
               return ind < arr.length ? ind : -1;
            },
            removeElement: function (array, index) {
               if (index > -1) {
                  array.splice(index, 1);
               }
               return index;
            },
            getList: function (list, key, filterKey) {
               var values = [];
               angular.forEach(list, function (item) {
                  if(!item[filterKey] && !item[filterKey]) {
                     return;
                  }
                  values.push(item[key]);
               });
               return values;
            }
         };
      });

})();
