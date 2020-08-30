$(document).ready(function(){

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  height = $(".container-fluid").height();
  $(".sidebar .sidebar-header").height(height);

  diffWidth = ($("#header_user_name").width() - $(".profile-dropdown").width())/2;
  $(".profile-dropdown").css("margin-left", diffWidth + "px");

  diffWidth = ($(".user-notif-count").width() - $('.notif-dropdown').width())/2;
  $(".notif-dropdown").css("margin-left", diffWidth + "px");

  $(".sidebar-container .course-section:first").addClass('active');
  var iframe = $('.video-container iframe.vimeo-video');

  $(".row-summary .summary-title").text($(".sidebar-container .course-section.active").text());

  fetchSubComments();

  // if($('.video-container iframe.vimeo-video').length > 0) {
  //   var player = new Vimeo.Player(iframe);

  //   // $(".video-container #" + $(".sidebar-container .course-section.active").attr("value") ).show();

  //   isDone = false;
  //   player.on('ended', function() {
  //     if(!isDone) {
  //       isDone = true;
  //       // $.ajax({
  //       //   type: "POST",
  //       //   url: '/fetchSectionVideo',
  //       //   data: {course_id: $('#course_value').attr("value"), section_index: iframe.attr('section')},
  //       //   success: function( section ) {
  //       //     addSection(section);
  //       //   }
  //       // });
  //     }
  //   });
  // }

  $(".sidebar-header button").bind("click", function(e){
    e.preventDefault();
    $(".sidebar li:first").animate({ 'margin-left': '-' + $('.sidebar li:first').width() + 'px' }, 350);
  });
  $(".sidebar .text-container p").bind("click", function(e){
    e.preventDefault();

    $(".sidebar li:first").animate({ 'margin-left': '0px' }, 350);
  });

  $("#header_user_name").bind("click", function(e) {
    e.preventDefault();
    $(".first .profile-dropdown").animate({height:'toggle'},350);

    div = $(".first .profile-dropdown");
    if(div.hasClass("shown")) {
      div.removeClass("shown");
    }
    else {
      div.addClass("shown");
    }

    if($(".first .notif-dropdown").hasClass("shown")) {
      $(".first .notif-dropdown").animate({height:'toggle'},350).removeClass("shown");
    }
  });
  $(".first .user-notif-count").bind("click", function(e) {
    e.preventDefault();
    $(".first .notif-dropdown").animate({height:'toggle'},350);
    
    div = $(".first .notif-dropdown");
    if(div.hasClass("shown")) {
      div.removeClass("shown");
    }
    else {
      div.addClass("shown");
    }

    if($(".first .profile-dropdown").hasClass("shown")) {
      $(".first .profile-dropdown").animate({height:'toggle'},350).removeClass("shown");
    }
  });

  $(".span-user-name").bind("click", function(e) {
    e.preventDefault();
    $(".second .profile-dropdown").animate({height:'toggle'},350);

    div = $(".second .profile-dropdown");
    if(div.hasClass("shown")) {
      div.removeClass("shown");
    }
    else {
      div.addClass("shown");
    }

    if($(".second .notif-dropdown").hasClass("shown")) {
      $(".second .notif-dropdown").animate({height:'toggle'},350).removeClass("shown");
    }
  });

  $(".second .user-notif-count").bind("click", function(e) {
    e.preventDefault();
    $(".second .notif-dropdown").animate({height:'toggle'},350);
    
    div = $(".second .notif-dropdown");
    if(div.hasClass("shown")) {
      div.removeClass("shown");
    }
    else {
      div.addClass("shown");
    }

    if($(".second .profile-dropdown").hasClass("shown")) {
      $(".second .profile-dropdown").animate({height:'toggle'},350).removeClass("shown");
    }
  });


  $('.section-left').height($(".row-profile").height());

  $(".sidebar-container .course-section").on("click", function() {

    if(!$(this).hasClass("active")) {

      $(".row-summary .summary-title").text($(this).text());

      // $(".video-container iframe.vimeo-video").hide();

      $(".sidebar-container .course-section").removeClass('active');
      $(this).addClass('active');

      // key = $(this).attr("value");
      // iframe = $(".video-container #" + key);

      // iframe.show();

      // isDone = false;
      // if(iframe.length) {
      //   player = new Vimeo.Player(iframe);

      //   player.on('ended', function() {
      //     if(!isDone) {
      //       isDone = true;
      //       // $.ajax({
      //       //   type: "POST",
      //       //   url: '/fetchSectionVideo',
      //       //   data: {course_id: $('#course_value').attr("value"), section_index: iframe.attr('section')},
      //       //   success: function( section ) {
      //       //     addSection(section);
      //       //   }
      //       // });
      //     }
      //   });

      // }
      $( ".section-discussions .comments-container" ).empty();
      fetchSubComments();
    }
  });

  $(".next-section").bind("click", function(){
    // target = $(this).attr("target");
    // alert(target);
    if(!$(this).hasClass("inactive")) {
      prevDiv = $('.section-container.active');
      curDiv = $('.section-container.' + $(this).attr("target"));

      prevDiv.fadeOut(350);
      setTimeout( function() { 
        curDiv.fadeIn(350);
      }, 350 );

      prevDiv.removeClass("active");
      curDiv.addClass("active");

      $(".sidebar-container .section-container." + $(this).attr("target") + " .course-section:first").trigger("click");
    }
  });

  function addSection(section) {
    // html_body = '<iframe class="vimeo-video" section=' + (parseInt(iframe.attr('section')) + 1) + ' id="video' + section.id +
    // '" frameborder="0" src="//player.vimeo.com/video/' + section.video_url + '"></iframe>';
    // $( ".video-container .video" ).append( html_body );
  }
  
  $("#message-save").bind("click", function(event) {
    event.preventDefault();

    comment = $(".add-comment").val();

    sub_id = $(".sidebar-container .course-section.active").attr("sub-id");

    if(sub_id != undefined){
      if($.trim(comment) != "") {

        $.ajax({
          type: "POST",
          url: '/addComment',
          data: {comment: comment, course_id: $('#course_value').attr("value"), reply_id: 0, sub_id: sub_id},
          success: function( msg ) {
              // alert(msg.body)
            html_body="<div class='container-duscussion'>"+
                "<div class='col-lg-1' style='padding:0;'>"+
                "  <div class='image'>"+
                "   <img src=" + $("#image_value").attr("value") + "></img>"+
                "  </div>"+
                "</div>"+
                "<div class='col-lg-11 discuss-body'>"+
                "  <p class='discuss-body-title'>" + $("#name_value").attr("value") + " | <span>MONTH/DAY | TIME</span></p>"+
                "  <p class='discuss-body-message'>"+ msg.body +"  </p>"+
                "  <div class='row row-" + msg.id + " reply-container' style='margin:30px 0 0;''>"+
                "    <div class='col-lg-1' style='padding:0;''>"+
                "    </div>"+
                "    <div class='col-lg-11 discuss-body'>"+
                "      <textarea reply_id=" + msg.id + " row='row-" + msg.id + "' placeholder='Write a reply...'></textarea>"+
                "    </div>"+
                "  </div>"+
                "</div>"+
              "</div>";

            $( ".section-discussions .comments-container" ).append( html_body );
            // $( html_body ).insertBefore($(".view-all.comments"));
            $(".add-comment").val('');

            changeHeight();

          }
        });
      }
    }
    else {
      alert("Course has no subsections to comment on.");
    }
  });

  // $(document).on("keypress", ".discuss-body textarea", function () {
  //   if (event.which == 13) {
      
  //     if($.trim($(this).val()) != "") {
  //       textareaThis = this;
  //       reply_id = $(this).attr("reply_id");
  //       sub_id = $(".sidebar-container .course-section.active").attr("sub-id");
  //       $.ajax({
  //         type: "POST",
  //         url: '/addComment',
  //         data: {comment: $(textareaThis).val(), course_id: $('#course_value').attr("value"), reply_id: parseInt(reply_id), sub_id: sub_id},
  //         success: function( msg ) {

  //           html_body="<div class='row' style='margin:30px 0 0;'>"+
  //                 "<div class='col-lg-1 discussion-col' style='padding:0;'>"+
  //                 "  <div class='image'>"+
  //                 "   <img src=" + $("#image_value").attr("value") + "></img>"+
  //                 "  </div>"+
  //                 "</div>"+
  //                 "<div class='col-lg-11 discuss-body discussion-col'>"+
  //                 "  <p class='discuss-body-title'>" + $("#name_value").attr("value") + " | <span>MONTH/DAY | TIME</span></p>"+
  //                 "  <p class='discuss-body-message'>"+ $(textareaThis).val() +"  </p>"+
  //                 "</div>"+
  //               "</div>";
  //           $( html_body ).insertBefore($("." + $(textareaThis).attr("row")));
  //           $(textareaThis).val('');

  //           changeHeight();
  //         }
  //       });
  //     }
  //     event.preventDefault();
  //   }
  // });
  
  $(document).on('click', '.discuss-body button',function (){
    thisButton = $(this);
    row = $(this).attr("row");
    textareaThis = $("." + row + " .discuss-body textarea");
    sub_id = $(".sidebar-container .course-section.active").attr("sub-id");
    if($.trim($(textareaThis).val()) != ""){
      reply_id = $(textareaThis).attr("reply_id");
      $.ajax({
        type: 'POST',
        url: '/addComment',
        data: {comment: $(textareaThis).val(), course_id: $('#course_value').attr("value"), reply_id: parseInt(reply_id), sub_id: sub_id},
        success: function(msg){
          html_body="<div class='row' style='margin:30px 0 0;'>"+
                    "<div class='col-lg-1 discussion-col' style='padding:0;'>"+
                    "  <div class='image'>"+
                    "   <img src=" + $("#image_value").attr("value") + "></img>"+
                    "  </div>"+
                    "</div>"+
                    "<div class='col-lg-11 discuss-body discussion-col'>"+
                    "  <p class='discuss-body-title'>" + $("#name_value").attr("value") + " | <span>MONTH/DAY | TIME</span></p>"+
                    "  <p class='discuss-body-message'>"+ $(textareaThis).val() +"  </p>"+
                    "</div>"+
                  "</div>";
              $( html_body ).insertBefore($("." + $(textareaThis).attr("row")));
              $(textareaThis).val('');

              changeHeight();
        }
      });
    }
    event.preventDefault();
  });

  $('.view-all.comments.main .view-all-button').on('click', function(e){
    thisButton = $(this);
    $(this).hide();
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: '/fetchComments',
      data: {course_id: $('#course_value').attr("value"), index: thisButton.attr("index")},
      success: function( result ) {
        counter = 0;

        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $.each(result.comments, function(i, message) {
          if(!($(".row-" + message.comment.id + "").length > 0)) {
            // from = message.comment.created_at.split("-");
            d = new Date(message.comment.created_at);

            var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
            var time = d.toLocaleTimeString().toLowerCase();

            // console.log(date + " at " + time);
            // console.log(result.replies[counter].body);
            html_body="<div class='container-duscussion'>"+
              "<div class='col-lg-1' style='padding:0;'>"+
              "  <div class='image'>"+
              "   <img src=" + message.image + "></img>"+
              "  </div>"+
              "</div>"+
              "<div class='col-lg-11 discuss-body'>"+
              "  <p class='discuss-body-title'>" + message.name + " | <span>" + month[d.getMonth()] + "/" + d.getDate() + " | " + time + "</span></p>"+
              "  <p class='discuss-body-message'>"+ message.comment.body +"  </p>" +
              "  <div class='row row-" + message.comment.id + " reply-container' style='margin:30px 0 0;''>"+
              "    <div class='col-lg-1' style='padding:0;''>"+
              "    </div>"+
              "    <div class='col-lg-11 discuss-body'>"+
              "      <textarea reply_id=" + message.comment.id + " row='row-" + message.comment.id + "' placeholder='Write a reply...'></textarea>"+
              "    </div>"+
              "  </div>"+
              "</div>"+
            "</div>";

            $( html_body ).insertBefore($(".view-all.comments.main"));
            changeHeight();

            counter = counter + 1;
          }

        });
        $.each(result.replies, function(i, replies) {
          $.each(replies, function(i, reply){
            d = new Date(reply.reply.created_at);

            var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
            var time = d.toLocaleTimeString().toLowerCase();

            html_body="<div class='row' style='margin:30px 0 0;'>"+
                  "<div class='col-lg-1 discussion-col' style='padding:0;'>"+
                  "  <div class='image'>"+
                  "   <img src=" + reply.image + "></img>"+
                  "  </div>"+
                  "</div>"+
                  "<div class='col-lg-11 discuss-body discussion-col'>"+
                  "  <p class='discuss-body-title'>" + reply.name + " | <span>" + month[d.getMonth()] + "/" + d.getDate() + " | " + time + "</span></p>"+
                  "  <p class='discuss-body-message'>"+ reply.reply.body +"  </p>"+
                  "</div>"+
                "</div>";
            $( html_body ).insertBefore($(".row-" + reply.reply.reply_id));
          });
        });

        if(counter >= 10) {
          thisButton.attr("index", parseInt(thisButton.attr("index")) + counter);
          thisButton.show();
        }

        changeHeight();

      },
      error: function(obj){
        // alert(JSON.stringify(obj))
        console.log(obj.responseText.replace(/\"/g, ""));
      }
    });
  });

  $('.container-duscussion .view-all-button').on('click', function(e) {
    thisButton = $(this);
    $(this).hide();
    e.preventDefault();
    var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $.ajax({
      type: "POST",
      url: '/fetchReplies',
      data: {comment_id: thisButton.attr("comment_id"), index: thisButton.attr("index")},
      success: function( result ) {
        // console.log(result);
        counter = 0;
        $.each(result, function(i, reply){
          d = new Date(reply.reply.created_at);

          var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
          var time = d.toLocaleTimeString().toLowerCase();

          html_body="<div class='row' style='margin:30px 0 0;'>"+
                "<div class='col-lg-1 discussion-col' style='padding:0;'>"+
                "  <div class='image'>"+
                "   <img src=" + reply.image + "></img>"+
                "  </div>"+
                "</div>"+
                "<div class='col-lg-11 discuss-body discussion-col'>"+
                "  <p class='discuss-body-title'>" + reply.name + " | <span>" + month[d.getMonth()] + "/" + d.getDate() + " | " + time + "</span></p>"+
                "  <p class='discuss-body-message'>"+ reply.reply.body +"  </p>"+
                "</div>"+
              "</div>";
          $( html_body ).insertBefore(thisButton.parent(".view-all.comments"));
          counter = counter + 1;
        });

        if(counter >= 5) {
          thisButton.attr("index", parseInt(thisButton.attr("index")) + counter);
          thisButton.show();
        }

        changeHeight();
      },
      error: function(obj){
        // alert(JSON.stringify(obj))
        console.log(obj.responseText.replace(/\"/g, ""));
      }
    });
  });

  $('.send-assignment-popup #submit').bind("click", function() {
    $(".send-assignment-popup .loading").show();
    videoID = $('.send-assignment-popup #url').val();
    videoUrl = videoID.replace("watch?v=", "embed/");
    image_url = "http://img.youtube.com/vi/" + videoID + "/0.jpg";
    $.ajax({
      type: "POST",
      url: '/addUserVideo',
      data: {course_id: $('#course_value').attr("value"), url: videoUrl},
      success: function( result ) {
        location.reload();
        $(".send-assignment-popup .loading").hide();
      }
    });
  });

  function fetchSubComments() {
    sub_id = $(".sidebar-container .course-section.active").attr("sub-id");
    $.ajax({
      type: "POST",
      url: '/fetchSubComments',
      data: {sub_id: sub_id, index: 0, subIndex: $(".sidebar-container .course-section.active").attr("index")},
      success: function( result ) {
        // console.log("something 1");
        counter = 0;
        subSection = result.subSection;

        $(".summary-body").text(subSection.summary);

        $( ".video-container.main .video" ).empty();

        if(subSection.video_url != "") {

          html_body = '<iframe class="vimeo-video" frameborder="0" src="//player.vimeo.com/video/' + subSection.video_url + '"></iframe>';
          $( ".video-container.main .video" ).append( html_body );

          iframe = $(".video-container.main .video .vimeo-video");

          // iframe.attr("src", "//player.vimeo.com/video/" + subSection.video_url);

          iframe.show();

          player = new Vimeo.Player(iframe);

          isDone = false;

          iframe.load(function(){
            // player.on('play', function(data){
            //   console.log('play');
            // });
            player.on('ended', function() {
              if(!isDone) {
                isDone = true;
                // $.ajax({
                //   type: "POST",
                //   url: '/fetchSectionVideo',
                //   data: {course_id: $('#course_value').attr("value"), section_index: iframe.attr('section')},
                //   success: function( section ) {
                //     addSection(section);
                //   }
                // });
                console.log("something 3")
                $.ajax({
                  type: "POST",
                  url: '/viewSubsection',
                  data: {sub_section_id: $('.course-section.active').attr("sub-id"), section_index: $('.course-section.active').attr("index")},
                  success: function( result ) {
                    // alert(result.is_last);
                    if(result.is_last && !$(".section-container.active .section-countdown").length > 0) {
                    // if(result.is_last == "true"){
                      $('.section-container.active .next-section').removeClass("inactive");
                    }
                    // addSection(section);
                  }
                });
              }
            });
          });
        }

        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $.each(result.comments, function(i, message) {
          if(!($(".row-" + message.comment.id + "").length > 0)) {
            // from = message.comment.created_at.split("-");
            if(navigator.userAgent.indexOf("Firefox") !=-1) {
              d = new Date(message.comment.created_at.replace(/-/g , " "));
              console.log("firefox");
            }
            else if(navigator.userAgent.indexOf("Safari") !=-1) {
              d = new Date(message.comment.created_at.replace(/-/g, "/"));
              console.log("safari");
            }
            else{
              d = new Date(message.comment.created_at);
              console.log("not firefox and safari");
            }

            var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
            var time = d.toLocaleTimeString().toLowerCase();

            console.log(date + " at " + time);
            console.log("created at " + message.comment.created_at);
            // console.log(result.replies[counter].body);
            html_body="<div class='container-duscussion'>"+
              "<div class='col-lg-1' style='padding:0;'>"+
              "  <div class='image'>"+
              "   <img src=" + message.image + "></img>"+
              "  </div>"+
              "</div>"+
              "<div class='col-lg-11 discuss-body'>"+
              "  <p class='discuss-body-title'>" + message.name + " | <span>" + month[d.getMonth()] + "/" + d.getDate() + " | " + time + "</span></p>"+
              "  <p class='discuss-body-message'>"+ message.comment.body +"  </p>" +
              "  <div class='row row-" + message.comment.id + " reply-container' style='margin:30px 0 0;''>"+
              "    <div class='col-lg-1' style='padding:0;''>"+
              "    </div>"+
              "    <div class='col-lg-11 discuss-body'>"+
              "      <textarea reply_id=" + message.comment.id + " row='row-" + message.comment.id + "' placeholder='Write a reply...'></textarea>"+
              "       <button type='button' id='reply-save' class='reply-save-button' row='row-" + message.comment.id + "' style='margin: 15px 0 0 450px; border: 1px solid; border-color:"+
              "          #ff0586; background-color: white; color: #ff0586;' >SUBMIT</button>"+
              "    </div>"+
              "  </div>"+
              "</div>"+
            "</div>";

            $( ".section-discussions .comments-container" ).append( html_body );

            counter = counter + 1;
          }

        });
        $.each(result.replies, function(i, replies) {
          $.each(replies, function(i, reply){
            if(navigator.userAgent.indexOf("Firefox") !=-1) {
              d = new Date(reply.reply.created_at.replace(/-/g , " "));
              console.log("firefox");
            }
            else if(navigator.userAgent.indexOf("Safari") !=-1) {
              d = new Date(reply.reply.created_at.replace(/-/g, "/"));
              console.log("safari");
            }
            else{
              d = new Date(reply.reply.created_at);
              console.log("not firefox and safari");
            }
            
            var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
            var time = d.toLocaleTimeString().toLowerCase();

            html_body="<div class='row' style='margin:30px 0 0;'>"+
                  "<div class='col-lg-1 discussion-col' style='padding:0;'>"+
                  "  <div class='image'>"+
                  "   <img src=" + reply.image + "></img>"+
                  "  </div>"+
                  "</div>"+
                  "<div class='col-lg-11 discuss-body discussion-col'>"+
                  "  <p class='discuss-body-title'>" + reply.name + " | <span>" + month[d.getMonth()] + "/" + d.getDate() + " | " + time + "</span></p>"+
                  "  <p class='discuss-body-message'>"+ reply.reply.body +"  </p>"+
                  "</div>"+
                "</div>";
            $( html_body ).insertBefore($(".row-" + reply.reply.reply_id));
          });
        });

        if(counter >= 10) {
          thisButton.attr("index", parseInt(thisButton.attr("index")) + counter);
          thisButton.show();
        }

        changeHeight();

      },
      error: function(obj){
        // alert(JSON.stringify(obj))
        console.log(obj.responseText.replace(/\"/g, ""));
      }
    });
  }
  
  function changeHeight() {
    $('.section-left').height("auto");
    $(".sidebar .sidebar-header").height("auto");
    $('.section-left').height($(".row-profile").height());
    height = $(".container-fluid").height();
    $(".sidebar .sidebar-header").height(height);
  }
});

