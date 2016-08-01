// JavaScript Document
$( document ).ready(function() {
 
  if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
    $('.student-left ul li,.banner-title, .class-community li .community-details .title,.student-right ul li, .tagline, .class-community li .community-details p, .student-middle, .instructor-top-detail,.staff-page li .icon-main-staff,.staff-heading,.club-middle-lt,.club-middle-rt,.why-club li,.class-community li, .class-community li .icon-main-instrcutor,.why-club li .text,.university-tabs-nav,.university-it-lt,.request-lt,.request-rt').css('visibility','visible');
  }

  $(window).on('resize orientationChanged', function(){
    $(".publicpage").css('height',$(window).height())
    $(".publicpage").mCustomScrollbar('update');
  });

  // Login Popup
  $('.fancybox').fancybox({
      //maxWidth  : 100,
      // maxHeight : 600,
      fitToView : false,
      width     : '380px',
      // height    : '50%',
      autoSize  : false,
      closeBtn : false,
      closeClick  : false,
      helpers     : { 
        overlay : {closeClick: false} // prevents closing when clicking OUTSIDE fancybox
      },
      afterLoad: function(){
        var tabindex = 1;
        $('input,select,a').each(function() {
          if (this.type != "hidden") {
            var $input = $(this);
            $input.attr("tabindex", tabindex);
            tabindex++;
          }
        });
      },
      afterClose :function(){
      },
  });

  $('#close_login_popup').click(function() {
      parent.$.fancybox.close();
  })


  $( ".btn-email" ).click(function() {
    $( ".email-form").slideToggle("slow");
    $(".publicpage").mCustomScrollbar('update');
  });
  
  //Collapse content
  //$('.panel-heading').on('click',function(){
  //  $(this).toggleClass('open');
  //  $('#'+ $(this).attr('rel')).slideToggle('slow');
  //});

//Collapse content  
$(".panel-heading").click(function(){
  $(".panel-heading").not(this).removeClass('open').next(".panel-content").slideUp("slow", function(){
    setTimeout($(".publicpage").mCustomScrollbar('update'), 1000);
  });
  $(this).next(".panel-content").slideToggle("slow", function(){
    setTimeout($(".publicpage").mCustomScrollbar('update'), 1000);
  });
  $(this).next(".panel-content").prev().toggleClass('open');
});

var noscroll = 0;

$('#nav li a').on('click touchstart tap',function(){
  noscroll = 1;
  $(".publicpage").mCustomScrollbar('stop');
  if(!$(this).hasClass('active')){
    $(this).parents('#nav').find("li a.active").removeClass('active');
    $(this).addClass('active');
  }
  
  if($(this).attr('href') != '#sTop'){
    $(".publicpage").mCustomScrollbar("scrollTo", $($(this).attr('rel')).position().top+($(window).height()-65));
  } else {
    $(".publicpage").mCustomScrollbar("scrollTo", 0);
  }
   return false;
});

$('.footer-home li a').on('click touchstart tap',function(){
  noscroll = 1;
  if($(this).attr('href') != '#sTop'){
    $(".publicpage").mCustomScrollbar("scrollTo", $($(this).attr('href')).offset().top-50);
  } 
  var ele = $('.header-bg').find("#nav li a[rel="+$(this).attr("rel")+"]");
  if(!ele.hasClass('active')){
    ele.parents('#nav').find("li a.active").removeClass('active');
    ele.addClass('active');
  }

  //$('html, body').animate({scrollTop: $( $(this).attr('rel') ).offset().top}, 1500);
  
   return false;
  
});

$('#footer_navigation_links li a').on('click touchstart tap',function(){
  noscroll = 1;
  if($(this).attr('href') != '#sTop'){
    $(".publicpage").mCustomScrollbar("scrollTo", $($(this).attr('href')).offset().top-65);
  } 
  var ele = $('.header-bg').find("#nav li a[rel="+$(this).attr("rel")+"]");
  if(!ele.hasClass('active')){
    ele.parents('#nav').find("li a.active").removeClass('active');
    ele.addClass('active');
  }
  
  if($(this).attr('href') != '#sTop'){
    $(".publicpage").mCustomScrollbar("scrollTo", $($(this).attr('rel')).position().top+($(window).height()-65));
  } else {
    $(".publicpage").mCustomScrollbar("scrollTo", 0);
  }
   return false;
});

$('a[id=request_demo_link]').click(function(){
  noscroll = 1;
  var count = 1;
  var tab_text = 'Request a Demo';
  $('#tabs-items').find('li').each(function(){
        var current = $(this);

        if(current.html() == tab_text) {

          $('.resp-tab-content').removeAttr('style').removeClass('resp-tab-content-active').addClass('resp-tab-active');
          $('.resp-accordion').removeClass('resp-tab-active');
          $('.resp-tab-item').removeClass('resp-tab-active');

          if(tab_text == 'Why UCROO?')
            var tabid = 0;
          else if(tab_text == 'University IT')
            var tabid = 1;
          else if(tab_text == 'FAQ')
            var tabid = 2;
          else if(tab_text == 'Request a Demo')
            var tabid = 3;

          $('div[aria-labelledby=tab_item-'+tabid+']').removeClass('resp-tab-active').addClass('resp-tab-content-active').css('display','block');
          $('div[aria-controls=tab_item-'+tabid+']').addClass('resp-tab-active');
          $('li[aria-controls=tab_item-'+tabid+']').addClass('resp-tab-active');
          // setTimeout( "$('#horizontalTab ul.resp-tabs-list li:nth-child("+count+")').trigger('click');",200 );
        }
        count++;
    });
  
   if(!$(this).hasClass('active')){
    $(this).parents('#nav').find("li a.active").removeClass('active');
    $(this).addClass('active');
   }
   $(".publicpage").mCustomScrollbar("scrollTo", $('#horizontalTab').position().top+($(window).height()-105));
   return false;
});

$('#footer_navigation_tabs li a').on('click touchstart tap',function(){
  noscroll = 1;
  var count = 1;
  var tab_text = $(this).html();
  $('#tabs-items').find('li').each(function(){
        var current = $(this);

        if(current.html() == tab_text) {

          $('.resp-tab-content').removeAttr('style').removeClass('resp-tab-content-active').addClass('resp-tab-active');
          $('.resp-accordion').removeClass('resp-tab-active');
          $('.resp-tab-item').removeClass('resp-tab-active');

          if(tab_text == 'Why UCROO?')
            var tabid = 0;
          else if(tab_text == 'University IT')
            var tabid = 1;
          else if(tab_text == 'FAQ')
            var tabid = 2;
          else if(tab_text == 'Request a Demo')
            var tabid = 3;

          $('div[aria-labelledby=tab_item-'+tabid+']').removeClass('resp-tab-active').addClass('resp-tab-content-active').css('display','block');
          $('div[aria-controls=tab_item-'+tabid+']').addClass('resp-tab-active');
          $('li[aria-controls=tab_item-'+tabid+']').addClass('resp-tab-active');
          // setTimeout( "$('#horizontalTab ul.resp-tabs-list li:nth-child("+count+")').trigger('click');",200 );
        }
        count++;
    });
  
  if(!$(this).hasClass('active')){
    $(this).parents('#nav').find("li a.active").removeClass('active');
    $(this).addClass('active');
  }
  
  if($(this).attr('href') != '#sTop'){
    $(".publicpage").mCustomScrollbar("scrollTo", $($(this).attr('rel')).position().top+($(window).height()-65), { callbacks:true } );
  } else {
    $(".publicpage").mCustomScrollbar("scrollTo", 0);
  }

});




var headerBg = $('#wrapper').offset().top;

  $(window).load(function() { 
    $("#wrapper").height($(window).height());
    $(".publicpage").mCustomScrollbar('update');
  });
  
  $( window ).on( "orientationchange", function( event ) {
    if(window.orientation == 90 || window.orientation == -90){
      $("#wrapper").height($(window).height());
    } else {
      $("#wrapper").height($(window).height());
    }
      $("#wrapper").trigger( 'updatelayout' );
    $(".publicpage").mCustomScrollbar('update');
  });

  

  // $(".content-scroll").mCustomScrollbar({
 //          scrollButtons:{
 //            enable:true
 //          }
 //        });
 
  $(".publicpage").mCustomScrollbar({
    autoHideScrollbar: true,
    autoExpandScrollbar:true,
    keyboard:{ enable: true },
    contentTouchScroll: 5000,
    updateOnBrowserResize:true,
    autoExpandHorizontalScroll: true,
    theme:"light-thin",
    scrollButtons:{
      enable:true
    },
    callbacks:{
      whileScrolling: function(){

        //script for mobile menui and desktop menu
        if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){

        } else {
          //Animation Effects to the page.
          $('.student-left ul li, .banner-title, .class-community li .community-details .title, .staff-page li .details, .club-middle-lt, .university-it-lt, .request-lt').each(function(){
          var imagePos = $(this).offset().top;
          var topOfWindow = $(window).scrollTop();
            if (imagePos < topOfWindow+800) {
              $(this).addClass("animated fadeInLeft");
            }
          else {
            $(this).removeClass("animated fadeInLeft");
          }
          });


          $('.student-right ul li, .tagline, .class-community li .community-details p, .club-middle-rt, .request-rt').each(function(){
          var imagePos = $(this).offset().top;
          var topOfWindow = $(window).scrollTop();
            if (imagePos < topOfWindow+800) {
              $(this).addClass("animated fadeInRight");
            }
          else {
            $(this).removeClass("animated fadeInRight");
          }
          });


          $('.student-middle, .instructor-top-detail, .staff-heading, .class-community li .icon-main-instrcutor, .why-club li .text').each(function(){
          var imagePos = $(this).offset().top;
          var topOfWindow = $(window).scrollTop();
            if (imagePos < topOfWindow+800) {
              $(this).addClass("animated fadeInUp");
            }
          else {
            $(this).removeClass("animated fadeInUp");
          }
          });

          
          $('.class-community li, .staff-page li .icon-main-staff, .sign-up-btn, .why-club li').each(function(){
          var imagePos = $(this).offset().top;
          var topOfWindow = $(window).scrollTop();
            if (imagePos < topOfWindow+800) {
              $(this).addClass("animated zoomIn");
            }
          else {
            $(this).removeClass("animated zoomIn");
          }
          });

          $('.university-tabs-nav').each(function(){
          var imagePos = $(this).offset().top;
          var topOfWindow = $(window).scrollTop();
            if (imagePos < topOfWindow+800) {
              $(this).addClass("animated bounceIn");
            }
          else {
            $(this).removeClass("animated bounceIn");
          }
          });
          
        //29-07-2015 - #4939 - Anuj - Who is part of Team
        //our team list animation 
        $('.team-list').each(function(){
            var imagePos = $(this).offset().top;
            var topOfWindow = $(window).scrollTop();
                if (imagePos < topOfWindow+1000) {
                    $('.team-list ul.first').addClass("animated fadeInRight");
                    $('.team-list ul.last').addClass("animated fadeInLeft");
                } else {
                    $('.team-list ul.first').removeClass("animated fadeInRight");
                    $('.team-list ul.last').removeClass("animated fadeInLeft");
                }
            });
            
        //29-07-2015 - #4939 - Anuj - Who is part of Team
        //our team banner animation 
        $('.team-banner').each(function(){
            var imagePos = $(this).offset().top;
            var topOfWindow = $(window).scrollTop();
                if (imagePos < topOfWindow+1000) {
                    $('.title-team').addClass("animated fadeInLeft");
                } else {
                    $('.title-team').removeClass("animated fadeInLeft");
                }
            });

          //Animation effect completed
        }

        if ( window.mcs.top <=  (-$(window).height()) ) {
          $('.header-bg').addClass('fixed-header');
          $('#middle').addClass('header-padding');
          $('.footer-home').hide();
        } else {
          $('.footer-home').show();
          $('.header-bg').removeClass('fixed-header');
          $('#middle').removeClass('header-padding');
        }
        
        if(noscroll == 0){

          if(parseInt($('.student-page').offset().top) <= 65){
            var ele = $('.header-bg').find("#nav li a[rel='#s1']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          } 
          if(parseInt($('.instructor-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s2']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          if(parseInt($('.staff-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s3']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          if(parseInt($('.club-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s4']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          if(parseInt($('.university-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s5']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          
          //29-07-2015 - #4939 - Anuj - Who is part of Team
          //On hover team secion remove active class on universities - 
          if(parseInt($('.team-page').offset().top) <= 100){
            $("#nav li a[rel='#s5']").removeClass('active');
          }
          
        }
      },
      onScroll: function(){
        noscroll = 0;
        $(".publicpage").mCustomScrollbar('update');

        if(parseInt($('.student-page').offset().top) <= 65){
            var ele = $('.header-bg').find("#nav li a[rel='#s1']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          } 
          if(parseInt($('.instructor-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s2']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          if(parseInt($('.staff-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s3']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          if(parseInt($('.club-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s4']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          // alert(parseInt($('.university-page').offset().top));
          if(parseInt($('.university-page').offset().top) <= 100){
            var ele = $('.header-bg').find("#nav li a[rel='#s5']");
            if(!ele.hasClass('active')){
              ele.parents('#nav').find("li a.active").removeClass('active');
              ele.addClass('active');
            }
          }
          
          //29-07-2015 - #4939 - Anuj - Who is part of Team
          //On hover team secion remove active class on universities 
          if(parseInt($('.team-page').offset().top) <= 100){
            $("#nav li a[rel='#s5']").removeClass('active');
          }
      }
    },
  });


  $(".publicpage").hover(function(){
    $(document).data({"keyboard-input":"enabled"});
    $(this).addClass("keyboard-input");
  },function(){
    $(document).data({"keyboard-input":"disabled"});
    $(this).removeClass("keyboard-input");
  });

  $(document).keydown(function(e){
    if($(this).data("keyboard-input")==="enabled"){
      var activeElem=$(".keyboard-input"),
        activeElemPos=Math.abs($(".keyboard-input .mCSB_container").position().top),
        pixelsToScroll=60;
      if(e.which===38){ //scroll up
        e.preventDefault();
        if(pixelsToScroll>activeElemPos){
          activeElem.mCustomScrollbar("scrollTo","top");
        }else{
          activeElem.mCustomScrollbar("scrollTo",(activeElemPos-pixelsToScroll),{scrollInertia:400,scrollEasing:"easeOutCirc"});
        }
      }else if(e.which===40){ //scroll down
        e.preventDefault();
        activeElem.mCustomScrollbar("scrollTo",(activeElemPos+pixelsToScroll),{scrollInertia:400,scrollEasing:"easeOutCirc"});
      }else if(e.which===36){ 
        activeElem.mCustomScrollbar("scrollTo","top");
      }else if(e.which===35){ 
        activeElem.mCustomScrollbar("scrollTo","bottom");
      } 
    }
  });  

  
   // validate signup form on keyup and submit
    $("#request-demo").validate({
      rules: {
        name: "required",
        institution: "required",
        position: "required",
        email: {
          required: true,
          email: true
        },
        phone_number: "required"
      },
      messages: {
        name: "",
        institution: "",
        position: "",
        email:  {
          required: "",
          email: "Please enter a valid email address"
        },
        phone_number: ""
      },
      invalidHandler: function(event, validator) {
         $(".publicpage").mCustomScrollbar("scrollTo", $('.request-demo').position().top+($(window).height()-65));
      },
      submitHandler: function(form) {
        $('#loading_image').html('<img src="/assets/images/loading-boring.gif" class="request-msg-icon"/> <span class="request-msg">Sending your request.</span>');
        $('#loading_image').removeClass('hidden');
        $('#loading_image').css('opacity', '1');
        $('#blur_form').removeClass('hidden');
        $('#blur_form').css('opacity', '0.5');
        $(form).ajaxSubmit({
          beforeSubmit:  showRequest,
          success:       showResponse
        });
      }
    });

    $("#sigup_form").validate();

    $('select').on('focus', function(){
      $(".publicpage").mCustomScrollbar('disable');
      $('.mCS_no_scrollbar').css('margin-right', '0px');
    });
});

function showRequest(formData, jqForm, options){
  $('#blur_form').removeClass('hidden');
  $('#loading_image').removeClass('hidden');
}

function showResponse(responseText, statusText, xhr, $form){
  if(responseText == 'success'){
    $('#loading_image').html('<div class="request-msg-main"><span class="icon-checkmark"></span><span class="request-msg"> Your request has been submitted.</span></div>');
    $('#request_demo_submit').hide();
  } else if(responseText == 'captcha_fail'){
    $('#loading_image').html('<div class="request-msg-main"><span class="icon-cross"></span><span class="request-msg">Please enter correct captcha code.</span><div class="request-btn"><button id="activate_form" name="activate_form" class="btn-blue button-blue-effect sign-up-btn">Ok</button></div></div>');
    Recaptcha.reload();
  }else if(responseText == 'fail'){
    $('#loading_image').html('<div class="request-msg-main"><span class="icon-cross"></span><span class="request-msg">Something went wrong. Please try again.</span><div class="request-btn"><button id="activate_form" name="activate_form" class="btn-blue button-blue-effect sign-up-btn">Ok</button></div></div>');
  }

  $('#activate_form').on('click',function() {
    $('#loading_image').addClass('hidden');
    $('#loading_image').css('opacity', '0');
    $('#blur_form').addClass('hidden');
    $('#blur_form').css('opacity', '0');
  });
}

function change_to_video(ele){
  ele.html('<iframe title = "UCROO Clubs Video" width="540" height="300" src="//www.youtube.com/embed/NJJvFHQBpKc?rel=0" frameborder="0" allowfullscreen>Ucroo Clubs Video</iframe>');
  $(".publicpage").mCustomScrollbar('update');
}

function open_accordian(text){
  $(".faq-list ul").each( function(){
    $("li",this).each(function(){
      if($('.detail a',this).html() == text){
        $(".panel-heading").not(this).removeClass('open').next(".panel-content").slideUp("slow");
        $(".panel-content",this).slideToggle("slow"); 
        $(this).find('.panel-heading').toggleClass('open');
      }
    });
  });
}	