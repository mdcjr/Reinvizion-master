@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <!-- <script src="/js/jquery.bxslider.min.js"></script> -->
  <script src="/js/users-profile.js"></script>
  <!-- <link href="/css/jquery.bxslider.css" rel="stylesheet" /> -->
  <link rel="stylesheet" type="text/css" href="/css/jquery.rateyo.css">
  <script src="/js/jquery.rateyo.js"></script>
</head>
<div class="row row-header text-center">
  <div class="col-lg-12">
    <?php if ($current_user->id == $user->id) { ?>
      <span class="business-owner span-row-header" style="color: rgb(252,237,246); position: absolute; left: 26px; top: 31px; text-decoration: underline; font-size: 12px;"> INTERESTED IN BUSINESS ACADEMY? </span>
    <?php } ?>
    <?php if ($current_user->id == $user->id) { ?>
      <h4 class="page-header text-center">
        <?php 
          if ($business != null && $business->name != '') {
            echo $business->name;
          } else {
            if ($current_user->firstname != '' || $current_user->lastname != '') {
              echo $current_user->firstname." ".$current_user->lastname;
            } else {
              echo $current_user->name;
            }
          }
        ?>
      </h4>
    <?php } ?>
    <h1 class="sub-header text-center <?php if ($current_user->id != $user->id) { echo 'business-public-profile'; } ?>">
      <?php if ($current_user->id == $user->id) {
        echo 'WELCOME!';
      } else {
        echo $business->name;
      } ?>
    </h1>
    <?php if ($current_user->id != $user->id) {
      if ($current_user->id != $user->id) { $public_profile_class = 'business-public-profile'; }
      echo '<h4 class="page-header text-center '.$public_profile_class.'">'.$business->industry.'</h4>';
    } ?>
  </div>
