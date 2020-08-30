$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('#term-button').trigger('click');

  $('.term-modal .term-container').bind('scroll', chk_scroll);

  $("#member-button").bind("click", function() {
    checkSignInForm();
  });

  $('.login #email, .login #password').bind("input", function(){
    checkSignInForm();
  });

  $(".terms .agree-term .checkbox").bind("click", function(){
    if(!$('.term-modal .terms').hasClass("disabled")) {
      if($(this).hasClass("enabled")) {
        $(".terms .agree-term .checkbox span").css("visibility", "hidden");
        $(this).removeClass("enabled");
        // $(".term-modal p button#submit").addClass("disabled");
        // $(".term-modal p button#submit").prop('disabled', true);
        // $(".term-modal .submit-button").addClass("disabled");
        checkTermsState();
      }
      else {
        $(".terms .agree-term .checkbox span").css("visibility", "visible");
        $(this).addClass("enabled");
        // $(".term-modal p button#submit").removeClass("disabled");
        // $(".term-modal p button#submit").prop('disabled', false);
        // $(".term-modal .submit-button").removeClass("disabled");
        checkTermsState();
      }
    }
  });

  $(".term-modal #signature").bind("input", function(){
    checkTermsState();
  });

  $(".business-hub p button.btn-primary").bind("click", function(){
    $(".register-popup #occupation").text($(".business-hub #user_occupation").val()).attr("value",$(".business-hub #user_occupation").val());
    $(".register-popup #user_type").text($(".business-hub #user_type").val()).attr("value",$(".business-hub #user_type").val());
  });

  $(".business-hub #user_type").bind("change", function(){
    if($(this).val() == "Student"){
      $(".business-hub #user_occupation").attr("placeholder", "MAJOR");
    }
    else if($(this).val() == "Business Owner") {
      $(".business-hub#user_occupation").attr("placeholder", "BUSINESS TYPE");
    }
    else {
      $(".business-hub #user_occupation").attr("placeholder", "OCCUPATION");
    }
  });
  $(".business-academy #user_type").bind("change", function(){
    if($(this).val() == "Aspiring Entrepreneur"){
      $(".business-academy #user_occupation").attr("placeholder", "OCCUPATION");
    }
  });
  $(".business-academy button.btn-primary").bind("click", function(){
    $(".register-popup #occupation").text($(".business-academy #user_occupation").val()).attr("value",$(".business-academy #user_occupation").val());
    $(".register-popup #user_type").text($(".business-academy #user_type").val()).attr("value",$(".business-academy #user_type").val());
  });

  $(".video-popup .arrow-container span").bind("click", function(){

    if($(this).hasClass("collapsed")) {
      rotate = 180;
      curDeg = 0;
      $(this).removeClass("collapsed");
    }
    else {
      rotate = 0;
      curDeg = 180;
      $(this).addClass("collapsed");
    }

    $(this).animateRotate(rotate, curDeg);
    $(".video-popup .collapsible").animate({height:'toggle'},350);
  });

  $(".business-academy p button.btn-primary").bind('click', function(){
    var aspiringVideoSrc = "https://player.vimeo.com/video/215358462";
    $user_type = $(".business-academy #user_type").val();
    console.log("hello");
    $(".video-popup iframe").show();
    $(".video-popup p.elevating").text("ELEVATING YOUR TRANSITION IN LIFE");
    $("#secondModal .video-container > div").css("background-image", "none");
    $(".video-popup p.collapsible").hide();
    $(".video-popup p.collapsible").removeClass("collapsible");
    console.log($user_type);
    if ($user_type == "Aspiring Entrepreneur"){
      $(".video-popup iframe").attr('src',aspiringVideoSrc);
      $(".video-popup p.others-collapsible").addClass("collapsible");
    }

    $(".video-popup #user_type_value").text($user_type);
  });

  $(".business-hub p button.btn-primary ").bind('click', function(){
    // var studentVideoSrc = "https://player.vimeo.com/video/211799912";
    // var changeOfPaceVideoSrc = "https://player.vimeo.com/video/215357557";
    // var aspiringVideoSrc = "https://player.vimeo.com/video/215358462";
    // var businessVideoSrc = "";
    $user_type = $(".business-hub #user_type").val();
    console.log("yourself");
    $(".video-popup iframe").show();
    $(".video-popup p.elevating").text("ELEVATING YOUR TRANSITION IN LIFE");
    $("#secondModal .video-container > div").css("background-image", "none");
    $(".video-popup p.collapsible").hide();
    $(".video-popup p.collapsible").removeClass("collapsible");
    
    // if($user_type == "Student"){
    //   $(".video-popup iframe").attr('src',studentVideoSrc);
    //   $(".video-popup p.others-collapsible").addClass("collapsible");
    // } 
    // else if ($user_type == "Change of Pace"){
    //   $(".video-popup iframe").attr('src',changeOfPaceVideoSrc);
    //   $(".video-popup p.others-collapsible").addClass("collapsible");
    // } 
    //else 
    console.log($user_type);
    // if ($user_type == "Aspiring Entrepreneur"){
    //   $(".video-popup iframe").attr('src',aspiringVideoSrc);
    //   $(".video-popup p.others-collapsible").addClass("collapsible");
    // } else 
    if ($user_type == "Business Owner"){
      $(".video-popup p.business-owner-collapsible").addClass("collapsible");
      $(".video-popup iframe").hide();
      $(".video-popup p.elevating").text("A NEW WAY TO CONNECT WITH CUSTOMERS");
      $("#secondModal .video-container > div").css("background-image", "url('/images/business-owner.jpg')");
    } else if ($user_type == "Customer") {      
      $(".video-popup iframe").hide();
      $(".video-popup p.elevating").text("A NEW WAY TO CONNECT WITH BUSINESSES");
      $(".video-popup p.customer-collapsible").addClass("collapsible");
      $("#secondModal .video-container > div").css("background-image", "url('/images/consumer.jpg')");
    }

    $(".video-popup #user_type_value").text($user_type);
  });


  function checkSignInForm() {
    email = $.trim($('.login #email').val());
    pass = $.trim($('.login #password').val());
    if(email != "" && pass != "") {
      $('.login .button.login-submit').addClass("enabled").prop('disabled', false);
    }
    else {
      $('.login .button.login-submit').removeClass("enabled").prop('disabled', true);
    }
  }

  function checkTermsState(){
    flag = $(".terms .agree-term .checkbox").hasClass("enabled") && $.trim($(".term-modal #signature").val()) != "";
    if( flag ) {
      $(".term-modal .submit-button").removeClass("disabled");
    }
    else {
      $(".term-modal .submit-button").addClass("disabled");
    }
  }

  $.fn.animateRotate = function(angle, curDeg, duration, easing, complete) {
    return this.each(function() {
      var $elem = $(this);

      $({deg: curDeg}).animate({deg: angle}, {
        duration: duration,
        easing: easing,
        step: function(now) {
          $elem.css({
             transform: 'rotate(' + now + 'deg)'
           });
        },
        complete: complete || $.noop
      });
    });
  };

  $("form.forgot-password").on('submit', function(event) {
    event.preventDefault();

    $("form.forgot-password button").text("Please Wait...");

    $.ajax({
      type: $(this).attr("method"),
      url: $(this).attr("action"),
      data: $(this).serialize(),
      dataType: "json",
      success: function(data) {
        console.log("success");

        $("form.forgot-password button").text("Submit");

        var error = JSON.parse(data).error;

        if (error != '') {
          $("form.forgot-password span.help-block").append("<strong style='padding-top: 5px;'>"+ error +"</strong>");
        } else {
          $("#forgotPasswordModal button.close").trigger('click');
          $(".modal-backdrop").hide();
          $("#success-password-button").trigger('click');
        }
      },
      error: function(data) {
        console.log("error");

        $("form.forgot-password button").text("Submit");

        var error = JSON.parse(data).error;

        if (error != '') {
          $("form.forgot-password span.help-block").append("<strong style='padding-top: 5px;'>"+ error +"</strong>");
        }
      }
    });
  });

  $('#thirdModal form').submit(function(e) {
    var has_password_error = false;
    var has_age_error = false;

    if ($('#thirdModal form #password').val() != $('#thirdModal form #password-confirm').val()) {
      console.log('password did not match');
      has_password_error = true;
      $('#thirdModal form #password_error').empty();
      $('#thirdModal form #password_error').append('<span class="help-block">'+
        '<strong> *Your password must match re-enter password. </strong>'+
      '</span>');
    } else {
      has_password_error = false;
      $('#thirdModal form #password_error').empty();
    }

    var ndate = new Date();
    var mdate = new Date((ndate.getMonth()+1)+'/'+ndate.getDate()+'/'+(ndate.getFullYear()-18));
    var bdate = new Date($('#thirdModal form #birthdate').val());
    var birth_date = new Date((bdate.getMonth()+1)+'/'+bdate.getDate()+'/'+bdate.getFullYear());

    console.log('mdate: '+mdate);
    console.log('birth date: '+birth_date);

    if ( birth_date > mdate ) {
      has_age_error = true;
      // $('#thirdModal form #birthdate_error').empty();
      // $('#thirdModal form .age-warning').empty();
      // $('#thirdModal form #birthdate_error').append('<span class="help-block">'+
      //   '<strong> *Must be 18 years old to register. </strong>'+
      // '</span>');
    } else {
      has_age_error = false;
      // $('#thirdModal form #birthdate_error').empty();
    }

    if (has_password_error || has_age_error) {
      e.preventDefault();
    }
  })
  
});

function chk_scroll(e) {
  var elem = $(e.currentTarget);
  if (elem[0].scrollHeight - elem.scrollTop() == elem.innerHeight()) {
    $('.term-modal .terms').removeClass("disabled");
    $('.term-modal .terms button#submit').removeAttr("disabled");
  }
}

var rotation = 0;

jQuery.fn.rotate = function(degrees) {
    $(this).css({'transform' : 'rotate('+ degrees +'deg)'});
    return $(this);
};


