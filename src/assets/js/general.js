$(document).ready(function() {

//Top menu dropdown js

$("#admin_menu").hide();
$("#admin_icon").click(function () {
	$(this).toggleClass("active");
	$(this).parent("li").find(".top-arrow").toggleClass("active");
	$("#admin_menu").toggle("slow");
	$("#account_icon").removeClass("active");
	$("#message_icon").removeClass("active");
	$("#bell_icon").removeClass("active");
    $("#timer_menu").removeClass("active");
	$("#account_menu").slideUp("fast");
	$("#notif_menu").slideUp("fast");
	$("#messg_menu").slideUp("fast");
    $("#timer_dropdown").slideUp("fast");
	$("#account_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#notif_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#messg_menu").parent("li").find(".top-arrow").removeClass("active");
    $("#timer_dropdown").parent("li").find(".top-arrow").removeClass("active");
});

$("#account_menu").hide();
$("#account_icon").click(function () {
	$(this).toggleClass("active");
	$(this).parent("li").find(".top-arrow").toggleClass("active");
	$("#account_menu").toggle("slow");
	$("#admin_icon").removeClass("active");
	$("#message_icon").removeClass("active");
	$("#bell_icon").removeClass("active");
    $("#timer_menu").removeClass("active");
	$("#admin_menu").slideUp("fast");
	$("#notif_menu").slideUp("fast");
	$("#messg_menu").slideUp("fast");
    $("#timer_dropdown").slideUp("fast");
	$("#admin_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#notif_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#messg_menu").parent("li").find(".top-arrow").removeClass("active");
    $("#timer_dropdown").parent("li").find(".top-arrow").removeClass("active");
});

$("#messg_menu").hide();
$("#message_icon").click(function () {
	$(this).toggleClass("active");
	$(this).parent("li").find(".top-arrow").toggleClass("active");
	$("#messg_menu").toggle("slow");
	$("#bell_icon").removeClass("active");
	$("#account_icon").removeClass("active");
	$("#admin_icon").removeClass("active");
    $("#timer_menu").removeClass("active");
	$("#notif_menu").slideUp("fast");
	$("#account_menu").slideUp("fast");
	$("#admin_menu").slideUp("fast");
    $("#timer_dropdown").slideUp("fast");
	$("#notif_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#account_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#admin_menu").parent("li").find(".top-arrow").removeClass("active");
    $("#timer_dropdown").parent("li").find(".top-arrow").removeClass("active");
});

$("#notif_menu").hide();
//$(".top-inbox-all").hide();

$("#bell_icon").click(function () {
	$(this).toggleClass("active");
	$(this).parent("li").find(".top-arrow").toggleClass("active");
	$("#notif_menu").toggle("slow");
	$("#message_icon").removeClass("active");
	$("#account_icon").removeClass("active");
    $("#admin_icon").removeClass("active");
	$("#timer_menu").removeClass("active");
	$("#messg_menu").slideUp("fast");
	$("#account_menu").slideUp("fast");
    $("#admin_menu").slideUp("fast");
	$("#timer_dropdown").slideUp("fast");
	$("#messg_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#account_menu").parent("li").find(".top-arrow").removeClass("active");
    $("#admin_menu").parent("li").find(".top-arrow").removeClass("active");
	$("#timer_dropdown").parent("li").find(".top-arrow").removeClass("active");
});

//Collapsible menu	
$( ".panel-heading" ).click(function() {
//    $(this).parent().find( ".panel-collapse" ).slideToggle( "slow").toggleClass("open");
    
    var element = $(this);
    element.parent().find( ".panel-heading" ).toggleClass("open");
    element.parent().find( ".panel-collapse" ).slideToggle( "slow","swing", function(){
        if(!element.parent().find( ".panel-collapse" ).is(":visible")){
            ele = element;
            event = element.attr('name');

             $.ajax({
                type: "GET",
                url: base_url+"home/getFinishedStep/"+event,
                async: false
            })
            .success(function( response ) {
                completed = response;
                if(completed == 'true'){
                    title_div = ele.find(".title");
                    setpno_div = ele.find(".icon-bg");
                    var title = title_div.html();

                    if(title.substring(0, 8) == '<strike>') {

                    } else {
                        title = $(title).text();
                        title_div.css('color' ,'#77be58');
                        title_div.html("<strike>"+title+"</strike>");

                        setpno_div.html('<span class="icon-sprite icon-tick"></span>');
                        setpno_div.addClass('active');
                    }
                }
            });
            checkStepsCompleted();
        }
    });
    
   
    
});

$('#close_step_panel').live("click", function(event) {
//    $(this).parent().parent().parent().slideToggle("slow");

    var element = $(this);
    element.parent().parent().parent().parent().find( ".panel-heading" ).toggleClass("open");
    element.parent().parent().parent().slideToggle("slow","swing", function(){
        ele = element;
        event = element.attr('name');
        $.ajax({
           type: "GET",
           url: base_url+"home/getFinishedStep/"+event,
           async: false
       })
       .success(function( response ) {
           completed = response;
           if(completed == 'true'){
               title_div = ele.parent().parent().parent().parent().find(".title");
               setpno_div = ele.parent().parent().parent().parent().find(".icon-bg");
               var title = title_div.html();

               if(title.substring(0, 8) == '<strike>') {

               } else {
                   title = $(title).text();
                   title_div.css('color' ,'#77be58');
                   title_div.html("<strike>"+title+"</strike>");

                   setpno_div.html('<span class="icon-sprite icon-tick"></span>');
                   setpno_div.addClass('active');
               }
           }
       });

       checkStepsCompleted();
    });
});

$('#skip_step').live("click", function(event) {
    var type = $(this).attr('data-type');
    ele = $(this);
    event = $(this).attr('name');
    switch(type) {
        case 'connection':
            var points = 10000;
            break;
        case 'study-groups':
            var points = 100;
            break;
        case 'custom-group':
            var points = 10;
            break;
        case 'student-service':
            var points = 100000;
            break;
        case 'mentour-groups':
            var points = 1000000;
            break;
    }
    ele.parent().parent().parent().parent().find( ".panel-heading" ).toggleClass("open");
    ele.parent().parent().parent().slideToggle( "slow","swing", function(){
        $.ajax({
            type: "GET",
            url: base_url+"home/skip_single_step/"+points,
            async: false
        })
        .done(function( msg ) {

            title_div = ele.parent().parent().parent().parent().find(".title");
            setpno_div = ele.parent().parent().parent().parent().find(".icon-bg");
            var title = title_div.html();

            if(title.substring(0, 8) == '<strike>') {

            } else {
                title = $(title).text();
                title_div.css('color' ,'#77be58');
                title_div.html("<strike>"+title+"</strike>");

                setpno_div.html('<span class="icon-sprite icon-tick"></span>');
                setpno_div.addClass('active');
            }

        });
        checkStepsCompleted(); 
    });
});


 $(".tab-menu").click(function(e) {
    $(this).parents(".tabs").find(".tab-menu.active").removeClass("active");
    $(this).addClass("active");	
});


//Back to top
jQuery(document).ready(function() {
    var offset = 220;
    var duration = 500;
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > offset) {
            jQuery('.scrollbtn').fadeIn(duration);
        } else {
            jQuery('.scrollbtn').fadeOut(duration);
        }
    });
    
    jQuery('.scrollbtn').click(function(event) {
        event.preventDefault();
        jQuery('html, body').animate({scrollTop: 0}, duration);
        return false;
    })
});