</div>
<div class="col-lg-12 main-body business-owner">
  <div id="business-owner-image-holder">
    <span id="user_image" data-toggle="modal" data-target="#upload-image" style="background-image:url(<?php echo $user->image; ?>);"></span>
  </div>
  <div class="row row-profile-header text-center business-owner">
    <div class="col-lg-9">
      <?php if ($current_user->id == $user->id) { ?>
        <h1 class="sub-header text-center" id="user_name">
          <?php
            if ($business != null && $business->name != '') {
              echo $business->name;
            } else {
              echo "N/A";
            }
          ?>
        </h1>
        <p class="text-center" id="user_occupation">
          <?php
            if ($current_user->business != null) {
              echo $current_user->business->industry;
            } else {
              echo "N/A";
            }
          ?>
        </p>
      <?php } ?>
      <?php if ($current_user->id != $user->id) { ?>
        <div id="connect-review-controls">
          <button <?php if (!$business->isUserCustomer($current_user->id)) { echo 'class="connect-to-business"'; } else { echo 'disabled=true'; }?> data-user-id="<?php echo $current_user->id; ?>" data-business-id="<?php echo $business->id; ?>"> 
            <?php if ($business->isUserCustomer($current_user->id)) {
              echo 'CONNECTED';
            } else {
              echo 'CONNECT';
            } ?>
          </button>
          <button data-toggle="modal" data-target="#ratePopup"> + ADD REVIEW </button>
        </div>
      <?php } ?>
      <div id="rating" style="margin-top: 5px;">
        <a type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#reviewPopup" style="cursor: pointer;">
          <!-- <img src="/images/star-rating.png" style="width: 120px;" /> -->
          <div id="starRating" data-avg-rating="<?php echo (float)$business->reviews()->avg('rating'); ?>"></div>
        </a>
        <div> 
          <a type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#reviewPopup"> 
            (<?php echo $business->reviews()->count(); ?>) 
          </a>
        </div>
      </div> 
      <?php if ($current_user->id == $user->id) { ?>    
        <div id="friends-businesses">
            <a type="button" onclick="sendRequestViaMultiFriendSelector(); return false;"> INVITE FRIENDS </a>
            <script src="http://connect.facebook.net/en_US/all.js"></script>
            <div id="fb-root"></div>
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
        </div>
      <?php } ?>
      <div id="business-tags">
        <ul>
          <?php if ( $business_tags == "" ) { ?>
            <li class='no-service' style="list-style: none;"> NO AVAILABLE SERVICES </li>
          <?php } else {
            $count = 0;

            foreach($business_tags as $tag) { 
              if ($count < 5) { ?>
                <li class="tag-item"> 
                  <?php echo strtoupper($tag); ?>
                </li>
          <?php } else {
                break;
              }

              $count++;
            }
          } ?>          
        </ul>
        <?php if ($business_tags != "") { ?>
          <a type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#servicesPopup">
            VIEW SERVICES
          </a>
        <?php } ?>
      </div>
      <div class="icons">
        <span style="background-image: url('/images/message-bubble.png')">
          <?php
            $attribute_data = "";
            $conversation_id_param = "";

            if ($current_user->user_type != 'Business Owner') { 
              $attribute_data = 'id="send_message_icon"';
              $has_conversation = $business->user()->first()->has_conversation_with_user($current_user->id);
              $attribute_data = $attribute_data.' data-has-conversation="'.$has_conversation.'"';
              $attribute_data = $attribute_data.' data-user-id="'.$business->user()->first()->id.'"';
              
              if ($has_conversation) {
                $conversation_id_param = '?conversation_id='.$current_user->get_conversation_with_user($business->user()->first()->id)->id;
              }
            }
          ?>
          <a <?php echo $attribute_data ?> href="/messages<?php echo $conversation_id_param; ?>" style="display: block; height: inherit; width: 100%"></a>
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
    <div class="col-lg-9 profile-col business-owner">
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
            <p class="text-left profile-content"> CUSTOMERS:
              <span id="customers"> 
                <?php 
                  if ($user->business != null) { 
                    echo  $customers->count();
                  } else {
                    echo 0;
                  }
                ?>
              </span> 
            </p>
            <p class="text-left profile-website"> WEBSITE: 
              <?php if ($current_user->website != null || $current_user->website != '') { ?>
                <a id="website" href="<?php echo $current_user->website; ?>" target="blank"> 
                  <?php echo  "{$current_user->website}"; ?>
                </a>
              <?php } else {  
                echo "<span> N/A </span>";
              } ?> 
            </p>
            <?php
              $yrdata= strtotime('' .$current_user->created_at);
              echo '<p class="text-left"> MEMBER SINCE: <span>' .date('F Y', $yrdata) .'</span> </p>'
            ?>
          </div>
          <div style="clear: both;"> </div>
        </div>
      </div>      
      <!-- <div class="business-owner about-us">
        <h4> ABOUT US </h1>
        <p> < ?php 
          if ($current_user->business != null) { 
            echo $current_user->business->about_us;
          } else {
            echo "N/A";
          }
        ?> </p>
      </div> -->
    </div>
    <!-- <div class="profile-bio">
      <p> <?php echo $current_user->bio; ?> </p>
    </div> -->
    <?php if ($current_user->id == $user->id) { ?>
      <div class="edit-button-container">
        <button type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#editBusinessOwnerModal">
          <span style="background-image: url('/images/edit-icon.png');"></span>
        </button>
      </div>
    <?php } ?>
  </div>
  <div class="row row-footer business-owner">
    <hr></hr>
    <div style="clear:both;"> </div>
    <div id="gallery" class="business-owner stack-page">
      <div id="gallery-count" data-count="<?php echo $business_images->count(); ?>"> </div>
      <h1 class="text-center"> 
        GALLERY (<?php echo $business_images->count(); ?>) 
        <?php if ($current_user->id == $user->id) { ?>
          <a style="cursor: pointer; text-decoration: none;" data-toggle="modal" data-target="#gallery-upload"> + upload an image </a> 
        <?php } ?>
      </h1>
      <div style="overflow: auto;">
      <?php $count = 1; ?>
      <?php foreach($business_images as $image) { ?>
        <div class="stack">
          <div class="image">
            <img id="stack_image_<?php echo $count; ?>" class="<?php ?>" src="<?php echo $image->link; ?>" data-index="<?php echo $count; ?>" data-id="<?php echo $image->id; ?>" data-is-liked="<?php echo $image->is_liked_by_user($current_user->id); ?>" data-comments-enabled="<?php echo $image->comments_enabled; ?>" data-caption="<?php echo $image->caption; ?>" data-likes-count="<?php echo $image->likes()->count(); ?>" data-comments-count="<?php echo $image->comments()->count(); ?>" data-stacked="<?php echo $image->is_stacked_by_user($current_user->id); ?>" style="cursor: pointer;">
          </div>
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
      if ($business_images->count() >= 12) { $max_count = 0; }
      else if ($business_images->count() == 0) { $max_count = 4; } 
      else { $max_count = 4 - ($business_images->count() % 4); }
      
      if ($current_user->id == $user->id) {
        for($i=0; $i<$max_count; $i++) { 
          echo '<div class="stack add-image" data-toggle="modal" data-target="#gallery-upload"></div>';
        }
      } else {
        if ($business_images->count() == 0) {
          echo '<div> No Images Available </div>';
        }
      } ?>
      </div>
      <?php if ($business_images->count() > 0) { ?>
        <button> <a href="/business/<?php echo $business->id; ?>/gallery" style="color: inherit; text-decoration: none;"> VIEW ALL </a> </button>
      <?php } ?>
    </div>
    <!-- <hr />
    <div style="clear:both;"> </div>
    <div id="badges">
      <h1 class="text-center"> BADGES </h1>
      <img src="/images/badges.png" />
      <button> VIEW ALL </button>
    </div>  -->
    <?php if ($current_user->id == $user->id) { ?>
      <hr />
      <div style="clear:both;"> </div>
      <div id="customer">
        <h1 class="text-center"> CUSTOMERS </h1>
        <ul>
          <li class="slider-control"> <img src="/images/slider-arrow-left.png"/> </li>
          <?php
            $i = 0;

            foreach ($customers as $tmp_user) {
              $class = "mobile";
              $user_profession = 'N/A';

              if ($i%2 == 0 || $i%3 == 0 || $i%4 == 0 || $i%5 == 0) {
                if ($i != 0 ) {
                  $class = "pc";
                }
              }

              $i++;

              if ($tmp_user->profession != '') {
                $user_profess = $tmp_user->profession;
              }

              echo '<li class="'.$class.'"> <img src="'.$tmp_user->image.'" style="margin-bottom: 5px;"></img> <p clas="name"> '.$tmp_user->name.' </p> <p class="profession"> '.$user_profession.' </p> </li>';
            }

            if ( $customers->count() == 0 ) {
              echo "<li style='font-family: AauxMediumItalic !important;'> NO CUSTOMERS </li>";
            }
          ?>
          <li class="slider-control"> <img src="/images/slider-arrow-right.png"/> </li>
        </ul>
        <h4 id="find-connections" class="page-header text-center" type="button" data-dismiss="modal" data-toggle="modal" data-target="#classmatesModal" ><span>FIND MORE CONNECTIONS<span></h1>
        <div style="clear:both;"> </div>
      </div>
    <?php } ?>
    <!-- <hr /> -->
    <!-- <div style="clear:both;"> </div> -->
    <!-- <div id="reviews">      
      <h1 class="text-center"> REVIEWS </h1>
      <img src="/images/star-rating2.png" />
      <button> VIEW ALL </button>
    </div> -->
    <!-- <hr />
    <div style="clear:both;"> </div>
    <h1 class="text-center"> NETWORK (< ?php echo count($current_user->connected_users); ?>)</h1>
    <div id="network" class="img-container">
      < ?php
        foreach ($connected_users as $user) {
          echo '<a href="/users/' .$user->id .'" target="_blank">
              <div class="img">
                <img style="background-image:url(' .$user->image .');"></img>
                <h1 class="text-center" style="margin:10px 0 0;"> ' .$user->name .' </h1>
                <p class="text-center" style="font-style: italic;font-weight: 500;">' .$user->profession .'</p>
              </div>
            </a>';
        }
      ?>
    <h4 id="find-connections" class="page-header text-center" type="button" data-dismiss="modal" data-toggle="modal" data-target="#classmatesModal" ><span>FIND MORE CONNECTIONS<span></h1>
    </div> -->
  </div>
</div>
<div class="footer-background"></div>
<!-- Business Owner Profile Popup -->
<?php if ($current_user->id == $user->id) { ?>
  <div class="modal fade edit-profile" data-keyboard="false" data-backdrop="static" id="editBusinessOwnerModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content business-owner-profile">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">
        <form id="business-owner-update" role="form" method="post" action="{{ url('updateUser') }}">
          {{ csrf_field() }}
          <h1 class="sub-header text-center">EDIT PROFILE</h1>
          <h2 class="sub-header text-center">YOUR PUBLIC PROFILE</h2>

          <div id="name">
            <div>
              <p class="text-left profile-content"> NAME</p>
              <input id="firstname" name="firstname" placeholder="first name" value="<?php echo $current_user->firstname; ?>"></input>
            </div>            
            <div>
              <p class="text-left profile-content", style="color: transparent;"> NAME</p>
              <input id="lastname" name="lastname" placeholder="last name" value="<?php echo $current_user->lastname; ?>"></input>
            </div>
            <div style="clear: both;"> </div>
          </div>
          <p class="text-left profile-content"> COMPANY NAME </p>
          <input id="company_name" name="company_name" placeholder="company name" value="<?php 
            if ( $business != null ) { echo $business->name; }
          ?>"></input>
          <p class="text-left profile-content"> FIELD OF BUSINESS</p>
          <input id="industry" name="industry" placeholder="business industry" value="<?php
            if ($business != null) { echo $business->industry; }
          ?>"></input>
          <p class="text-left profile-content"> WEBSITE </p>
          <input id="website" name="website" placeholder="URL" value="<?php echo $current_user->website ?>"></input>

          <hr class="hr-main" style="padding: 0; border-width: 2px;"></hr>

          <h2 class="sub-header text-center">CONTACT INFO</h2>
          <p class="text-left profile-content"> EMAIL</p>
          <input id="email" name="email" placeholder="email" value="<?php echo $user->email; ?>"></input>
          <p class="text-left profile-content"> PHONE</p>
          <input id="phone" name="phone" placeholder="phone number" value="<?php echo $user->phone; ?>"></input>
          <p class="text-left profile-content"> ADDRESS</p>
          <input id="addr" name="addr" placeholder="address" value="<?php echo $user->addr; ?>"></input>
          <div class="col-lg-12">
            <div class="col-lg-5">
              <p class="text-left profile-content"> CITY </p>
              <input id="city" name="city" placeholder="city" value="<?php echo $user->city ?>"></input>
            </div>
            <div class="col-lg-5 col-state">
              <p class="text-left profile-content"> STATE </p>
              <!-- <input id="state"  placeholder=""></input> -->
              <p style="display: none;"> <?php echo $user->state; ?> </p>
              <select id="state" name="state">
                <?php 
                  foreach($us_states as $key => $value) {
                    if ( $value != $user->state ) { 
                      echo '<option value="'.$value.'">'.$key.'</option>';
                    } else {
                      echo '<option value="'.$value.'" selected>'.$key.'</option>';
                    }
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="col-lg-5">
              <p class="text-left profile-content"> BIRTH DATE </p>
              <?php
                $date = "";
                if($current_user->birthdate != 0) {
                  $yrdata= strtotime('' .$current_user->birthdate);
                  $date = "" .date('Y', $yrdata) ."-".date('m', $yrdata) ."-" .date('d', $yrdata);
                }
                echo '<input id="birthdate" type="date" name="birthdate" value="' .$date .'" placeholder="MM/DD/YYYY" >';
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
                  echo '<option default> F/M/NO ANSWER </option>
                    <option ' .$selected[0] .' value="0">No Answer</option>
                    <option ' .$selected[1] .' value="1">F</option>
                    <option ' .$selected[2] .' value="2">M</option>';
                ?>
              </select>
            </div>
          </div>

          <hr class="hr-main" style="padding: 0; border-width: 2px;">

          <h2 class="sub-header text-center">SERVICES</h2>
          <?php
            $disabled = false;
            $place_holder = "type in keywords separated by comma. (max 12)";
            
            if ($business_tags != "" && count($business_tags) >= 12) {
              $disabled = true;
              $place_holder = "Services are at max limit!";
            } 
          ?>
          <input id="business-services" name="services" placeholder="<?php echo $place_holder; ?>" value="" style="margin-top: 20px;" <?php if ($disabled) { echo 'disabled'; } else { echo ''; } ?>>
          <ul class="business-tags edit-tags">
            <?php if ($business_tags != "") { 
              foreach($business_tags as $tag) { ?>
                <li class="tag-item"> 
                  <p>
                    <?php echo strtoupper($tag); ?>
                    <span class='remove-service <?php echo trim($tag); ?>' data-service="<?php echo $tag; ?>" onclick="remove_service(this)"> X </span>
                  </p> 
                </li>
            <?php }
            } ?>
          </ul>
          <p class="text-center" style="overflow: auto; margin-bottom: 20px;">
            <button id="save" type="submit">SAVE</button>
          </p>
        </form>
      </div>
    </div>
  </div>
  </div>
<?php } ?>
<div class="modal fade view-all-discussions" data-keyboard="false" data-backdrop="static" id="viewAllDicussions" tabindex="-1" role="dialog" aria-labelledby="viewAllDicussions">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">DISCUSSIONS</h1>
        <div class="comments-container">
          <?php 
            $comments = $current_user->comments->where('reply_id', '=', '0');
            if (isset($comments)) {
              foreach ($comments as $comment) {
                $yrdata= strtotime('' .$comment->created_at);
                echo '<div class="container-duscussion">
                        <div class="col-lg-1" style="padding:0;">
                          <div class="image">
                            <img src="/images/alternative-learning.jpg"></img>
                          </div>
                        </div>
                        <div class="col-lg-11 discuss-body">
                          <div class="col-lg-12">
                            <p class="discuss-body-title">' .$comment->user->name .' | <span>' .date('M', $yrdata) .'/' .date('d', $yrdata) .' | ' .date('h:i A', $yrdata) .'</span></p>
                          </div>
                          <p class="discuss-body-message">' .$comment->body .'</p>
                        </div>
                      </div>
                      <hr class="hr-main"></hr>'
                      ;
              }
            }
          ?>
          <button type="button" class="close done-button" data-dismiss="modal" aria-label="Close">
            DONE
          </button>
        </div>
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
        <h6 class='message'> </h6>

        <p class="text-center">
          <button id="submit" type="button">SUBMIT</button> 
        </p>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>
<div class="modal fade classmates-popup" data-keyboard="false" data-backdrop="static" id="classmatesModal" tabindex="-1" role="dialog" aria-labelledby="classmatesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">CONNECTIONS FOUND</h1>

        <div class="connection-container">
        </div>

        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close" id="submit">DONE</button> 
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade edit-profile business-owner-profile" data-keyboard="false" data-backdrop="static" id="reviewPopup" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">
        <h1 class="sub-header text-center">REVIEWS</h1>
        <h2 class="sub-header text-center"><?php echo number_format($business->reviews()->avg('rating'), 1); ?> OUT OF 5 (<?php echo $business->reviews()->count(); ?> REVIEWS)</h2>        
        <div id="reviewRating"></div>
        <!-- <img id="business-rating" src="/images/star-rating.png" /> -->
        <div id="business-reviews-content">
          <?php 
            $business_reviews = $business->reviews()->orderBy('created_at', 'desc')->offset(0)->limit(5)->get(); 
            $rating_message = ['', 'POOR', 'GOOD', 'VERY GOOD', 'GREAT', 'EXCELLENT']
          ?>
          <?php foreach($business_reviews as $review) { ?>
            <div class="review-item" >
              <section class="top" style="position: relative;">
                <div class="user-image">
                  <?php 
                    $user_image = $review->reviewer()->image;
                    if ($user_image == null || $user_image == "") {
                      $user_image = '/images/facebook-avatar.png';
                    }
                  ?>
                  <!-- <img style="background-image:url('< ?php echo $user_image; ?>')" /> -->
                  <div class="img" style="background-image:url('<?php echo $user_image; ?>')"></div>
                </div>
                <div>
                  <section class="rating-title" style="position: relative; overflow: auto;">
                    <div class="rateyo" data-review-rating="<?php echo number_format($review->rating, 1); ?>"></div>
                    <h5> <?php echo $rating_message[(int)$review->rating]; ?> CUSTOMER SERVICE </h5>
                    <div style="clear: both;"> </div>
                  </section>
                  <p style= "margin: 0;"> 
                    <span style="color: #333333; font-family: AauxRegular !important; font-weight: inherit;"> by <?php echo $review->reviewer()->name; ?> on </span>
                    <?php
                      $review_created = date_create($review->created_at);
                      $review_date_str = date_format($review_created, 'F j, Y')
                    ?>
                    <span style="color: #4D4D4D; font-family: AauxRegular !important; font-weight: inherit;"> <?php echo $review_date_str; ?> </span>
                  </p>
                </div>
              </section>
              <div style="clear: both;"> </div>
              <section class="bottom">
                <p style="margin: 0; font-family: AauxRegular !important; font-weight: inherit;"> 
                  <?php echo $review->message; ?>
                </p>
              </section>
            </div>
          <?php } ?>
        </div>
        <hr style="border-width: 2px;"/>
        <?php if ($business->reviews()->count() > 5) { ?>
          <button id="view-all-reviews" style="font-family: AauxRegular !important; font-weight: inherit;">
            <a href="/business/<?php echo $business->id; ?>/reviews" style="text-decoration: none; color: inherit;">VIEW ALL REVIEWS</a>
          </button>
        <?php } ?>
        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close">DONE</button>
        </p>
      </div>
    </div>
  </div>
</div>

<div class="modal fade edit-profile business-owner-profile" data-keyboard="false" data-backdrop="static" id="networkPopup" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">
        <h1 class="sub-header text-center"> NETWORK (<?php echo count($current_user->connected_users); ?>) </h1>
        <ul id="users-listing">
          <?php foreach( $users as $tmp_user ) {
            $name = strtoupper($tmp_user->name);
            $profession = "N/A";
            $connected_class = "class='connected'";
            $connection_status = "CONNECTED";
            
            if ( $tmp_user->firstname != '' || $tmp_user->lastname != '' ) {
              $name = strtoupper($tmp_user->firstname." ".$tmp_user->lastname);
            }

            if ( $user->profession != '' ) {
              $profession = $current_user->profession;
            }

            if ( $tmp_user->isConnected($current_user->id, $tmp_user->id) == false ) {
              $connected_class = "not-connected";
              $connection_status = "CONNECT";
            }

            echo '<li>
              <div class="user-image">
                <a href="/users/'.$tmp_user->id.'" target="_blank">
                  <img src="'.$tmp_user->image.'" />
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

<div class="modal fade classmates-popup" data-keyboard="false" data-backdrop="static" id="servicesPopup" tabindex="-1" role="dialog" aria-labelledby="classmatesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <div class="modal-header">
          <h1 class="sub-header text-center">
            <?php if ($business_tags != "") {
              echo 'SERVICES';
            } else {
              echo 'NO AVAILABLE SERVICE(S)';
            }
            ?>
          </h1>
          <ul id="business-tags-listing">
            <?php if ($business_tags != "") {
              foreach($business_tags as $tag) { ?>
                <li class="<?php echo trim($tag); ?>" style="list-style: none;"> 
                  <div class="tag-item"> <?php echo strtoupper($tag); ?> </div>
                </li>
            <?php } 
            } ?>
            <li style="clear: both; display: none;"> </li>
          </ul>
        </div>
        <!-- <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close" id="submit">DONE</button> 
        </p> -->
      </div>
    </div>
  </div>
</div>
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
          <button id="submit" type="button" data-gallery-upload=true>SAVE</button> 
        </p>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
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
            <input id="email" name="to_email" placeholder="email" value='<?php echo $business->user()->first()->email; ?>' disabled=true />
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
<div class="modal fade" data-keyboard="false" data-backdrop="static" id="stackPopup" tabindex="-1" role="dialog" aria-labelled-by="upload-image">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style='display: none;'>
        <span aria-hidden="true">&times;</span>
      </button>
      <?php if ($current_user->id == $user->id) { ?>
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
              <?php if ($current_user->id != $user->id) { ?>
                <button> STACK </button>
              <?php } ?>
              <span class="like-control"> </span>
            </div>
          </div>
          <p id="image-caption"></p>
          <div id='ajaxMessage'></div>
          <h5 id="uploaded-by"> by <?php echo $business->name; ?> </h5>
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

<?php if ($current_user->user_type != 'Business Owner') { ?>
  <div class="modal fade upload-image" data-keyboard="false" data-backdrop="static" id="ratePopup" tabindex="-1" role="dialog" aria-labelledby="upload-image">
    <div class="modal-dialog" role="document" style="position:relative;">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <div class="modal-header">
          <h1 class="sub-header text-center" style="margin-bottom: 15px;">GIVE A REVIEW</h1>

          <label> GIVE A RATING </label>
          <div id="rateYo"></div>

          <label> YOUR REVIEW </label>
          <textarea id="review_message" placeholder="write a review"></textarea>
          <p class="info"></p> 

          <p class='text-center'>
            <button id='create_review' data-business-id="<?php echo $business->id; ?>"> SUBMIT </button>
          </p>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
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
            <button id="submit" type="button" data-dismiss="modal" data-toggle="modal" data-target="#editBusinessOwnerModal">LET'S GO</button>
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
    font-size: 14px;
  }

  #reviewPopup .modal-dialog {
    max-width: 900px;
    width: 100%;
  }

  #ratePopup .close {
    margin: -20px -15px 0 0;
  }

  #ratePopup .close > span {
    font-size: 14px;
  }

  #ratePopup .modal-header > label {
    display: block;
    text-align: center;
    font-size: 16px;
    color: #a69aa1;
    outline: none;
    margin-top: 30px;
  }

  #ratePopup .modal-header > textarea {
    width: 100%;
    height: 200px;
    padding: 10px;
    margin-top: 5px;
    font-family: AauxLightItalic !important;
    font-size: 13px;
    font-weight: initial;
    resize: none;
    border: 2px solid rgba(166, 154, 161, .5);
    outline: none;
  }

  #rateYo, #starRating, #reviewRating {
    margin: auto;
  }

  #starRating { cursor: pointer; }

  #ratePopup .info {
    color: rgb(6, 171, 6);
    font-size: 13px;
    font-family: AauxMedium !important;
    font-weight: initial;
    text-align: center;
    margin-bottom: -18px;
    min-height: 18px;
  }

  #ratePopup .info.error {
    color: rgb(232, 6, 6);
  }

  #ratePopup #create_review { outline: none; }

  .rateyo {
    max-width: 110px; 
    margin: 8px 0; 
    float:left;
    padding: 0;
  }

  #rating > a {
    display: block;
    max-width: 110px;
    width: 100%;
    margin: auto;
  }

  @media (max-width:768px) {
    .rateyo {
      float: none;
      margin: 8px auto;
    }
  }
