/*
 * JS for edit users profile page
 * file contains all relevant javascript and is included in
 * /application/views/user/edit_profile.php
 * 
 * @author: lars haeuser <lars@ucroo.com>
 * @version: 1.0
 * 
 */
$(function() {
		$('button.submit').each(function(i, el) {
				$(el).bind('click', function(elem) {
						$('#profileForm').submit();
				//	    $('#profileForm').validate({
				//		submitHandler: function(form) {
				//		// do other stuff for a valid form
				//		},
				//		invalidHandler: function(form, validator) {
				//		    var errors = validator.numberOfInvalids();
				//		    if (errors) {
				//			var message = errors == 1
				//			? 'You missed 1 field. It has been highlighted'
				//			: 'You missed ' + errors + ' fields. They have been highlighted';
				//			$("div.error span").html(message);
				//			$("div.error").show();
				//		    } else {
				//			$("div.error").hide();
				//		    }
				//		}
				//	    }); 
				}); 
		//console.log(elem);
		});
});

/**
 * validation rules
 */


/*
 * init tag editors
 */
$('.profile-tag-edit').each(function(i, el) {
    ul_info = el.id.split('-');
    extra_id = ul_info[1];
    ul_id_name = ul_info[0];
    $('#'+el.id).tagit({
	'allowSpaces': true,
	'singleField': false,
	'caseSensitive': false,
	'placeholderText': 'Separate with comma',
	'fieldName': ul_id_name + '-' + extra_id,
	'itemName': 'extracurricular',
	'removeConfirmation': true,
	afterTagRemoved: function(ev, stuff) {
	    if($(get_target_of_event(ev)).children('li.tagit-choice').length == 0) {
		$(get_target_of_event(ev))
		    .append('<input type="hidden" name="' + stuff.options.itemName + '[' + stuff.options.fieldName + '][]" />')
	    }
	}
    }
    );
});

/**
 *  add hidden field to form for "add new education"
 */
$(function() {
//    $('#add-new-education').bind('click', function() {
//        $('#profileForm')
//                .append($('<input type="hidden" name="add-new-education" value="true" />'));
//        $('#profileForm').submit();
//    });

    add_new_education = $('#add-new-education');
    empty_education_row = $('#empty-education-row');
    remove_education = $('.delete-edication');


    add_new_education.click(function(e) {
        var size = parseInt($('#education-rows tr#empty-education-row').size());
        empty_education_row.clone(true, true)
                .appendTo('#education-rows tbody')
                .removeClass('hidden')
                .addClass('new-row')
                .removeAttr('style')
                .find('.number').html(size);

        $('#education-rows tr.new-row:last').find('input').each(function() {
            $(this).val('');
        });

    });
    remove_education.bind('click', function(e) {
        //delete confirmation dialog box
        $dialog = $('<div></div>')
                .html('Are you sure you want to delete this?')
                .dialog({
                    title: 'Confirm delete',
                    show: "slide",
                    modal: true,
                    buttons: {
                        "Ok": function() {
                            $(get_target_of_event(e)).hide();
                            var removing_element = $(get_target_of_event(e)).parent().parent().parent().parent();
                            var removed_number = parseInt($(removing_element).find('.number').html());
                            var next_tr = $(removing_element).next();

                            while (next_tr.html() != null) {
                                next_tr.find('.number').html(removed_number);
                                removed_number = (removed_number + 1);
                                next_tr = next_tr.next();
                            }

                            $(removing_element).animate({ backgroundColor: "#fbc7c7" }, "fast").hide('slow', function() { $(removing_element).remove();});
                            $(this).dialog("close");
                        },
                        'Cancel': function() {
                            $(this).dialog("close");
                        }
                    }
                });
    });

});

/**
 *  add hidden field to form for "add new work experience"
 */
$(function() {
//    $('#add-new-work').bind('click', function() {
//        $('#profileForm')
//                .append($('<input type="hidden" name="add-new-work" value="true" />'));
//        $('#profileForm').submit();
//    });

    add_new_work = $('#add-new-work');
    empty_work_row = $('#empty-work-row');
    remove_work = $('.delete-work');


    add_new_work.click(function(e) {
        var size = parseInt($('#work-rows tr#empty-work-row').size());
        empty_work_row.clone(true, true)
                .appendTo('#work-rows tbody')
                .removeClass('hidden')
                .addClass('new-row')
                .removeAttr('style')
                .find('.number').html(size);

        $('#work-rows tr.new-row:last').find('input').each(function() {
            $(this).val('');
        });
    });
    remove_work.bind('click', function(e) {
        //delete confirmation dialog box
        $dialog = $('<div></div>')
                .html('Are you sure you want to delete this?')
                .dialog({
                    title: 'Confirm delete',
                    show: "slide",
                    modal: true,
                    buttons: {
                        "Ok": function() {
                            $(get_target_of_event(e)).hide();
                            var removing_element = $(get_target_of_event(e)).parent().parent().parent().parent();
                            var removed_number = parseInt($(removing_element).find('.number').html());
                            var next_tr = $(removing_element).next();

                            while (next_tr.html() != null) {
                                next_tr.find('.number').html(removed_number);
                                removed_number = (removed_number + 1);
                                next_tr = next_tr.next();
                            }

                            $(removing_element).animate({ backgroundColor: "#fbc7c7" }, "fast").hide('normal', function() { $(removing_element).remove();});
                            $(this).dialog("close");
                        },
                        'Cancel': function() {
                            $(this).dialog("close");
                        }
                    }
                });
    });
});
/*
 * Click event for delete education buttons
 * send ajax to delete specific education entry and after success
 * it removes html inputs from site
 */
$(function() {
		//add click event to delete buttons
		$('.delete-extra').each(function(i, el) {
				$(el).bind('click', function(event) {
						//delete confirmation dialog box
						$dialog = $('<div></div>')
						.html('Are you sure you want to delete this?')
						.dialog({
								title: 'Confirm delete',
								show: "slide",
								modal: true,
								buttons: { 
										"Ok": function() { 
												box = $(this);
												box.append($('<div class="loading"></div>'));
												box.dialog("widget").find('.ui-dialog-titlebar-close').remove();
												box.dialog("widget").find("button").addClass("ui-state-disabled").attr("disabled", true);
												box.dialog( "option", "closeOnEscape", false );
												$.ajax({
														type: "POST",
														url: "/json/delete_extra_user_info",
														data: {
																user_id: $(get_target_of_event(event)).attr('data-user-id'), 
																extra_id: $(get_target_of_event(event)).attr('data-id'),
																action: 'delete'
														}
												}).done(function(msg) {
														if(msg.success) {
																//delete form on client side
																$(get_target_of_event(event)).parent().parent().remove();
																//close dialog box
																box.dialog("close");
														}
												});
										},
										'Cancel': function() {
												$(this).dialog("close");
										}
								}
						});
				});
		});
});

/*
 * autocomplete for course field
 */
$(function() {
    var course_name = $("#course_name");
    var course = $("#course");
		course_name.fullsearch({
				source: courses,
				focus: function(event,ui)	{
						course.val(ui.item.label);
						return false;
				},
				multiple: true,
				select: function(event,ui)	{
						course_name.val(ui.item.label);
						course.val(ui.item.id);
						if(ui.item.label.indexOf("Letters") != -1)
								alert("Sorry, we can't find the course you are looking for. Try entering the course code.");
						return false;
				}
		}, 'json');
});
