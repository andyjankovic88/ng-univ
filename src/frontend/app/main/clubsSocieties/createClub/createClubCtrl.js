(function () {
   'use strict';



   function CreateClubCtrl($scope, userService, apiService, $state, alerts, helper) {
      this.state = $state;
      this.alerts = alerts;
      this.helper  = helper;
      this.apiService = apiService;
      this.userService = userService;
      apiService.getFaculties(userService.getUnivInfo().id).then(function (response) {
         $scope.faculties = response;
      });
   }
   CreateClubCtrl.prototype.isFacultySelected = false;
   CreateClubCtrl.prototype.newClub = {
      "name": "",
      "short_name": "",
      "description": "",
      "website": "",
      "email": "",
      "email_confirm": "",
      "phone": "",
      "faculty_id": -1,
      "owner_position": "",
      "member_fee": 0,
      "student_discount": 0,
      "can_student_join": true,
      "collect_gst": true,
      "digital_card": true,
      "clubpicture": false,
      "member_message": "",
      "benefits": []
   };
   CreateClubCtrl.prototype.uploadImages = function (file) {
      if (file) {
         this.newClub.clubpicture = file[0];
      }
   };
   CreateClubCtrl.prototype.faculties = [];
   CreateClubCtrl.prototype.selectedFaculty = {
      id: -1,
      name: "Select your faculty",
      aaf: true
   };

   CreateClubCtrl.prototype.additionalValidation = function () {
      return this.selectedFaculty.id > 0 && (this.newClub.email == this.newClub.email_confirm) && this.newClub.clubpicture && ctrl.newClub.owner_position.length;
   };

   CreateClubCtrl.prototype.submit = function () {
      if (this.newClub.benefits.length) {
         this.newClub.benefits = this.newClub.benefits.map(function (benefit) {
            if (benefit && benefit.text) {
               return benefit.text;
            };
            return;
         });
      }

      this.newClub.faculty_id = this.selectedFaculty.id;

      var self = this;

      this.apiService.clubs.addNew(this.newClub).then(function (response) {
         console.log(response);
         self.userService.getMenu().club.push({
            id: response.club_id,
            title: self.newClub.short_name
         });
         self.state.go('clubsList')
      }, function (response) {
         self.alerts.warning(response.message);
      })

   };
   CreateClubCtrl.prototype.cancel = function () {
      this.state.go('clubsList')
   };


   angular
      .module('createClub', [])
      .controller('CreateClubCtrl', CreateClubCtrl);



})();
