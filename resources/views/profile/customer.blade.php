@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <!-- <script src="/js/jquery.bxslider.min.js"></script> -->
  <script src="/js/users-profile.js"></script>
  <!-- <link href="/css/jquery.bxslider.css" rel="stylesheet" /> -->
</head>
<div class="row row-header text-center">
  <div class="col-lg-12">
    <span class="business-owner customer span-row-header" style="color: rgb(252,237,246); position: absolute; left: 26px; top: 31px; text-decoration: underline; font-size: 12px;"> INTERESTED IN BUSINESS ACADEMY? </span>
    <h4 class="page-header text-center">
      <?php 
        if ($current_user->firstname == '' && $current_user->lastname == '') {
          echo $current_user->name;
        } else {
          echo $current_user->firstname." ".$current_user->lastname;
        }
      ?>
    </h4>
    <h1 class="sub-header text-center">WELCOME!</h1>    
  </div>
</div>
<div class="col-lg-12 main-body business-owner customer">
  <div id="business-owner-image-holder">
    <span id="user_image" data-toggle="modal" data-target="#upload-image" style="background-image:url(<?php echo $user->image ?>);"></span>
  </div>
  <div class="row row-profile-header text-center business-owner customer">
    <div class="col-lg-9">
      <h1 class="sub-header text-center" id="user_name">
        <?php
          if ($current_user->firstname == '' && $current_user->lastname == '') {
            echo $current_user->name;
          } else {
            echo $current_user->firstname." ".$current_user->lastname;
          }
        ?>
      </h2>
      <p class="text-center" id="user_occupation">
        <?php
          if ($current_user->occupation != '') {
            echo $current_user->occupation;
          } else {
            echo "N/A";
          }
        ?>
      </p>
      <!-- <div id="rating">
        <a type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#reviewPopup" style="cursor: pointer;">
          <img src="/images/star-rating.png" style="width: 120px;" />
        </a>
        <div> 
          <a type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#reviewPopup"> 
            (0 reviews) 
          </a>
        </div>
      </div> -->
      <div id="friends-businesses">
        <a type="button" onclick="sendRequestViaMultiFriendSelector(); return false;"> INVITE FRIENDS </a>
            <script src="http://connect.facebook.net/en_US/all.js"></script>
            <div id="fb-root" style="display: none;"></div>
            <script>
              // assume we are already logged in

              FB.init({
                appId  : '<?php echo env("FB_CLIENT_ID", "428811400834945"); ?>',
                frictionlessRequests: true
              });

              function sendRequestToRecipients() {
                var user_ids = document.getElementsByName("user_ids")[0].value;
                FB.ui({
                  method: 'send',
                  name: 'Join Reinvizion',
                  link: 'https://reinvizion.com/',
                });
              }

              function sendRequestViaMultiFriendSelector() {
                FB.ui({
                  method: 'send',
                  name: 'Join Reinvizion and become a friend',
                  link: 'https://reinvizion.com/',
                });
              }

              // function sendRequestViaMultiFriendSelector() {
              //   FB.ui({method: 'apprequests',
              //     message: 'Awesome application try it once. https://reinvizion.com'
              //   }, requestCallback);
              // }

              function requestCallback(response) {
                // Handle callback here
              }
             </script>
      	<a href="/businesses"> BROWSE BUSINESSES </a>
      </div>
      <div class="icons">
        <span style="background-image: url('/images/message-bubble.png')">
          <a href="/messages" style="height: 100%; width: 100%; display: block;"></a>
        </span>
        <span id="envelope-icon" style="background-image: url('/images/envelope.png')"> 
          <a style="display: block; height: inherit; cursor: pointer;" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#sendEmailPopup"> </a>
        </span>
        <span id="user-circle-icon" style="background-image: url('/images/user-circle.png')"> 
          <a type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#networkPopup" style="cursor: pointer; color: inherit; width: 100%; height: 100%; display: block;"></a>
        </span>        
        <span id="connected_users_count"> 
          <a type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#networkPopup" style="cursor: pointer; color: inherit;">
            (<?php echo count($current_user->connected_users); ?>)
          </a>
        </span>
      </div>
    </div>
    <div class="col-lg-9 profile-col business-owner customer">
      <div class="main">
        <div class="section section-profile">          
          <div class="col-lg-12 profile-content">
            <p class="text-left profile-content"> LOCATION:
              <span id="location"> 
                <?php
                  $location = "N/A";

                  if ($current_user->city != null || $current_user->city != '' ) {
                    $location = $current_user->city;
                  }

                  if ($current_user->state != null || $current_user->state != '' ) {
                    if ($location != "N/A") {
                      $location = $location.", ".$current_user->state;
                    } else {
                      $location = $current_user->state;
                    }
                  }

                  echo $location;
                ?>
              </span> 
            </p>
            <?php
              $yrdata= strtotime('' .$current_user->created_at);
              echo '<p class="text-left"> MEMBER SINCE: <span>' .date('F Y', $yrdata) .'</span> </p>'
            ?>
          </div>
          <div style="clear: both;"> </div>
        </div>
      </div> 
    </div>
    <div class="col-lg-9">
      <div class="edit-button-container">
        <button type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#editUserModal">
          <span style="background-image: url('/images/edit-icon.png');"></span>
        </button>
      </div>
    </div>
  </div>
  <div class="row row-footer business-owner customer">
    <div class="col-lg-9">
      <hr />
    </div>
    <div style="clear:both;"> </div>
    <div id="gallery" class="customer-stacks business-owner stack-page">
      <div id="stack-count" data-count="<?php echo $stacks->count(); ?>"> </div>
      <h1 class="text-center"> 
        STACKS 
        <!-- <a href=""> + create a flyer </a>  -->
      </h1>
      <div style="overflow: auto;">
        <?php $count = 1; ?>
        <?php foreach($stacks as $image) { ?>
          <div class="stack">
            <div class="image">
              <img id="stack_image_<?php echo $count; ?>" src="<?php echo $image->link; ?>" data-index="<?php echo $count; ?>" data-id="<?php echo $image->id; ?>" data-is-liked="<?php echo $image->is_liked_by_user($current_user->id); ?>" data-likes-count="<?php echo $image->likes()->count(); ?>" data-comments-count="<?php echo $image->comments()->count(); ?>" data-business-name="<?php echo $image->business()->first()->name; ?>" data-caption='<?php echo $image->caption; ?>' data-stacked="<?php echo $image->is_stacked_by_user($current_user->id); ?>" style="cursor: pointer;">
            </div>
            <!-- <div class="label">
              <p> ELEVATING YOUR TRANSITION IN LIFE </p>
              <h5> BUSINESS ACADEMY </h5>
            </div> -->
            <div class="overlay" type="button" data-dismiss="modal" data-toggle="modal" data-target="#stackPopup" data-image-index="{{$count}}" >
              <label>
                <div class='stack_image_<?php echo $count; ?> like-label'><?php echo $image->likes()->count(); ?></div>
                <div class='stack_image_<?php echo $count; ?> comment-label'><?php echo $image->comments()->count(); ?></div>
              </label>   
            </div>
          </div>
          <?php $count++; ?>
        <?php } ?>
        <?php 
        if ($stacks->count() >= 12) { $max_count = 0; }
        else if ($stacks->count() == 0) { $max_count = 4; } 
        else { $max_count = 4 - ($stacks->count() % 4); }
        
        for($i=0; $i<$max_count; $i++) { ?>
          <div class="stack add-image" style="cursor: initial;"></div>
        <?php } ?>
      </div>
      <button> 
        <a href="/stacks" style="color: inherit; text-decoration: none;"> VIEW ALL </a>
      </button>
    </div>
    <div style="clear:both;"> </div>
    <!-- <div class="col-lg-9"> 
      <hr />
    </div>
    <div style="clear:both;"> </div> -->
    <!-- <div id="customer">
    	<h1 class="text-center"> NETWORK (<?php echo count($current_user->connected_users); ?>)</h1>
      <ul>
        <li class="slider-control"> <img src="/images/slider-arrow-left.png"/> </li>
        < ?php
          for ($i=0; $i < 5; $i++) {
            $class = "mobile";

            if ($i%2 == 0 || $i%3 == 0 || $i%4 == 0 || $i%5 == 0) {
              if ($i != 0 ) {
                $class = "pc";
              }
            }

            echo '<li class="'.$class.'"> <img src="/images/facebook-avatar.png"></img> <p clas="name"> NAME </p> <p class="profession"> CURRENT PROFESSION </p> </li>';
          }
        ?>
        <li class="slider-control"> <img src="/images/slider-arrow-right.png"/> </li>
      </ul>
      <h4 id="find-connections" class="customer-profile page-header text-center" type="button" data-dismiss="modal" data-toggle="modal" data-target="#networkPopup" ><span>FIND MORE CONNECTIONS<span></h1>
      <div style="clear:both;"> </div>
    </div> -->
  </div>
