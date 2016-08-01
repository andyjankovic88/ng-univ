(function() {
    "use strict";

    angular.module('api')
        .factory('apiMentorGroups', function(apiTransport, apiServerUrl) {
            return {
            	get: function(searchTerm, faculties, campuses) {
            		var
            			requestData = {};

            			if(searchTerm ) {
            				requestData.search_term = searchTerm;
            			}
            			if(faculties) {
            				requestData.faculty_ids = faculties;
            			}
            			if(campuses) {
            				requestData.campus_ids  = campuses;
            			}

            		return apiTransport.postAsForm(requestData, apiServerUrl +	 '/mentorgroup/list');
            	},
                searchMentors: function(term) {
                    return apiTransport.postAsForm({action: 'search', term: term}, apiServerUrl + '/json/search_mentees');
                },
                add: function (groupName, programName, groupMembers, id) {
                    var data = {
                        group_name: groupName,
                        program_name: programName,
                        group_members: groupMembers
                    };

                    return apiTransport.postAsForm(data, apiServerUrl + '/mentorgroup/addedit' + id);
                },
                getInfo: function(id) {
                    return apiTransport.get(apiServerUrl + '/mentorgroup/view_details/' + id);
                },
                sidebar: function(id) {
                    return apiTransport.postAsForm({}, apiServerUrl + '/sidebar_rhs/group_specific/mentorgroup/' + id);
                },
                joinAsMentee: function(id) {
                    return apiTransport.postAsForm({}, apiServerUrl + '/mentorgroup/join_as_mentee/' + id);
                },
                joinAsMentor: function(id) {
                    return apiTransport.postAsForm({}, apiServerUrl + '/mentorgroup/join_as_mentor/' + id);
                },
                leaveAsMentee: function(id) {
                    return apiTransport.postAsForm({}, apiServerUrl + '/mentorgroup/leave_as_mentee/' + id);
                },
                leaveAdMentor: function(id) {                    
                    return apiTransport.postAsForm({}, apiServerUrl + '/mentorgroup/leave_as_mentor/' + id);
                },
                deleteGroup: function(id) {
                    return apiTransport.postAsForm({}, apiServerUrl + '/mentorgroup/delete/' + id);
                },
                formData: function(id) {
                    return apiTransport.get(apiServerUrl + '/mentorgroup/addedit_form_details/' + id);
                }


            };

        });
})();
