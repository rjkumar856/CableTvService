$(document).ready(function(){
  $('#toggle-sidebar').click(function(){
    $('#slider-block').removeClass('animated fadeOutLeft');
    $('#slider-block').show().addClass('animated fadeInLeft');
    $("#mob-overlay").fadeIn();
    if($('#slider-block').hasClass('fadeInLeft')){
        $(document).mouseup(function (e){
            var containernav = $("#slider-block");
            if (!containernav.is(e.target) // if the target of the click isn't the container...
                && containernav.has(e.target).length === 0) // ... nor a descendant of the container
            {
                containernav.removeClass('animated fadeInLeft');
                containernav.addClass('animated fadeOutLeft')
                $("#mob-overlay").fadeOut();
            }
        });
    }
  });

  var headerHeight = $("#navbar-small").height();
  var footerHeight = $(".admin_footer").height();
  var winHeight=$(window).height();
  var finalHeight = winHeight-(footerHeight+headerHeight+35);
  $("#admin_section").css({ minHeight:finalHeight,"padding-bottom":"0px" });

  $("#close-mob-header").click(function(){
      $('#slider-block').addClass('animated fadeOutLeft');
      $("#mob-overlay").fadeOut();
  });
  // mobile-togglebar end here ////////////////////////////////////////////////////////////////////
  $(".plan-circles").each(function(){
    $(this).hover(function(){
      $("#show-speed").text("Speed up to 100 Mbps available with this plan");
    });
    $(this).mouseleave(function(){
      $("#show-speed").text("");
    });
  });
    $("#nav-links li a[href]").each(function() {
      if (this.href == window.location.href) {
          $(this).addClass("current-nav-link");
          console.log(window.location.href);
      }
    });
   
  $('.my-slider').slick({
      dots: true,
  	  infinite: true,
  	  speed: 1000,
  	  cssEase: 'linear',
      autoplaySpeed: 3000
  });
  $('.mobile-plan-slider').slick({
      infinite: true,
      speed: 1000,
      cssEase: 'linear',
      autoplaySpeed: 3000
  });

  $('.plan-slider').slick({
      dots: true,
      infinite: true,
      speed: 1000,
      cssEase: 'linear',
      autoplaySpeed: 3000
  });  

  var headerHeight = $("#navbar-small").height();
  var footerHeight = $("#custom-nav").height();
  var winHeight=$(window).height();  

  var bottomFooterHeight = $("#section-footer").height();
  var speedBlockHeight = winHeight - (headerHeight + footerHeight + 76 + bottomFooterHeight);
  $("#speed-test-block").height(speedBlockHeight);

  var mq = window.matchMedia( "(min-width: 767px)" );
  if (mq.matches) {
    var finalHeight = winHeight-(136+footerHeight+headerHeight);
    // $(".my-slider").css({ minHeight:finalHeight,"padding-bottom":"0px" });
    $(".my-slider").height(finalHeight);
    $(".slide-block,.inner").height(finalHeight);
    var slideBlox = $(".slide-block").height();
    var textBoxHeight = $("#slide-one-text").height();
    var diffHeight = slideBlox - textBoxHeight;
    var finalMargin = (diffHeight/2)-35;
    $("#slide-one-text").css("margin-top", finalMargin);
    var textBoxTwoHeight = $("#slide-two-text").height();
    var diffHeightTwo = slideBlox - textBoxTwoHeight;
    var finalMarginTwo = (diffHeightTwo/2)-35;
    $("#slide-two-text").css("margin-top", finalMargin);
    $(window).scroll(function () {
       if ($(this).scrollTop() > 100) {
           $('#back-to-top').fadeIn();
       } else {
           $('#back-to-top').fadeOut();
       }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
       $('body,html').animate({
           scrollTop: 0
       }, 800);
       return false;
    });
  } else {
    var linkBoxHeight =$("#mob-main-links").height();
    var finalHeight = winHeight-(161+footerHeight);
    // $(".my-slider").css({ minHeight:finalHeight,"padding-bottom":"0px" });
    $(".my-slider").height(finalHeight);
    $(".slide-block,.inner").height(finalHeight);
  }

  $('.autoplay').slick({slidesToShow: 3,slidesToScroll: 1,autoplay: true,autoplaySpeed: 2000,});

  // $('#support').hide();
  $('#support-link, #help-link').click(function(){
    $('#support').slideDown();
  });

  $(document).mouseup(function (e){
      var containernav = $("#support");
      if (!containernav.is(e.target) // if the target of the click isn't the container...
          && containernav.has(e.target).length === 0) // ... nor a descendant of the container
      {
          containernav.slideUp();
      }
  });
      
  // /////////////////enquiry page javascript End Here //////////////////////////////////////////////////////////
  $( "#select_service" ).change(function() {
    if($(this).val() == "residencial")
    {
       $("#company-name").hide();
       $("#company-val").val("HOME");
    }
    else
    {
       $("#company-name").show();
       $("#company-val").val("");
    }
  });
  // /////////////////enquiry page javascript End Here //////////////////////////////////////////////////////////

  // /////////////////Plan page javascript Start Here //////////////////////////////////////////////////////////
  $("#plan-location-list li:nth-child(1)").val("300");
  $("#plan-location-list li:nth-child(2)").val("301");
  $("#plan-location-list li:nth-child(3)").val("301");
  $("#plan-location-list li:nth-child(4)").val("301");
  $("#plan-location-list li:nth-child(5)").val("301");

  $("#plan-location-list").hide();
  $(".custom-location").hide();
  $("#300").show();
  $("#select-plan-loc,#loc-fa-marker").click(function(){
    $("#plan-location-list").slideDown();
     $("#plan-location-list li").each(function(){
      $(this).click(function(){
        // var listVal = $(this).val();
        $("#select-plan-loc").val($(this).text());
        $(".custom-location").hide();
        $('#'+$(this).val()).show();
        $("#auto-location").text($(this).text());
        $("#plan-location-list").slideUp();
      });
     });
  });
  $(document).mouseup(function (e){
      var containerLocation = $("#plan-location-list");
      if (!containerLocation.is(e.target) // if the target of the click isn't the container...
          && containerLocation.has(e.target).length === 0) // ... nor a descendant of the container
      {
          containerLocation.slideUp();
      }
  });
  // /////////////////Plan page javascript End Here //////////////////////////////////////////////////////////  
}); 
 var cot = window.matchMedia( "(min-width: 767px)" );
 if (cot.matches){
    var homeWidth = $('#home-locations').width();
    var businessWidth = $('#business-locations').width();
    $("#bottom-bar").width(homeWidth);
    $("#bottom-bar").css({"background-color": "yellow", "right": 180});
    $('#home-locations').addClass('active-home-business-links');
    $('#business-locations').click(function(){
      $("#bottom-bar").animate({right: "30px"});
      $('#home-locations').removeClass('active-home-business-links');
      $(this).addClass('active-home-business-links');
      $('#residential').hide();
      $('#business').fadeIn();
    });
    $('#home-locations').click(function(){
       $("#bottom-bar").animate({right: "180px"});
       $('#business-locations').removeClass('active-home-business-links');
       $(this).addClass('active-home-business-links');
       $('#business').hide();
      $('#residential').fadeIn();
    });
 }else{
  var homeWidth = $('#home-locations').width();
  var businessWidth = $('#business-locations').width();
  $("#bottom-bar").width(homeWidth);
  $("#bottom-bar").css({"background-color": "yellow", "right": 160});
  $('#home-locations').addClass('active-home-business-links');
  $('#business-locations').click(function(){
    $("#bottom-bar").animate({right: "30px"});
    $('#home-locations').removeClass('active-home-business-links');
    $(this).addClass('active-home-business-links');
    $('#residential').hide();
    $('#business').fadeIn();
  });
  $('#home-locations').click(function(){
     $("#bottom-bar").animate({right: "160px"});
     $('#business-locations').removeClass('active-home-business-links');
     $(this).addClass('active-home-business-links');
     $('#business').hide();
    $('#residential').fadeIn();
  });
 }
// /////////////////contact page javascript End Here //////////////////////////////////////////////////////////
$('.group').hide();
$('#111').show();
$("#custom-text-field").text($('#slider-list li:first-child').text());
$("#custom-text-field,#find-location").click(function(){
    $("#slider-list").show().addClass('animated bounceIn');
    $("#slider-list li").each(function(){
        $(this).click(function(){
            // alert($(this).val());
            $("#custom-text-field").text($(this).text());
            $(".group").hide();
            $('#'+$(this).val()).show().addClass('animated bounceInLeft');
            $("#slider-list").slideUp();
        });
    });
});

$(document).mouseup(function (e){
    var container = $("#slider-list");
    if (!container.is(e.target) // if the target of the click isn't the container...
        && container.has(e.target).length === 0) // ... nor a descendant of the container
    {
        container.hide();
    }
});

$("#slider-list li:nth-child(1)").val("111");
$("#slider-list li:nth-child(2)").val("113");
$("#slider-list li:nth-child(3)").val("114");
$("#slider-list li:nth-child(4)").val("115");
// /////////////////contact page javascript End Here //////////////////////////////////////////////////////////