</div>
<div class="footer-background"></div>
<!-- Edit Profile Popup -->
<div class="modal fade edit-profile" data-keyboard="false" data-backdrop="static" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">EDIT PROFILE</h1>
        <h2 class="sub-header text-center">YOUR PUBLIC PROFILE</h2>

        <p class="text-left profile-content"> NAME</p>
        <input id="user_name" value="<?php echo $user_name; ?>"></input>
        <p class="text-left profile-content"> CURRENT OCCUPATION</p>
        <input id="occupation" value="<?php echo $current_user->occupation; ?>"></input>
        <p class="text-left profile-content"> FIELD OF BUSINESS</p>
        <input id="profession" value="<?php echo $current_user->profession; ?>"></input>
        <p class="text-left profile-content"> EDUCATION</p>
        <input id="school" value="<?php echo $current_user->school; ?>"></input>
        <p class="text-left profile-content"> DEGREE</p>
        <input id="degree" value="<?php echo $current_user->degree; ?>"></input>
        <p class="text-left profile-content"> WEBSITE </p>
        <input id="website" value="<?php echo $current_user->website; ?>"></input>
        <div class="col-lg-12">
          <div class="col-lg-5">
            <p class="text-left profile-content"> BIRTH DATE </p>
            <?php
              $date = "";
              if($current_user->birthdate != 0) {
                $yrdata= strtotime('' .$current_user->birthdate);
                $date = "" .date('Y', $yrdata) ."-".date('m', $yrdata) ."-" .date('d', $yrdata);
              }
              echo '<input id="birthdate" type="date" name="bday" value="' .$date .'" >';
            ?>
          </div>
          <div class="col-lg-5 col-right">
            <p class="text-left profile-content"> GENDER </p>
            <select id="gender" name="gender">
              <?php
                $selected = array();
                for($k = 0; $k < 3; $k++) {
                  $selected[] = "";
                  $gender = (int)$current_user->gender;
                  if($k == $gender) {
                    $selected[$k] = "selected";
                  }
                }
                echo '<option ' .$selected[0] .' value="0">No Answer</option>
                  <option ' .$selected[1] .' value="1">F</option>
                  <option ' .$selected[2] .' value="2">M</option>';
              ?>
            </select>
          </div>
        </div>
        <p class="text-left profile-content"> BIO </p>
        <textarea id="bio" maxlength="250" placeholder="send a message..."><?php echo $current_user->bio; ?></textarea>

        <hr class="hr-main"></hr>

        <h2 class="sub-header text-center">CONTACT INFO</h2>
        <p class="text-left profile-content"> EMAIL</p>
        <input id="email" value="<?php echo $current_user->email; ?>"></input>
        <p class="text-left profile-content"> PHONE</p>
        <input id="phone" value="<?php echo $current_user->phone; ?>"></input>
        <p class="text-left profile-content"> ADDRESS</p>
        <input id="addr" value="<?php echo $current_user->addr; ?>"></input>
        <div class="col-lg-12">
          <div class="col-lg-5">
            <p class="text-left profile-content"> CITY </p>
            <input id="city" value="<?php echo $current_user->city; ?>"></input>
          </div>
          <div class="col-lg-5 col-state">
            <p class="text-left profile-content"> STATE </p>
            <input id="state" value="<?php echo $current_user->state; ?>"></input>
          </div>
        </div>


        <p class="text-center">
          <button id="save" type="button">SAVE</button> 
        </p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade upload-image" data-keyboard="false" data-backdrop="static" id="upload-image" tabindex="-1" role="dialog" aria-labelledby="upload-image">
  <div class="modal-dialog" role="document" style="position:relative;">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">UPLOAD YOUR PROFILE IMAGE</h1>
        <h2 class="sub-header text-center">CURRENT PHOTO</h2>
        <img id="current_image" style="background-image:url(<?php echo $current_user->image ?>);"></img>
        <input style="display:none;" type="file" name="image" class="form-control" id="image">

        <div class="browse-container text-center">
          <p>+ BROWSE IMAGES</p>
        </div>

        <p class="text-center">
          <button id="submit" type="button">SUBMIT</button> 
        </p>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>
