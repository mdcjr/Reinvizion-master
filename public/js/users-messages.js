$(document).ready(function(){
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  readMessages();

  $(".inbox .user").bind("click", function(){
    curDiv = $(this);
    actDiv = $(".inbox .user.active");
    if(!curDiv.hasClass("active")) {
      actDiv.removeClass("active");
      curDiv.addClass("active");
      $(".current_conv." + curDiv.attr("row")).addClass("active");
      $(".current_conv." + actDiv.attr("row")).removeClass("active");
      readMessages();
    }
  });

  $(".conversation .reply-save-button").bind("click", function(){
    $.ajax({
      type: "POST",
      url: '/sendMessage',
      data: {comment: $('.add-comment.rec-com-' + $(this).attr("receiver")).val(), receiver_id: $(this).attr("receiver")},
      success: function( result ) {
        location.reload();
      }
    });
  });
  $("#find-users").bind("click", function(){

    $(".connection-container").empty();
    $.ajax({
      url: '/messages/findUsers',
      type: "GET",
      success: function( result ) {
        $.each(result, function(i, user){
          // console.log(user.name);
          // cloneDiv = $(".classmates-popup .connection-template .closed").clone();
          // cloneDiv.removeClass("closed");
          // cloneDiv.addClass("connection-user-" + user.id);

          connection_div = '<div class="img text-center" user="' + user.id + '">'+
              '<img style="background-image:url(' + user.image + ');"></img>'+
              '<h1 class="text-center" style="margin:10px 0 0;">' + user.name + '</h1>'+
              '<p class="text-center">' + user.profession + '</p>'+
            '</div>';
          $(".connection-container").append(connection_div);
        });
      }
    });
  });

  $(document).on("click", ".connection-container .img", function (){
    $.ajax({
      type: "POST",
      url: '/createConversation',
      data: {user_id: $(this).attr("user")},
      success: function( result ) {
        location.reload();
      }
    });
  });

  function readMessages() {
    $.ajax({
      type: "POST",
      url: '/readMessages',
      data: {convId: $('.current_conv.active').attr('convId')},
      success: function( result ) {
        // location.reload();
      }
    });
  }
});