$(".tab1").addClass("active");
//Advanced Posts collpase
$( "#advance-post" ).click(function() {
$( "#advance-post-setting").toggle("slow")
$("#advance-post a").toggleClass("active");
});

//For mobile top sticky header scroll left

$(window).scroll(function(){
    var leftScroll = $(document).scrollLeft();
 $('#top').css({'left':-leftScroll});
});

 $(function() {
$( "#tabs" ).tabs();
});

 $('#join_custom_group').live("click", function(e) {
    
   e.preventDefault();
    var getID = $(this).attr('data');
    var ele = $(this);
    var outer_div = $(this).parent();
    $.ajax({
        type: "GET",
        url: base_url+'customgroups/join/' + getID+'/ajax',
        async: false,
        beforeSend: function() {
            outer_div.css('text-align','center');
            outer_div.html('<img src="'+base_url+'assets/images/ajax-loader.gif"/>');
        }
    }).done(function(response) {
        if(response == 'success'){
            outer_div.html('<img src="'+base_url+'assets/images/icon-tick-green.png"/>');
            outer_div.parent().parent().parent().find('#skip_step').remove();
            outer_div.parent().parent().delay(1000).slideUp('slow');
            checkStepsStarted();
            
            get_user_connection('customgroups', 'custom_group_id', getID);
        }
    });
});

$('#follow_service_page').live("click", function(e) {
    e.preventDefault();
    var getID = $(this).attr('data');
    var ele = $(this);
    var outer_div = $(this).parent();
    $.ajax({
        type: "GET",
        url: base_url+'service_pages/join/' + getID+'/ajax',
        async: false,
        beforeSend: function() {
            outer_div.css('text-align','center');
            outer_div.html('<img src="'+base_url+'assets/images/ajax-loader.gif"/>');
        }
    }).done(function(response) {
        if(response == 'success'){
            outer_div.html('<img src="'+base_url+'assets/images/icon-tick-green.png"/>');
            outer_div.parent().parent().parent().find('#skip_step').remove();
            outer_div.parent().parent().delay(1000).slideUp('slow');
            checkStepsStarted();
        }
    });
});