<div class="modal fade edit-profile business-owner-profile" data-keyboard="false" data-backdrop="static" id="reviewPopup" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">
        <h1 class="sub-header text-center">REVIEWS</h1>
        <h2 class="sub-header text-center">4.5 OUT OF 5(9 REVIEWS)</h2>        
        <img id="business-rating" src="/images/star-rating.png" />
        <div id="business-reviews-content">
          <?php for($i=0; $i < 5; $i++) { ?>
            <div class="review-item" >
              <section class="top" style="position: relative;">
                <div class="user-image">
                  <img src="/images/facebook-avatar.png"/>
                </div>
                <div>
                  <section class="rating-title" style="position: relative; overflow: auto;">
                    <img src="/images/star-rating.png" />
                    <h5> GREAT CUSTOMER SERVICE </h5>
                    <div style="clear: both;"> </div>
                  </section>
                  <p style= "margin: 0;"> 
                    <span style="color: #333333; font-family: AauxRegular !important; font-weight: inherit;"> by USERNAME on </span>
                    <span style="color: #4D4D4D; font-family: AauxRegular !important; font-weight: inherit;"> January 1, 2017 </span>
                  </p>
                </div>
              </section>
              <div style="clear: both;"> </div>
              <section class="bottom">
                <p style="margin: 0; font-family: AauxRegular !important; font-weight: inherit;"> 
                  Do you see any Teletubbies in here? Do you see a slender plastic tag clipped to my shirt with my name printed on it? Do you see a little Asian child with a blank expression on his face sitting outside on a mechanical helicopter that shakes when you put quarters in it?
                </p>
              </section>
            </div>
          <?php } ?>
        </div>
        <hr style="border-width: 2px;"/>
        <button id="view-all-reviews" style="font-family: AauxRegular !important; font-weight: inherit;"> VIEW ALL REVIEWS </button>
        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close">DONE</button> 
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade edit-profile business-owner-profile" data-keyboard="false" data-backdrop="static" id="networkPopup" tabindex="-1" role="dialog" aria-labelled-by="editUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">
        <h1 class="sub-header text-center"> NETWORK (<?php echo count($current_user->connected_users); ?>) </h1>
        <ul id="users-listing">
          <?php foreach( $users as $user ) {
            $name = strtoupper($user->name);
            $profession = "N/A";
            $connected_class = "class='connected'";
            $connection_status = "CONNECTED";
            
            if ( $user->firstname != '' || $user->lastname != '' ) {
              $name = strtoupper($user->firstname." ".$user->lastname);
            }

            if ( $user->profession != '' ) {
              $profession = $current_user->profession;
            }

            if ( $user->isConnected($current_user->id, $user->id) == false ) {
              $connected_class = "not-connected";
              $connection_status = "CONNECT";
            }

            echo '<li>
              <div class="user-image">
                <a href="/users/'.$user->id.'" target="_blank">
                  <img src="'.$user->image.'" />
                </a>
              </div>
              <div>
                <h5>'.$name.'</h5>
                <p>'.$profession.'</p>
              </div>
              <div>
                <button class="'.$connected_class.'">'.$connection_status.'</button>
              </div>
            </li>';
          } ?>
        </ul>  
        <button id="view-more-networks"> VIEW MORE </button>
        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close">DONE</button> 
        </p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade edit-profile business-owner-profile reloadable" data-keyboard="false" data-backdrop="static" id="stackPopup" tabindex="-1" role="dialog" aria-labelled-by="editUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">
        <div class="image-container">
          <img src="" />
          <span class="slide-left"> </span>
          <span class="slide-right"> </span>  
        </div>
        <div id="likeResponse" style="margin-top: -35px;"></div>
        <div class="image-details">
          <div class="actions" >
          <h4> 20 Likes | 10 Comments </h4>
            <div>
              <button class="unstackable" data-stack-count='<?php echo $stacks->count(); ?>' data-updated-stack-count='<?php echo $stacks->count(); ?>'> STACK </button>
              <span class="like-control"> </span>
            </div>
          </div>
          <p id='image-caption'></p>
          <h5 id='posted-by'></h5>
          <div class="comment">
            <input id="image_comment" style='padding: 0 10px;' name='comment' placeholder="write a comment..." />
            <div id="commentResponse"></div>
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
<div class="modal fade upload-image" data-keyboard="false" data-backdrop="static" id="sendEmailPopup" tabindex="-1" role="dialog" aria-labelledby="upload-image">
  <div class="modal-dialog" role="document" style="position:relative;">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">
        <h1 class="sub-header text-center" style="margin-bottom: 15px;">SEND AN EMAIL</h1>
        <form id="send_email" role="form" action="" >
          {{ csrf_field() }}
          <div class='form-group'>
            <p class="text-left profile-content"> TO </p>
            <input id="email" name="to_email" placeholder="email" value='' />
          </div>          
          <div class='form-group'>
            <p class="text-left profile-content"> SUBJECT </p>
            <input id="subject" name="subject" />
          </div>
          <div class='form-group'>
            <p class="text-left profile-content"> MESSAGE </p>
            <textarea placeholder="message goes here..." id="message" name="message"></textarea>
            <div id="status" style="top: -15px; text-align: center; color: white; font-family: AauxLight !important; padding: 2px 0;"></div>
          </div>
          <p class="text-center" style="overflow: auto; margin-bottom: 20px;">
            <button id="submit_email" type="submit"> SEND </button>
          </p>
        </form>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>

