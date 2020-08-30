@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <!-- <script src="/js/jquery.bxslider.min.js"></script> -->
  <script src="/js/users-profile.js"></script>
  <!-- <link href="/css/jquery.bxslider.css" rel="stylesheet" /> -->
  <style>
    .float-left { float: left; }
    .float-right { float: right; }

    .pagination {
      width: 100%;
      display: block;
      margin: auto;
      margin-top: 50px !important;
    }

    .pagination a {
      margin: 0 10px;
    }
  </style>
</head>
<div class="col-lg-12 main-body business-owner">  
  <div class="row row-footer business-owner">
    <div id="gallery" <?php if ($title != 'GALLERY') { echo ' class="business-owner stack-page"'; } ?> >
      <h1 class="text-center"> 
        <?php echo $title; ?> (<?php echo $images->count(); ?>) 
        <?php if ($current_user->user_type == 'Business Owner') { ?>
          <a style="cursor: pointer; text-decoration: none;" data-toggle="modal" data-target="#gallery-upload"> + upload an image </a> 
        <?php } ?>
      </h1>
      <div>
        <?php $index = 1; ?>
        <div id='image_count' data-count='<?php echo $images->count(); ?>' style='display:none;'></div>
        <?php foreach($images as $image) { ?>
          <div class="stack">
            <div class="image">
              <img id="stack_image_<?php echo $index; ?>" src="<?php echo $image->link; ?>" data-id='<?php echo $image->id; ?>' data-likes-count='<?php echo $image->likes()->count();?>' data-comments-count='<?php echo $image->comments()->count(); ?>' data-stacked="<?php echo $image->is_stacked_by_user($current_user->id); ?>" data-is-liked="<?php echo $image->is_liked_by_user($current_user->id); ?>" data-business-name="<?php echo $image->business()->first()->name; ?>" data-caption="<?php echo $image->caption; ?>">
            </div>
            <?php if ($title == "GALLERY") { ?>
              <div class="label">
                <p> ELEVATING YOUR TRANSITION IN LIFE </p>
                <h5> BUSINESS ACADEMY </h5>
              </div>
            <?php } ?>
            <div class="overlay" type="button" data-dismiss="modal" data-toggle="modal" data-target="#stackPopup" data-image-index="<?php echo $index; ?>">
              <label>
                <div class='stack_image_<?php echo $index; ?> like-label'><?php echo $image->likes()->count(); ?></div>
                <div class='stack_image_<?php echo $index++; ?> comment-label'><?php echo $image->comments()->count(); ?></div>
              </label>   
            </div>
          </div>
        <?php } ?>
        <?php if ($images->count() == 0) { ?>
          <div style='font-family: AauxMediumItalic !important; font-size: 18px;'> No Images </div>
        <?php } ?>
      </div>
      <div class="pagination">
        <?php if ($pagination['total_pages'] > 1) { ?>
          <a href="<?php echo $pagination['previous_page']; ?>" class="previous float-left"> <-- Previous </a>        
          <span> <?php echo $pagination['current_page']."/".$pagination['total_pages']; ?> </span>
          <a href="<?php echo $pagination['next_page']; ?>" class="next float-right"> Next --> </a>
        <?php } ?>  
      </div>
    </div>
  </div>
</div>
<?php if ($title == 'GALLERY') { ?>
  <div class="footer-background"></div>
<?php } ?>
<div class="modal fade upload-image" data-keyboard="false" data-backdrop="static" id="gallery-upload" tabindex="-1" role="dialog" aria-labelledby="upload-image">
  <div class="modal-dialog" role="document" style="position:relative;">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">GALLERY POST</h1>
        <h4 class='uploader-label'> UPLOAD AN IMAGE </h4>
        <input style="display:none;" type="file" name="image" class="form-control" id="gallery-image">

        <div class="browse-container text-center gallery-upload" style='position: relative;'>
          <button id="clear-image"> X </button>
          <p>+ BROWSE IMAGE </p>
        </div>
        <div style="clear: both;"> </div>
        <h6 class='message'> </h6>

        <h4 class="caption-label"> YOUR CAPTION </h4>
        <textarea id="business_image_caption" resize=false placeholder='caption about your post goes here...' style='width: 100%; height: 155px; padding: 10px 15px;'></textarea>

        <p class="text-center">
          <button id="submit" type="button" data-gallery-upload=true>SUBMIT</button> 
        </p>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>
