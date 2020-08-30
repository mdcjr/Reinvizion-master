$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $('.settings-header span').bind("click", function(){
    if(!$(this).hasClass("active")){
      prevDiv = $('.settings-header span.active');
      curDiv = $(this);

      $('.settings-containers .container.' + prevDiv.attr("value")).fadeOut(350);
      setTimeout( function() { 
        $('.settings-containers .container.' + curDiv.attr("value")).fadeIn(350);
      }, 350 );

      prevDiv.removeClass("active");
      curDiv.addClass("active");
    }
  });

  var pathname = window.location.href;

  values=pathname.split('#');

  if(values[1] != undefined) {
    $(".settings-header span.subsc").trigger("click");
  }

  $(".settings-containers .contact.container p button").bind('click', function(){
    user_obj = {
      email: $(".contact.container #email").val(),
      phone: $(".contact.container #phone").val(),
      addr: $(".contact.container #addr").val(),
      city: $(".contact.container #city").val(),
      state: $(".contact.container #state").val()
    };
    $.ajax({
      type: "POST",
      url: '/updateUserContact',
      data: user_obj,
      success: function( msg ) {
        location.reload();
      }
    });
  });

  $(".settings-containers .container.notif .checkbox").bind("click", function(){
    if($(this).hasClass("enabled"))
      $(this).removeClass("enabled");
    else
      $(this).addClass("enabled");
  });

  $(".settings-containers .container.notif .save-button button").bind("click", function(){
    direct = 0;
    feedback = 0;
    comment = 0;
    connect = 0;
    classmate = 0;

    if($(".container.notif .checkbox.direct ").hasClass("enabled")) {
      direct = 1;
    }
    if($(".container.notif .checkbox.feedback ").hasClass("enabled")) {
      feedback = 1;
    }
    if($(".container.notif .checkbox.comment ").hasClass("enabled")) {
      comment = 1;
    }
    if($(".container.notif .checkbox.connect ").hasClass("enabled")) {
      connect = 1;
    }
    if($(".container.notif .checkbox.classmate ").hasClass("enabled")) {
      classmate = 1;
    }


    obj = {
      direct: direct,
      feedback: feedback,
      comment: comment,
      connect: connect,
      classmate: classmate
    };

    $.ajax({
      type: "POST",
      url: '/updateUserSettings',
      data: obj,
      success: function( msg ) {
        location.reload();
      }
    });
  });

  //Save coupon
  $(".coupon").click(function(){
    var coupon = $("#coupon").val();
    if(coupon === "prelaunch" || coupon === "PRELAUNCH"){
      $.ajax({
        type: "POST",
        url: "/updateCoupon",
        data: {coupon:1},
        cache:false,
        success:function( msg ) {
          $('#promoModal').modal('show');
        },
        error: function (xhr, ajaxOptions, thrownError) {
         console.log(xhr.status);
         console.log(xhr.responseText);
         console.log(thrownError);
        }
      });
    }else{
      $('#promoError').modal('show');
    }
  });

  $("#promoModal .done-button").bind("click", function(){
    $("form.second span").trigger("click");
    $('#promoModal').modal('dismiss');
  });

  $("#cancel").bind("click", function(){
    $.ajax({
      type: "POST",
      url: "/cancellation",
      success:function(msg){
        $('#successCancel').modal('show');
      }
    });
  });

});