<div class="modal fade upload-image" data-keyboard="false" data-backdrop="static" id="sendMessagePopup" tabindex="-1" role="dialog" aria-labelledby="upload-image">
  <div class="modal-dialog" role="document" style="position:relative;">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">
        <h1 class="sub-header text-center" style="margin-bottom: 15px;">START A CONVERSATION</h1>
        <form id="send_message" role="form" action="" remote >
          {{ csrf_field() }}
          <div class='form-group'>
            <p class="text-left profile-content"> TO </p>
            <input id="email" name="email" placeholder="email" />
          </div> 
          <div class='form-group'>
            <p class="text-left profile-content"> MESSAGE </p>
            <textarea placeholder="message goes here..." id="message" name="message"></textarea>
          </div>
          <p class="text-center" style="overflow: auto; margin-bottom: 20px;">
            <button id="submit_message" type="submit"> SEND </button>
          </p>
        </form>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>
<?php if($current_user->first_login): ?>
  <?php 
    $current_user->first_login = false;
    $current_user->save();
  ?>
  <button id="welcome-popup-button" type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#welcome-popup" style="display:none;">
  </button>
  <div class="modal fade welcome-popup upload-image" data-keyboard="false" data-backdrop="static" id="welcome-popup" tabindex="-1" role="dialog" aria-labelledby="welcome-popup">
    <div class="modal-dialog" role="document" style="position:relative;">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <div class="modal-header">

          <h1 class="sub-header text-center">WELCOME TO BUSINESS HUB</h1>
          <h2 class="sub-header text-center">LET'S GET STARTED BY BUILDING<br>YOUR PROFILE</h2>
          <p class="text-center">
            <button id="submit" type="button" data-dismiss="modal" data-toggle="modal" data-target="#editUserModal">LET'S GO</button>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      isFirst = true;
      $("#welcome-popup-button").trigger("click");
    });
  </script>
