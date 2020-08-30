var has_uploaded_to_gallery = false;

$(document).ready(function(){
  isFirst = false;
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  user_name = $("input#user_name");
  profession = $("input#profession");
  school = $("input#school");
  degree = $("input#degree");
  city = $("input#city");
  state = $("input#state");
  website = $("input#website");

  newExpCount = 0;

  var dtToday = new Date();

  var month = dtToday.getMonth() + 1;
  var day = dtToday.getDate();
  var year = dtToday.getFullYear();

  if(month < 10)
      month = '0' + month.toString();
  if(day < 10)
      day = '0' + day.toString();

  var maxDate = year + '-' + month + '-' + day;    
  $(".edit-profile #birthdate").attr('max', maxDate);
  $(".prof-exp-popup #startDate").attr('max', maxDate);
  $(".prof-exp-popup #endDate").attr('max', maxDate);

  mainWidth = $(".container-fluid").width();
  margin = ($(".text-container").width() - $(".text-container p").width())/2;
  $(".sidebar .text-container p").attr("style", "margin-left:" + margin + "px;")
  $('.section-left').height($(".row-profile").height());

  diffWidth = ($("#header_user_name").width() - $(".profile-dropdown").width())/2;
  $(".profile-dropdown").css("margin-left", diffWidth + "px");

  diffWidth = ($(".user-notif-count").width() - $('.notif-dropdown').width())/2;
  $(".notif-dropdown").css("margin-left", diffWidth + "px");

  $(".sidebar-header button").bind("click", function(e){
    e.preventDefault();
    // $(".sidebar li:first").animate({ 'margin-left': '-' + $('.sidebar li:first').width() + 'px' }, 350);
    $('.sidebar').animate({'width': 'toggle'}, 350);
    // $('.main-body').animate({'width': mainWidth}, 350);
    $('.main-body').animate({'margin-left': (0.083 * mainWidth)}, 350);
    $('.journey-button').show();
  });
  $(".row-profile-header .text-container").bind("click", function(e){
    e.preventDefault();

    // add_width = (0.16*mainWidth)+'px';
    $('.sidebar').animate({'width': 'toggle'}, 350);
    // $('.main-body').animate({'width': (0.83 * mainWidth)}, 350);
    $('.main-body').animate({'margin-left': 0}, 350);
    $('.journey-button').hide();
    // $(".sidebar li:first").animate({ 'margin-left': '0px' }, 350);
    // $(".sidebar-header").animate({width:'toggle'},350);
    // $(".text-container").animate({width:'toggle'},350);
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

  // $(".row-profile-header p.edit-button").bind('click', function(){
  //   $('.profile-content p.profile-content span, .profile-content a, .row-profile-header h1#user_name').hide();
  //   $('.profile-content input, .row-profile-header input#user_name').show();
  //   $(this).hide();
  //   $(".row-profile-header p.save-button").show();
  //   $(".row-profile-header p.cancel-button").show();
  // });

  $(".row-profile-header .edit-button-container button").bind("click", function(){
    isFirst = false;
  });

  $(".edit-profile button#save").bind('click', function(){
    user_obj = {
      email: $(".edit-profile #email").val(),
      user_name: $(".edit-profile #user_name").val(),
      occupation: $(".edit-profile #occupation").val(),
      profession: $(".edit-profile #profession").val(),
      school: $(".edit-profile #school").val(),
      degree: $(".edit-profile #degree").val(),
      birthdate: $(".edit-profile #birthdate").val(),
      city: $(".edit-profile #city").val(),
      state: $(".edit-profile #state").val(),
      website: $(".edit-profile #website").val(),
      phone: $(".edit-profile #phone").val(),
      addr: $(".edit-profile #addr").val(),
      bio: $(".edit-profile #bio").val(),
      gender: $('.edit-profile #gender').val()
    };
    $.ajax({
      type: "POST",
      url: '/updateUser',
      data: user_obj,
      success: function( msg ) {
        // $(".row-profile-header p#user_occupation").text($(".edit-profile #occupation").val());
        // $(".profile-content span#profession").text($(".edit-profile #profession").val());
        // $(".edit-profile button.close").trigger("click");
        if(!isFirst)
          location.reload();
        else {
          $(".edit-profile button.close").trigger("click");
          $(".section-work .edit-button-container button").trigger("click");
        }
      }
    });
  });

  $('.prof-exp-popup .save-button #save').bind('click', function() {
    divs = $(".prof-exp-popup .experience-container").map(function(){return $(this).attr("id");}).get();
    newDivs = $(".prof-exp-popup .new-exp-container").map(function(){return $(this).attr("id");}).get();

    ids = [];
    $.each(divs, function(i, div) {
      parent = ".experience-" + div;
      ids.push({
        id: div,
        title: $(parent + " #title").val(),
        field: $(parent + " #field").val(),
        comp_name: $(parent + " #comp_name").val(),
        start_date: $(parent + " #startDate").val(),
        end_date: $(parent + " #endDate").val(),
        is_current: $(parent + " #current").is(":checked")
      });
    });

    newExps = [];
    $.each(newDivs, function(i, div) {
      parent = ".new-exp-" + div;
      newExps.push({
        id: div,
        title: $(parent + " #title").val(),
        field: $(parent + " #field").val(),
        comp_name: $(parent + " #comp_name").val(),
        start_date: $(parent + " #startDate").val(),
        end_date: $(parent + " #endDate").val(),
        is_current: $(parent + " #current").is(":checked")
      });
    });

    exp_obj = {
      ids:ids,
      newExps:newExps
    };

    $.ajax({
      type: "POST",
      url: '/saveUpdateExperience',
      data: exp_obj,
      success: function( msg ) {
        location.reload();
      }
    });
  });

  $(".prof-exp-popup .add-exp span").bind('click',function(){
    addExpDiv = $(this);
    cloneDiv = $(".default-exp-container").clone();
    cloneDiv.removeClass("default-exp-container");
    cloneDiv.addClass("new-exp-container");
    cloneDiv.addClass("new-exp-" + newExpCount);
    cloneDiv.attr("id", newExpCount);

    cloneDiv.insertBefore($(".prof-exp-popup .add-exp"));
    $('<hr class="hr-main"></hr>').insertBefore($(".prof-exp-popup .add-exp"));

    $(".new-exp-" + newExpCount + " #endDate").val(maxDate);
    $(".new-exp-" + newExpCount + " #startDate").val(maxDate);

    $(".new-exp-" + newExpCount + " #current").attr("row", "new-exp-" + newExpCount);

    newExpCount = newExpCount + 1;
  });

  $(document).on("change", ".prof-exp-popup #current", function () {
    parent = "." + $(this).attr("row");
    if($(this).is(":checked")) {
      $(parent + " #endDate").prop("disabled", true);
      $(parent + " #endDate").addClass('disabled');
      $(parent + " #endDate").val(maxDate);
    }
    else {
      $(parent + " #endDate").prop("disabled", false);
      $(parent + " #endDate").removeClass('disabled');
      $(parent + " #endDate").val(maxDate);
    }
  });
  $('.upload-image .browse-container').on('click', function() {
    if ($(this).hasClass('gallery-upload')) {
      if ($('.upload-image #gallery-image').val() == "") {
        $('.upload-image #gallery-image').trigger('click');
      }
    } else {
      $('.upload-image #image').trigger('click');
    }
  });

  $('.upload-image #image').bind("change", function(){
    var file = this.files[0];
    var reader = new FileReader();
    reader.onloadend = function () {
      $('.upload-image #current_image').css('background-image', 'url("' + reader.result + '")');
    }
    if (file) {
      reader.readAsDataURL(file);
    }
  })

  $('.upload-image #gallery-image').bind("change", function(){
    var file = this.files[0];
    var reader = new FileReader();
    reader.onloadend = function () {
      $(".browse-container.gallery-upload").css('background-image', 'url("' + reader.result + '")');
    }
    if (file) {
      reader.readAsDataURL(file);
    }

    if (file != undefined ) {
      $("#gallery-upload #clear-image").show();
      $(".browse-container.gallery-upload p").text('');
    }
  })

  $("#gallery-upload.modal .modal-content > button > span").on('click', function() {
    console.log('modal blur');
    if (has_uploaded_to_gallery == true) {
      has_uploaded_to_gallery = false;
      setTimeout(function() {
        console.log($("#gallery-upload.modal").css('display'));
        if ($("#gallery-upload.modal").css('display') == 'none') {
          $(".browse-container.gallery-upload").css('background-image', 'none');
          $(".browse-container.gallery-upload p").text('+ BROWSE IMAGE');
          // alert("Page will reload to display new uploaded images.");
          location.reload();
        }
      }, 800);
    }
  });

  $(".upload-image button#submit").bind('click', function(){
    $(".upload-image .loading").show();
    var uploadUrl = '/uploadFileToS3';
    var formData = new FormData();
    var is_gallery_upload = $(this).data('gallery-upload');
    var has_image = true;

    formData.append('is_gallery_upload', is_gallery_upload);

    if ( is_gallery_upload != undefined ) {
      console.log('upload is for gallery.');
      uploadUrl = "/business/uploadFileToS3";
      has_image = $('.upload-image #gallery-image')[0].files[0] != undefined;
      formData.append('image', $('.upload-image #gallery-image')[0].files[0]);
      formData.append('caption', $('#gallery-upload #business_image_caption').val());
    } else {
      has_image = $('.upload-image #image')[0].files[0] != undefined;
      formData.append('image', $('.upload-image #image')[0].files[0]);
    }
    
    // for (var value of formData.values()) {
    //    console.log(value); 
    // }
    
    if ( !has_image ) {
      console.log('no image');
      $(".upload-image .loading").hide();
      if (is_gallery_upload == undefined) {
        $("#upload-image .modal-header h6.message").text("Please select image to upload.");
      } else {
        $("#gallery-upload .modal-header h6.message").text("Please select image to upload.");
      }
      $(".modal-header h6.message").addClass('error');
      animate_gallery_upload_message();
    } else {
      console.log('upload image');
      $.ajax({
        type: "POST",
        url: uploadUrl,
        data : formData,
        processData: false,
        contentType: false,
        success: function( msg ) {
          if (is_gallery_upload == undefined ) {
            console.log("profile upload");
            $(".upload-image #current_image").attr("style", "background-image:url(" + msg + ");");
            $("#user_image").attr("style", "background-image:url(" + msg + ");");
          } else {
            console.log("gallery upload");
            has_uploaded_to_gallery = true;
            reset_image_upload_content();
            $("#gallery-upload .modal-header h6.message").text("Image Uploaded.");
            $(".browse-container.gallery-upload h6.message").css("color", "green");
            animate_gallery_upload_message();
          }

          $(".upload-image .loading").hide();
        },
        error: function( msg ) {
          console.log(msg);
          $(".modal-header h6.message").text("Failed to upload image.");
          $(".modal-header h6.message").addClass('error');
          $(".upload-image .loading").hide();
          animate_gallery_upload_message();
        }
      });
    }
  });

  $("#find-connections").bind("click", function(){

    $(".connection-container").empty();
    $.ajax({
      type: "POST",
      url: '/findUsers',
      success: function( result ) {
        $.each(result, function(i, user){
          console.log(user.name);
          // cloneDiv = $(".classmates-popup .connection-template .closed").clone();
          // cloneDiv.removeClass("closed");
          // cloneDiv.addClass("connection-user-" + user.id);

          connection_div = '<a href="/users/' + user.id + '" target="_blank">'+
            '<div class="img text-center">'+
              '<img style="background-image:url(' + user.image + ');"></img>'+
              '<h1 class="text-center" style="margin:10px 0 0;">' + user.name + '</h1>'+
              '<p class="text-center">' + user.profession + '</p>'+
            '</div>'+
          '</a>';
          $(".connection-container").append(connection_div);
        });
      }
    });
  })

  $(".sidebar .sidebar-header").height($('.main-body').height());
  $(window).on('resize', function(){
    $(".sidebar .sidebar-header").height($('.main-body').height());
  });

  $("#stackPopup #image_comment").on('keyup', function(event) {
    var comment_container = $(this);
    var img = $(comment_container.attr('data-image'));
    var likes_count = img.attr('data-likes-count');
    var comments_count = img.attr('data-comments-count');

    if (event.which == 13 && comment_container.val().match(/\S/) != null) {
      $.ajax({
        url: '/business/commentImage',
        type: 'POST',
        data: {'image_id': comment_container.attr('data-image-id'), 'comment': comment_container.val()},
        success: function(response){
          console.log(response);

          if (response.success == false) {
            $("#commentResponse").addClass('error');
          } else {
            comment_container.val('');
            var pagination = response.pagination;

            $('#stackPopup .comments-box').attr('data-page', pagination.page);
            $('#stackPopup .comments-box').attr('data-next-page', pagination.next_page);
            get_image_comments(parseInt(response.image_id), false);
          }

          // update image popup window likes and comments count label
          update_likes_comments_count(response.likes_count, response.comments_count, img);

          $("#commentResponse").text(response.message);
          animate_message($("#commentResponse"));
        },
        error: function(){
          $("#commentResponse").text("Failed to comment image. Internal Server Error.");
        }
      });
    }
  });

  $("#stackPopup span.like-control").on('click', function(){
    var like_control = $(this);
    var like_comment_str = $('#stackPopup .actions > h4').text();

    if (!like_control.hasClass('clicked')) {
      like_control.addClass('clicked');

      $.ajax({
        url: '/business/likeUnlikeImage',
        type: 'POST',
        data: {'image_id': like_control.attr('data-image-id')},
        success: function(response) {
          console.log(response);
          if (response.success == true) {
            if (like_control.hasClass('liked')) {
              console.log('unlike');

              var stack_image = $("#"+like_control.attr('data-image'));
              
              stack_image.attr("data-is-liked", "");
              like_control.removeClass('liked');

              update_likes_comments_count(response.likes_count, response.comments_count, stack_image);

              // $('#stackPopup .actions > h4').text(like_comment_str.replace(/[0-9]+ Likes/, response.likes_count+' Likes'));
              // stack_image.attr('data-likes-count', response.likes_count);
            } else {
              console.log('like');

              var stack_image = $("#"+like_control.attr('data-image'));
              
              stack_image.attr("data-is-liked", "1");
              like_control.addClass('liked');

              update_likes_comments_count(response.likes_count, response.comments_count, stack_image);

              // $('#stackPopup .actions > h4').text(like_comment_str.replace(/[0-9]+ Likes/, response.likes_count+' Likes'));
              // stack_image.attr('data-likes-count', response.likes_count);
            }
          }

          like_control.removeClass('clicked');
        },
        error: function(response) {
          like_control.removeClass('clicked');
        }
      });
    }
  });

  $('#stackPopup .actions > div > button').on('click', function(){
    console.log('stack button clicked');

    var stack_button = $(this);
    var url = '/business/stackImage';
    
    if (stack_button.hasClass('stacked')) {
      url = '/business/unstackImage';
    }

    var img_holder = $('#'+$('#stackPopup .like-control').attr('data-image'));
    stack_button.attr('disabled', true);

    $.ajax({
      url: url,
      type: 'POST',
      data: {'image_id': $('#stackPopup .like-control').attr('data-image-id')},
      success: function(response) {
        if (response.success) {
          var updated_stack_count = parseInt(stack_button.attr('data-updated-stack-count'));

          if (url == '/business/stackImage') {
            stack_button.text('UNSTACK');
            stack_button.addClass('stacked');
            img_holder.attr('data-stacked', 1);
            updated_stack_count = updated_stack_count += 1;
          } else {
            stack_button.text('STACK');
            stack_button.removeClass('stacked');
            img_holder.attr('data-stacked', 0);
            updated_stack_count = updated_stack_count -= 1;
          }

          stack_button.attr('data-updated-stack-count', updated_stack_count); 
        }

        stack_button.attr('disabled', false);
      },
      error: function(response) {
        stack_button.attr('disabled', false);
      }
    });
  });
});

function animate_gallery_upload_message() {
  setTimeout(function() {
    $(".modal-header h6.message").animate({
      height: 0
    }, 1000, function() {
      $(".modal-header h6.message").css("height", "auto");
      $(".modal-header h6.message").text("");
      $(".modal-header h6.message").removeClass('error');
    })
  }, 3000);
}

function remove_service(src) {
  var service = $(src).data('service');
  console.log('service: '+service);

  if(confirm("Remove service "+service+"?") == true) {
    $.ajax({
      type: 'POST',
      url: '/business/removeService',
      data: {'service': service},
      success: function(response) {
        console.log(response);
        console.log(response.length);

        if (response.length < 12) {
          $("#business-services").attr('placeholder', "type in keywords separated by comma. (max 12)");
          $("#business-services").attr('disabled', false);
        }

        $('.remove-service.'+service.trim()).parent('li.tag-item').remove();
        $('li.'+service.trim()).remove();
        $('div#business-tags ul').empty();

        if (response.length > 0 && response[0] != "") {
          for(var i=0; i<response.length; i++) {
            $('div#business-tags ul').append(
              '<li class="tag-item">'+
                response[i].toUpperCase()+
                '<span class="remove-service '+response[i]+'" data-service="'+response[i]+'" onclick="remove_service(this)"> X </span>'+
              '</li>'
            );

            if(i == 4) {
              i = response.length;
            }
          }
        }

        alert("Service removed.");
      },
      error: function(response) {
        alert("Internal Server Error. Failed to remove service.");
      }
    })
  } else {
    return false;
  }
}

function set_popup_image(image_index) {
  var img = $("#stack_image_"+image_index);
  var img_src = img.attr('src');
  var image_id = img.data('id');
  var comment_status = 'ON';
  var caption = img.attr('data-caption');

  if ( img.data('comments-enabled') == false ) { comment_status = 'OFF'; } 
  
  // process like status display of image

  if ( img.attr('data-is-liked') != "" ) {
    $("#stackPopup span.like-control").addClass('liked');
  } else {
    $("#stackPopup span.like-control").removeClass('liked');
  }

  // process stack status display of image

  var stack_button = $('#stackPopup .actions > div > button');

  if (img.attr('data-stacked') == true) {
    // stack_button.attr('disabled', true);
    stack_button.text('UNSTACK');

    stack_button.addClass('stacked');
  } else {
    stack_button.text('STACK');
    stack_button.removeClass('stacked');
  }

  // $("#stackPopup .actions > h4").text(likes_count+" Likes | "+comments_count+ " Comments");

  // set data attributes for the image popup window
  $("#stackPopup #image_comment").attr('data-image-id', image_id);
  $("#stackPopup #image_comment").attr('data-image', "#stack_image_"+image_index);
  $("#stackPopup span.like-control").attr('data-image-id', image_id);
  $("#stackPopup span.like-control").attr('data-image', img.attr('id'));
  $("#stackPopup .image-container img").attr("src", '');
  $("#stackPopup .image-container img").attr("src", img_src);
  $("#stackPopup #comment-status").text(comment_status);
  $('#stackPopup #image-caption').text(caption);

  if (img.attr('data-business-name') != undefined) {
    $('#uploaded-by').text('by '+img.attr('data-business-name'));
    $('#posted-by').text('Posted by '+img.attr('data-business-name'));
  }

  var likes_count = img.attr('data-likes-count');
  var comments_count = img.attr('data-comments-count');

  // update image popup window likes and comments count label
  update_likes_comments_count(likes_count, comments_count, img);
  // get image comments
  get_image_comments(image_id, false);
}

function disable_slider_arrow(image_index, image_count){
  if ( image_index == 1 && image_count > 1 ) {
    // console.log('disable left arrow');
    $("#stackPopup .slide-left").css("background-image", "url(/images/slider-arrow-left.png)");
    $("#stackPopup .slide-right").css("background-image", "url(/images/white-slider-arrow-right.png)");
  } else if (image_index == image_count && image_count != 1) {
    // console.log('disable right arrow');
    $("#stackPopup .slide-right").css("background-image", "url(/images/slider-arrow-right.png)");
    $("#stackPopup .slide-left").css("background-image", "url(/images/white-slider-arrow-left.png)");
  } else if (image_index != 1 && image_index < image_count) {
    // console.log('enable both arrows');
    $("#stackPopup .slide-right").css("background-image", "url(/images/white-slider-arrow-right.png)");
    $("#stackPopup .slide-left").css("background-image", "url(/images/white-slider-arrow-left.png)");      
  } else {
    // console.log('disable both arrows');
    $("#stackPopup .slide-left").css("background-image", "url(/images/slider-arrow-left.png)");
    $("#stackPopup .slide-right").css("background-image", "url(/images/slider-arrow-right.png)");
  }
}

function animate_message(msg_container) {
  setTimeout(function() {
    msg_container.animate({
      height: 0
    }, 1000, function() {
      msg_container.css("height", "auto");
      msg_container.text("");
      msg_container.removeClass('error');
    })
  }, 3000);
}

function reset_image_upload_content(){
  $("#gallery-upload #clear-image").hide();
  $('#gallery-upload #business_image_caption').val("");
  $('.upload-image #gallery-image').val("");
  $(".browse-container.gallery-upload").css('background-image', 'none');
  $(".browse-container.gallery-upload p").text('+ BROWSE IMAGE');
}

function update_likes_comments_count(likes_count, comments_count, img_holder) {  
  var likes_comments_str = $("#stackPopup .actions > h4, #stackPopup #like_comment_label").text();
  var like_text = ' Like';
  var comment_text = ' Comment';

  if (likes_count != -1) {

    if (likes_count > 1) {
      like_text = ' Likes'; 
    }

    like_text = likes_count.toString()+like_text;
    $('div.'+img_holder.attr('id')+'.like-label').text(likes_count);

    img_holder.attr('data-likes-count', likes_count);
    likes_comments_str = likes_comments_str.replace(/[0-9]+ Likes|[0-9]+ Like/, like_text);
  }


  if (comments_count != -1) {

    if (comments_count > 1) {
      comment_text = ' Comments';
    }

    comment_text = comments_count.toString()+comment_text;
    $('div.'+img_holder.attr('id')+'.comment-label').text(comments_count);

    img_holder.attr('data-comments-count', comments_count);
    likes_comments_str = likes_comments_str.replace(/[0-9]+ Comments|[0-9]+ Comment/, comment_text);
  }

  $("#stackPopup .actions > h4, #like_comment_label").text(likes_comments_str);
}

function view_more_comments() {
  var image_id = $('#stackPopup span.like-control').attr('data-image-id');

  get_image_comments(image_id, true)
}

function get_image_comments(image_id, append) {
  var url = '/business/imageComments'
  var li_view_more = "<li class='button' onclick='view_more_comments()'> View More </li>"
  var comments_container = $('#stackPopup .comments-box ul');
  var data = {'image_id': image_id};
  var image_id = image_id

  if (!append) { 
    comments_container.empty();
  } else {
    $("#stackPopup li.button").remove();
    data['page'] = $('#stackPopup .comments-box').attr('data-next-page')
  }

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    success: function(response) {
      if (response.success && image_id == $('#stackPopup span.like-control').attr('data-image-id')) {
        var pagination = response.pagination;

        $('#stackPopup .comments-box').attr('data-page', response.pagination.page);
        $('#stackPopup .comments-box').attr('data-next-page', response.pagination.next_page);

        for ( var datum of response.comments ) {
          var date = new Date(datum.created_at);
          var date_str = date.toString().match(/[A-Z][a-z]+\s\d+\s\d+/)[0];
          var time_str = date.toString().match(/\d{2}:\d{2}/)[0];

          comments_container.append(
            "<li>" +
              "<span>"+datum.user_name+"</span><span class='date-time'>"+date_str+' '+time_str+"</span>"+
              "<p>"+datum.comment+"</p>"+
            "</li>"
          );
        }

        if (pagination.total_pages > 1 && pagination.page < pagination.next_page) {
          comments_container.append(li_view_more);
        }

        if (pagination.total_pages < 1) {
          comments_container.append('<li> No Comments </li>');
        }
      }
    },
    error: function(response) {

    }
  })
}