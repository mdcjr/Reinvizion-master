$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".sidebar .sidebar-header").height($(".container-fluid").height());

  diffWidth = ($("#header_user_name").width() - $(".profile-dropdown").width())/2;
  $(".profile-dropdown").css("margin-left", diffWidth + "px");

  diffWidth = ($(".user-notif-count").width() - $('.notif-dropdown').width())/2;
  $(".notif-dropdown").css("margin-left", diffWidth + "px");

  $("#connect_button").bind("click", function(){
    sendConnectionRequest(true);
  });
  $("#disconnect_button").bind("click", function(){
    sendConnectionRequest(false);
  });

  $("#header_user_name").bind("click", function(e) {
    e.preventDefault();
    $(".profile-dropdown").animate({height:'toggle'},350);

    div = $(".profile-dropdown");
    if(div.hasClass("shown")) {
      div.removeClass("shown");
    }
    else {
      div.addClass("shown");
    }

    if($(".notif-dropdown").hasClass("shown")) {
      $(".notif-dropdown").animate({height:'toggle'},350).removeClass("shown");
    }
  });
  $(".user-notif-count").bind("click", function(e) {
    e.preventDefault();
    $(".notif-dropdown").animate({height:'toggle'},350);
    
    div = $(".notif-dropdown");
    if(div.hasClass("shown")) {
      div.removeClass("shown");
    }
    else {
      div.addClass("shown");
    }

    if($(".profile-dropdown").hasClass("shown")) {
      $(".profile-dropdown").animate({height:'toggle'},350).removeClass("shown");
    }
  });

  function sendConnectionRequest(isConnect){
    obj = {
      id: $("#user_id").val(),
      isConnect: isConnect
    };
    $.ajax({
      type: "POST",
      url: '/connectUsers',
      data: obj,
      success: function( msg ) {
        location.reload();
      }
    });
  }
});