<?php endif; ?>
<style>
  .modal-backdrop {
    background-color: #f50c79;
  }

  #stackPopup .image-details > h4 > span {
    float: right;
    margin-top: -10px;
  }
</style>

<script>
  var stack_image_index = 1;
  var total_stack_image = $("#stack-count").data('count');

  $(document).ready(function(){

    $('#stackPopup').on('click', function(e) {
      var reload = false;
      var stack_button = $('#stackPopup .actions button.stacked');
      var stack_count = parseInt(stack_button.attr('data-stack-count'));
      var updated_stack_count = parseInt(stack_button.attr('data-updated-stack-count'));
      
      if ( stack_count != updated_stack_count  && $(this).hasClass('reloadable')) {
         reload = true;
      }

      if (e.target == $('div#stackPopup')[0]) {
        $('div#stackPopup .close').trigger('click');
        
        if (reload) {
          location.reload();
        }
      } else if (e.target == $('#stackPopup .close span')[0]) {
        if (reload) {
          location.reload();
        }
      }
    });

    $(".stack .overlay label").hover(function(){
      $(this).parent(".overlay").trigger("hover");
    });

    $(".stack .overlay").click(function() {
      stack_image_index = $(this).data("image-index");
      set_popup_image(stack_image_index);
      disable_slider_arrow(stack_image_index, total_stack_image);
    });

    $("#stackPopup .slide-left").click(function() {
      if ( stack_image_index > 1 ) {
        --stack_image_index;
        set_popup_image(stack_image_index);
      }

      disable_slider_arrow(stack_image_index, total_stack_image);
    });

    $("#stackPopup .slide-right").click(function() {
      if ( stack_image_index < total_stack_image ) {
        ++stack_image_index;
        set_popup_image(stack_image_index);
      }

      disable_slider_arrow(stack_image_index, total_stack_image);
    });
  });
</script>
@stop