$('#join_mentor').live("click", function(e) {
    e.preventDefault();
    var getID = $(this).attr('data');
    var ele = $(this);
    var outer_div = $(this).parent();
    $.ajax({
        type: "GET",
        url: base_url+'mentors/join_group_by_id/' + getID+'/ajax',
        async: false,
        beforeSend: function() {
            outer_div.css('text-align','center');
            outer_div.html('<img src="'+base_url+'assets/images/ajax-loader.gif"/>');
        }
    }).done(function(response) {
        if(response == 'success'){
            outer_div.html('<img src="'+base_url+'assets/images/icon-tick-green.png"/>');
            outer_div.parent().parent().parent().parent().parent().find('#skip_step').remove();
            outer_div.parent().parent().delay(1000).slideUp('slow');
            checkStepsStarted();
        }
    });
});

$('#join_study_group').live("click", function(e) {
    e.preventDefault();
    var getID = $(this).attr('data');
    var ele = $(this);
    var outer_div = $(this).parent();

    e.preventDefault();
    var user_id = $(this).data('user');
    var group_id =  $(this).data('id');

    $.ajax({
        type: 'post',
        url: base_url+'study_groups/add_users/' + group_id,
        data: { user_ids: [user_id] },
        success: function() {
            outer_div.html('<img src="'+base_url+'assets/images/icon-tick-green.png"/>');
            outer_div.parent().parent().parent().find('#skip_step').remove();
            outer_div.parent().parent().delay(1000).slideUp('slow');
            checkStepsStarted();
            
            get_user_connection('study_groups', 'study_group_id', group_id);
        }
    });
});

});
 
function checkStepsStarted(){
   $.ajax({
    type: "GET",
    url: base_url+"home/checkStartSteps",
  })
  .success(function( response ) {
    if(response == 'true'){
        $('.get-start').remove();
    }
  });
}

function checkStepsCompleted(){
   $.ajax({
    type: "GET",
    url: base_url+"home/checkStepsComplete/"+total_steps,
    async: false
  })
  .success(function( response ) {
    if(response == 'true'){
        $('#steps_count_left').html('0 Steps Left');
        $('.step-complete').css('width',"100%");
        location.href= base_url;
    } else {
        var data = response.split('|');
        if(data[0] == '1')
            var label = data[0]+' Step Left';
        else
            var label = data[0]+' Steps Left';
        
        $('#steps_count_left').html(label);
        $('.step-complete').css('width',data[1]+"%");
    }
  });
}

function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
    //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
    var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
    
    var CSV = '';    
    //Set Report title in first row or line
    //This condition will generate the Label/Header
    if (ShowLabel) {
        var row = "";
        //This loop will extract the label from 1st index of on array
        for (var index in arrData[0]) {
            //Now convert each value to string and comma-seprated
            row += index + ',';
        }
        row = row.slice(0, -1);
        //append Label row with line break
        CSV += row + '\r\n';
    }
    
    //1st loop is to extract each row
    for (var i = 0; i < arrData.length; i++) {
        var row = "";
        //2nd loop will extract each column and convert it in string comma-seprated
        for (var index in arrData[i]) {
            row += '"' + arrData[i][index] + '",';
        }
        row.slice(0, row.length - 1);
        //add a line break after each row
        CSV += row + '\r\n';
    }

    if (CSV == '') {        
        alert("Invalid data");
        return;
    }   
    
    //Generate a file name
    //this will remove the blank-spaces from the title and replace it with an underscore
    var fileName = ReportTitle.replace("_"," ");   
    
    //Initialize file format you want csv or xls
    var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
    
    // Now the little tricky part.
    // you can use either>> window.open(uri);
    // but this will not work in some browsers
    // or you will not get the correct file extension    
    
    //this trick will generate a temp <a /> tag
    var link = document.createElement("a");    
    link.href = uri;
    
    //set the visibility hidden so it will not effect on your web-layout
    link.style = "visibility:hidden";
    link.download = fileName + ".csv";
    
    //this part will append the anchor tag and remove it after automatic click
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

//General function for search based on user key input.
// This function will bind search element for search based on user type.
// For optimization purpose it will send search request once user stop typing instead of sending request for every character.
function searchBasedOnUserKeyInput(searchElementId, searchInterval)
{
    if (typeof(searchInterval)==='undefined') searchInterval = 500; //time in ms, half second default

    //setup before functions
    var typingTimer; //timer identifier
    var doneTypingInterval = searchInterval;

    //on keyup, start the countdown
    $('#'+searchElementId).keyup(function(){
        clearTimeout(typingTimer);
        typingTimer = setTimeout(filterdata, doneTypingInterval);
    });
}