<div class="modal fade upload-image" data-keyboard="false" data-backdrop="static" id="notificationPopup" tabindex="-1" role="dialog" aria-labelledby="upload-image">
  <div class="modal-dialog" role="document" style="position:relative;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="sub-header text-center" style="margin-bottom: 15px;">MESSAGE SENT!</h1>
        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close">OKAY</button> 
        </p>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>
<div class="modal fade<?php if ($title == 'STACKS') { echo ' reloadable'; } ?>" data-keyboard="false" data-backdrop="static" id="stackPopup" tabindex="-1" role="dialog" aria-labelled-by="upload-image">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='display: none;'>
        <span aria-hidden="true">&times;</span>
      </button>
      <?php if (isset($user) && $current_user->id == $user->id) { ?>
        <button id='image-popup-menu'></button>
        <ul id="image-popup-menu-items">
          <li id='edit-image-caption'> EDIT </li>
          <li> COMMENTING: <span id='comment-status' style="color: #f50c79; font-family: inherit; padding-left: 3px;"></span> </li>
          <li id='delete-gallery-image'> DELETE </li>
        </ul>
      <?php } ?>
      <div class="modal-header">
        <div class="image-container">
          <img src="" />
          <span class="slide-left" style="cursor: pointer;"> </span>
          <span class="slide-right" style="cursor: pointer;"> </span>
          <p></p>
        </div>
        <div class="image-details">
          <div class="actions" >
            <h4> 20 Likes | 10 Comments </h4>
            <div>
              <?php if ($current_user->user_type == 'Customer') { ?>
                <button class="unstackable" data-stack-count='<?php echo $images->count(); ?>' data-updated-stack-count='<?php echo $images->count(); ?>'> STACK </button>
              <?php } ?>
              <span class="like-control"> </span>
            </div>
          </div>
          <p id="image-caption"></p>
          <div id='ajaxMessage'></div>
          <h5 id="uploaded-by"> by <?php if (isset($business)) { echo $business->name; } ?> </h5>
          <div class="comment">
            <input id="image_comment" name='comment' placeholder="write a comment..." />
            <div id="commentResponse"></div>
          </div>
          <div id="edit-image-caption-controls" style="overflow: auto;">
            <button id="cancel-caption-edit"> Cancel </button>
            <button id="save-caption"> SAVE </button>
          </div>
          <div class='comments-box'> 
            <h4> Comments </h4>
            <ul>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade upload-image" data-keyboard="false" data-backdrop="static" id="confirmationPopup" tabindex="-1" role="dialog" aria-labelledby="upload-image">
  <div class="modal-dialog" role="document" style="position:relative;">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="sub-header text-center" style="margin-bottom: 15px;"> ARE YOU SURE YOU WANT TO DELETE THIS POST? </h1>
        <p class="text-center">
          <button type='button' id='yes-button'> YES I AM </button>
          <button type="button" id='no-button' data-dismiss="modal" aria-label="Close"> NO </button> 
        </p>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>