</style>
<script>
  var gallery_index = 1;
  var gallery_count = $("#gallery-count").data('count');

  $(document).ready(function() {
    $('form#send_message').on('submit', function(e) {
      e.preventDefault();
      
      $("#sendMessagePopup button.close").trigger('click');
      $("#notificationPopup h1").text('MESSAGE SENT!');
      $("#showNotificationPopup").trigger('click');
    });

    // $("#gallery .image img").on('click', function() {
    //   gallery_index = $(this).data('index');
    //   set_popup_image(gallery_index);
    //   disable_slider_arrow(gallery_index, gallery_count);
    // })

    $(".stack .overlay").click(function() {
      gallery_index = $(this).data("image-index");
      set_popup_image(gallery_index);
      disable_slider_arrow(gallery_index, gallery_count);
    });

    $("#stackPopup .slide-left").click(function() {
      if ( gallery_index > 1 ) {
        gallery_index--;
        set_popup_image(gallery_index, gallery_count);
      }

      disable_slider_arrow(gallery_index, gallery_count);
    });

    $("#stackPopup .slide-right").click(function() {
      if ( gallery_index < gallery_count ) {        
        gallery_index++;
        set_popup_image(gallery_index);
      }

      disable_slider_arrow(gallery_index, gallery_count);
    });

    $('#clear-image').on('click', function(e) {
      e.stopPropagation();
      reset_image_upload_content();
    });

    $('#stackPopup').on('click', function(e) {
      if (e.target == $('div#stackPopup')[0]) {
        $('div#stackPopup .close').trigger('click');
        $('#stackPopup #image-caption').attr('contentEditable', false);
      } else if (e.target != $('#stackPopup #image-popup-menu')[0]) {
        $('#image-popup-menu-items').hide();
      }
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
      $('#cancel-caption-edit').trigger('click');
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

    $(".connect-to-business").on('click', function(){
      var connectButton = $(this);
      var error_message = 'Failed to connect with business. Please try again later.';
      connectButton.attr('disabled', true);
      connectButton.text('CONNECTING..');
      
      $.ajax({
        url: '/business/addCustomer',
        type: 'POST',
        data: {'user_id': connectButton.attr('data-user-id'), 'business_id': connectButton.attr('data-business-id')},
        success: function(response) {
          if (response.customer != false) {
            $('#notificationPopup h1').text('You are now connected.');
            connectButton.removeClass('connect-to-business');
            connectButton.text('CONNECTED');
          } else {
            $('#notificationPopup h1').text(error_message);
            connectButton.attr('disabled', false);
          }
          
          $('#showNotificationPopup').trigger('click');
        },
        error: function(response) {
          connectButton.attr('disabled', false);
          connectButton.text('CONNECT');
          $('#notificationPopup h1').text(error_message);
          $('#showNotificationPopup').trigger('click');
        }
      })
    });

    $('.icons #send_message_icon').on('click', function(e){
      if (parseInt($(this).attr('data-has-conversation')) != 1) {
        e.preventDefault();

        $.ajax({
          type: "POST",
          url: '/createConversation',
          data: {user_id: $(this).attr("data-user-id")},
          success: function( result ) {
            if (result.conversation != undefined || result.conversation != "") {
              location.href = '/messages?conversation_id='+result.conversation.id;
            } else {
              location.href = '/messages'
            }
          }
        });
      }      
    });

    $("#rateYo").rateYo({
      rating: 0,
      normalFill: "#d3d3d3",
      ratedFill: "#F6087D",
      starWidth: "30px"
    });

    var current_rating = parseFloat($('#starRating').attr('data-avg-rating'));
    $("#starRating").rateYo({
      rating: current_rating,
      normalFill: "#d3d3d3",
      ratedFill: "#F6087D",
      starWidth: "20px",
      readOnly: true,
      halfStar: true
    });

    $('#ratePopup #create_review').on('click', function() {
      $(this).attr('disabled', true);
      var rating = $("#rateYo").rateYo('rating');
      var review_msg = $('#review_message').val();

      if ( rating == 0 || review_msg == "") {   
        show_error($('#ratePopup .info'), "Please provide your rating and review.");
      } else {
        var data = {
          'rating': rating,
          'review': review_msg,
          'business_id': $(this).attr('data-business-id')
        };

        $.ajax({
          url: '/business/review',
          type: 'POST',
          data: data,
          success: function(response) {
            if (response.success) {
              clear_rating();
              $('#notificationPopup h1').text("Review Submitted");
              $('#notificationPopup button').addClass('reload-page');
              $('#ratePopup button.close').trigger('click');
              $('#showNotificationPopup').trigger('click');
            } else {
              show_error($('#ratePopup .info'), "Failed to create review. Please try again later.");
            }
          },
          error: function(response) {
            show_error($('#ratePopup .info'), "Failed to submit review. Please try again later.");
          }
        });
      }
    });

    $('#reviewRating').rateYo({
      rating: current_rating,
      normalFill: "#d3d3d3",
      ratedFill: "#F6087D",
      starWidth: "30px",
      readOnly: true
    })

    $('.rateyo').each(function(index) {
      $(this).rateYo({
        rating: parseFloat($(this).attr('data-review-rating')),
        normalFill: "#d3d3d3",
        ratedFill: "#F6087D",
        starWidth: "18px",
        spacing: '5px',
        readOnly: true
      });
    });

    $('#user_image').on('click', function() {});
  });

  $(".sendEmailPopup").onclick(function(){
    emailButton = $(this);
    $.ajax({
      type: 'POST',
      url: '/email/send',
      data: {'email': emailButton.attr('email'), 'subject': emailButton.attr('subject'), 'message': emailButton.attr('message')},
      success: function(response){

      },
      error: function(message){

      }
    })
  });

  function show_error(msg_container, msg){
    $('#ratePopup #create_review').attr('disabled', false);
    msg_container.addClass('error');    
    msg_container.text(msg);
    animate_message(msg_container);
  }

  function clear_rating(){
    $('#ratePopup #create_review').attr('disabled', false);
    $('#ratePopup #rateYo').rateYo('rating', 0);
    $('#ratePopup #review_message').val("");
  }

  function resetReviewsRating() {
    console.log('reset reviews rating');
    $('.rateyo').each(function(index) {
      $(this).rateYo('destroy');
      $(this).rateYo({
        rating: parseFloat($(this).attr('data-review-rating')),
        normalFill: "#d3d3d3",
        ratedFill: "#F6087D",
        starWidth: "18px",
        spacing: '5px',
        readOnly: true
      });
      // $(this).rateYo('rating', parseFloat($(this).attr('data-review-rating')));
    });
  }
</script>
@stop
