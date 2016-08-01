(function() {
   'use strict';

   angular
      .module('marketplace')
      .controller('marketplaceItemCreateCtrl', function($scope, apiService, $stateParams, alerts, $state, helper) {
         var
            additionalData,
            loadedItem;


         $scope.item = {
            type: 1, // 1 - sell; 2 - want
            item_name: '',
            description: '',
            category_id: 0,
            price: 0,
            photo: ''

         };


         $scope.id = $stateParams.id;
         $scope.categories = [];
         $scope.selectedCategory = {
            category_name: "Select"
         };

         $scope.itemImage = '';

         if ($scope.id === 'sell') {
            $scope.item.type = 1;
            $scope.id = '';
         }
         if ($scope.id === 'want') {
            $scope.item.type = 2;
            $scope.id = '';
         }


         apiService.marketplace.initialInfo().then(
            function(response) {
               additionalData = response;
               if (isAllDataLoaded()) {
                  init();
               }
            },
            function() {

            }
         );
         $scope.uploadImages = function(file) {
            if (file[0]) {
               apiService.marketplace.uploadImages(file[0]).then(
                  function onFileUploaded(response) {
                     $scope.itemImage = response.file_path;
                     console.log('itemImage', $scope.itemImage);
                     $scope.item.photo = response.name;
                  },
                  function onFileUploadedError(message) {
                     alerts.warning(message);

                  }
               );
            }
         };


         if ($scope.id.length) {
            apiService.marketplace.itemInfo($scope.id).then(
               function(response) {
                  loadedItem = response.items;
                  if (isAllDataLoaded()) {
                     init();
                  }
               },
               function(response) {
                  alerts.warning(response.data.message);
               }
            );
         }

         $scope.cancel = function() {
            $state.go('marketplaceList');
         };

         $scope.save = function() {
            $scope.item.category_id = $scope.selectedCategory.category_id;

            apiService.marketplace.save($scope.item, $scope.id).then(
               function() {
                  $state.go('marketplaceList');
               },
               function(response) {
                  alerts.warning(response.data.response.form_errors);
               }
            );
         };

         $scope.checkRequired = function() {
            return !!$scope.selectedCategory.category_id;
         };

         function isAllDataLoaded() {
            if ($scope.id.length) {
               return additionalData && loadedItem;
            } else {
               return !!additionalData;
            }
         }

         function init() {
            var item = $scope.item;

            $scope.categories = additionalData.categories;


            if (loadedItem) {
               item.type = loadedItem.item_type === 'sell' ? 1 : 2;
               item.item_name = loadedItem.item_name;
               item.description = loadedItem.description;
               item.price = loadedItem.price;
               $scope.selectedCategory = $scope.categories[helper.findById($scope.categories, 'category_name', loadedItem.category)];
               $scope.itemImage = loadedItem.item_image;
               item.photo = loadedItem.item_image.substr(loadedItem.item_image.lastIndexOf('/') + 1);

            }
         }


      });

})();