<div id="showNotificationPopup" data-dismiss="modal" class="edit-button" data-toggle="modal" data-target="#notificationPopup"> </div>
<div id="showConfirmationPopup" data-dismiss="modal" class="edit-button" data-toggle="modal" data-target="#confirmationPopup"> </div>
<script>
  var image_index = 1;
  var total_images = $("#image_count").data('count');

  $(document).ready(function() {
    if ( $(".main-body").height() < $(window).height() - 165 ) {
      $(".main-body").height($(window).height() - 165);
    }

    $('#stackPopup').on('click', function(e) {
      var reload = false;
      var stack_button = $('#stackPopup .actions button.stacked');
      var stack_count = parseInt(stack_button.attr('data-stack-count'));
      var updated_stack_count = parseInt(stack_button.attr('data-updated-stack-count'));

      if (e.target == $('div#stackPopup')[0]) {
        $('div#stackPopup .close').trigger('click');
        $('#stackPopup #image-caption').attr('contentEditable', false);

        if ( stack_count != updated_stack_count  && $(this).hasClass('reloadable')) {
         location.reload();
        }
      } else if (e.target != $('#stackPopup #image-popup-menu')[0]) {
        $('#image-popup-menu-items').hide();
      }
    });

    $(".stack .overlay").click(function() {
      image_index = $(this).data("image-index");
      set_popup_image(image_index);
      disable_slider_arrow(image_index, total_images);
    });

    $("#stackPopup .slide-left").click(function() {
      if ( image_index > 1 ) {
        image_index--;
        set_popup_image(image_index);
      }

      disable_slider_arrow(image_index, total_images);
    });

    $("#stackPopup .slide-right").click(function() {
      if ( image_index < total_images ) {
        image_index++;
        set_popup_image(image_index);
      }

      disable_slider_arrow(image_index, total_images);
    });

    $('#clear-image').on('click', function(e) {
      e.stopPropagation();
      reset_image_upload_content();
    });

    $('#image-popup-menu').on('click', function() {
      console.log($('#stackPopup  #image-popup-menu-items').css('display'));
      if ($('#image-popup-menu-items').css('display') == 'none') {
        console.log('show menu');
        $('#image-popup-menu-items').show();
      } else {
        console.log('hide menu');
        $('#image-popup-menu-items').hide();
      }
    });

    $('#edit-image-caption').on('click', function() {
      $('#image-popup-menu-items').hide();
      $('#stackPopup #image-caption').attr('contentEditable', true);
      $('#stackPopup #image-caption').trigger('focus');
      $('#stackPopup #uploaded-by').hide();
      $('#stackPopup .comment').hide();
      $('#edit-image-caption-controls').show();
    });

    $('#cancel-caption-edit').on('click', function() {
      $('#stackPopup #image-caption').attr('contentEditable', false);
      $('#stackPopup #image-caption').focusout();
      $('#stackPopup #uploaded-by').show();
      $('#stackPopup .comment').show();
      $('#edit-image-caption-controls').hide();
    });

    $('#save-caption').on('click', function() {
      var save_caption = $(this);
      save_caption.attr('disabled', true);
      save_caption.text('SAVING...');

      var img_holder = $($('#stackPopup #image_comment').attr('data-image'));
      var image_id = $('#stackPopup #image_comment').attr('data-image-id');
      var caption = $('#stackPopup #image-caption').text();
      var data = {'image_id': image_id, 'caption': caption};

      $.ajax({
        type: 'POST',
        url: '/business/updateImageCaption',
        data: data,
        success: function(response) {
          if (response.success == true) {
            img_holder.attr('data-caption', response.caption);
            $("#stackPopup #image-caption").text(response.caption);
            $("#stackPopup #ajaxMessage").css('color', 'green');
            $('#stackPopup #image-caption').attr('contentEditable', false);
            $('#cancel-caption-edit').trigger('click');
          } else {
            $("#stackPopup #ajaxMessage").css('color', 'rgba(255, 0, 0, .5)');
          }

          $('#stackPopup #ajaxMessage').text(response.message);
          save_caption.attr('disabled', false);
          save_caption.text('SAVE');
          animate_message($("#stackPopup #ajaxMessage"));
        },
        error: function(response) {
          $("#stackPopup #ajaxMessage").css('color', 'rgba(255, 0, 0, .5)');
          $('#stackPopup #ajaxMessage').text("Failed to update caption. \n Please try again later.");
          save_caption.attr('disabled', false);
          save_caption.text('SAVE');
          animate_message(save_caption);
        }
      });
    });

    $('#stackPopup #delete-gallery-image').on('click', function() {
      $('#image-popup-menu-items').hide();
      $('#showConfirmationPopup').trigger('click');
    });

    $('#notificationPopup button').on('click', function() {
      if ($(this).hasClass('reload-page')) { 
        location.reload();
      }
    });

    $('#confirmationPopup #yes-button').on('click', function(){
      $('#confirmationPopup #no-button').trigger('click');

      $.ajax({
        type: 'POST',
        url: '/business/removeImage',
        data: {'image_id': $("#stackPopup span.like-control").attr('data-image-id')},
        success: function(response){
          if (response.success) {
            $("#notificationPopup h1").text('POST HAS BEEN REMOVED');
            $('#stackPopup').trigger('click');
            $('#notificationPopup button').addClass('reload-page');
            $('#showNotificationPopup').trigger('click');

          } else {
            $('#stackPopup .image-container p').text('Failed to remove image. Please try again later.');
            // animate_message($('#stackPopup .image-container p'));
          }
        },
        error: function(response){
          $('#stackPopup .image-container p').text('Failed to remove image. Please try again later.');
          animate_message($('#stackPopup .image-container p'));
        }
      });
    });
  });
</script>
@stop