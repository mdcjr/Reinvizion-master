@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <script src="/js/users-profile.js"></script>
</head>
<div class="row row-header text-center">
  <div class="col-lg-12">
    <h4 class="page-header text-center">BUSINESS ACADEMY</h4>

    <h1 class="sub-header text-center">WELCOME!</h1>
    <?php 
    $st = isset($courses[0]) ? $courses[0] : false;
    if($st): ?>
      <?php $firstCourse = $courses[0]; 
        if(isset($firstCourse)):
      ?>
        <a href="/course/<?php echo $firstCourse->name; ?>">
          <button type="button" class="text-center">START LEARNING</button>
        </a>
      <?php endif; ?>
    <?php endif; ?>
  </div>
</div>
<div class="col-sm-3 col-md-2 sidebar" style="overflow: hidden;padding:0;">
  <div class="sidebar-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
    <div class="sidebar-container text-center">
      <p>YOUR JOURNEY<br>IS HERE</p>
      <div class="arrow-down"></div>
      <?php foreach ($courses as $course): ?>
          <?php if($current_user->confirmation_code != null): ?>
            <a data-toggle="modal" data-target="#emailConfirmationModal">
          <?php elseif (Auth::user()->subscriber === 0 && $course->name != "BUSINESS ACADEMY INTRODUCTION"): ?>
            <a data-toggle="modal" data-target="#subscribeModal">
          <?php else: ?>
            <a href="/course/{{$course->name}}">
          <?php endif; ?>
            <h3>{{$course->name}}</h3>
          </a>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div class="col-lg-10 main-body">
  <div class="row row-profile-header text-center">
    <div class="text-container journey-button">
      <p>YOUR JOURNEY</p>
      <div class="arrow-right"></div>
    </div>
    <div class="col-lg-9">
      <h1 class="sub-header text-center" id="user_name"><?php echo $user_name; ?></h2>
      <p class="text-center" id="user_occupation"><?php echo $user->occupation; ?></p>
    </div>
    <div class="col-lg-9 profile-col">
      <div class="col-lg-8 main">
        <div class="section section-profile">
          <div class="col-lg-4">
            <img id="user_image" data-toggle="modal" data-target="#upload-image"  style="background-image:url(<?php echo $user->image ?>);"></img>
            <p class="text-center profile-position" style="text-transform:uppercase;"> 
              <?php
                if($current_user->user_type == "consultant") {
                  echo '<span style="color:#a10081;margin-right:5px;">★</span>';
                } 
                echo $current_user->user_type; 
              ?>
            </p>
          </div>
          <div class="col-lg-8 profile-content">
            <p class="text-left profile-content"> BUSINESS GOAL:
              <span id="profession"> <?php echo $current_user->profession; ?></span> 
            </p>
            <p class="text-left profile-content"> EDUCATION:
              <span id="education"> <?php echo  "{$current_user->school}, {$current_user->degree}"; ?></span> 
            </p>
            <p class="text-left profile-content"> LOCATION:
              <span id="location"> <?php echo  "{$current_user->city}, {$current_user->state}"; ?></span>
            </p>
            <p class="text-left profile-website"> WEBSITE: 
              <a id="website"> <?php echo  "{$current_user->website}"; ?> </a> 
            </p>
            <?php
              $yrdata= strtotime('' .$current_user->created_at);
              echo '<p class="text-left"> MEMBER SINCE: <span>' .date('F Y', $yrdata) .'</span> </p>'
            ?>
            <script src="http://connect.facebook.net/en_US/all.js"></script>
            <div id="fb-root"></div>
            <input type="button"
              style="float:left; margin:20px 0 0;"
              onclick="sendRequestViaMultiFriendSelector(); return false;"
              value="Send Request To Your Facebook Friends"
            />
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
        </div>
      </div>
    </div>
    <div class="profile-bio">
      <p> <?php echo $current_user->bio; ?> </p>
    </div>
    <div class="edit-button-container">
      <button type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#editUserModal">
        <span>Edit</span>
      </button>
    </div>
  </div>
  <div class="row row-profile">
    <hr class="hr-main"></hr>
    <div class="col-lg-8 section-left">
      <div class="section section-work">
        <h1 class="text-center" style="margin:0;"> PROFESSIONAL EXPERIENCE </h1>
        <div class="row text-left work-content">
          <?php 
            $experiences = $current_user->experiences->take(5);
            foreach ($experiences as $experience):
          ?>
            <div class="col-lg-12">
              <p class="work-title"><?php echo $experience->title; ?></p>
              <p class="work-position"><?php echo $experience->field; ?></p>
              <p class="work-place"> <?php echo $experience->comp_name; ?> | 
                <?php
                  $startDate= strtotime('' .$experience->start_date);
                  if($experience->is_current)
                    $endDate = 'PRESENT';
                  else {
                    $endDate = strtotime('' .$experience->end_date);
                    $endDate = date('M Y', $endDate);
                  }
                  echo '<span>' .date('M Y', $startDate) .' - ' .$endDate .'</span> '
                ?>
              </p>
            </div>
          <?php endforeach; ?>

        </div>
        <div class="edit-button-container">
          <button type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#profExpModal">
            <span>Edit</span>
          </button> 
        </div>
      </div>
      <hr class="hr-main"></hr>
      <div class="row" style="padding: 0 25px;">
        <div class="section section-feedback text-center">
          <h1 style="margin:0 0 10px;"> DISCUSSIONS </h1>
          <?php 
          $comments = $user->comments->sortByDesc('id')->where('reply_id', '=', '0')->take(5);
          foreach ($comments as $comment) {
            echo '<h3>' .$comment->course->name .'</h3>
                <p>"' .$comment->body .'"<br>
                - <span>Bruce Lee</span>
                </p>';
            } 
          ?>
          
          <h2 class="text-center"> 
            <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#viewAllDicussions">
              <span class="view-all-button">VIEW ALL</span> 
            </button>
          </h2>
        </div>
      </div>
    </div>
    <div class="col-lg-4 section-right">
      <div class="section section-videos text-center">
        <h1 class="text-center" style="margin:0 0 30px;"> UPLOADED VIDEOS </h1>
        <div class="video-container">
          <?php 
            if (isset($assignments)) {
              $counter = 1;
              foreach ($assignments as $assignment) {
                echo '<div class="video">
                        <iframe src="' .$assignment->video_url .'"></iframe>
                        <!-- <div class="button">
                          <div class="arrow"></div>
                        </div> -->
                        <p>Entrepreneurship 1: Part ' .$counter .'</p>
                      </div>';
                $counter++;
              }
            }
          ?>
        </div>
        <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#viewUploadsModal">
          <h2 class="text-center"> <span class="view-all-button">VIEW ALL UPLOADS</span> </h2>
        </button>
      </div>
    </div>
  </div>
  <div class="row row-footer">
    <hr></hr>
    <h1 class="text-center"> NETWORK (<?php echo count($connected_users);?>)</h1>
    <div class="img-container">
      <?php
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
    </div>
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
<div class="modal fade prof-exp-popup" data-keyboard="false" data-backdrop="static" id="profExpModal" tabindex="-1" role="dialog" aria-labelledby="profExpModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">EDIT PROFESSIONAL EXPERIENCES</h1>
        <?php 
          $experiences = $current_user->experiences;
          foreach ($experiences as $experience):
        ?>
          <div class="experience-container experience-<?php echo $experience->id; ?>" id="<?php echo $experience->id; ?>"> 
            <p class="text-left profile-content"> JOB TITLE</p>
            <input id="title" placeholder="occupation name" value="<?php echo $experience->title;?>"></input>
            <p class="text-left profile-content"> PROFESSIONAL FIELD</p>
            <input id="field" placeholder="field name" value="<?php echo $experience->field;?>"></input>
            <p class="text-left profile-content"> COMPANY NAME </p>
            <input id="comp_name" placeholder="name of company" value="<?php echo $experience->comp_name;?>"></input>
            <div class="col-lg-12">
              <div class="col-lg-5">
                <p class="text-left profile-content"> DATE STARTED </p>
                <?php
                  $startDate= strtotime('' .$experience->start_date);
                  $date = "" .date('Y', $startDate) ."-".date('m', $startDate) ."-" .date('d', $startDate);
                  echo '<input id="startDate" type="date" name="bday" value="' .$date .'" >'
                ?>
              </div>
              <div class="col-lg-5 col-date-ended">
                <p class="text-left profile-content"> DATE ENDED </p>
                <?php
                  $endDate= strtotime('' .$experience->end_date);
                  $date = "" .date('Y', $endDate) ."-".date('m', $endDate) ."-" .date('d', $endDate);
                  $disabled = "";
                  $checked = "";
                  if($experience->is_current) { 
                    $disabled = "disabled"; 
                    $checked = "checked";
                    $date = "";
                  }
                ?>
                <input id="endDate" type="date" name="bday" value="<?php echo $date; ?>" class="<?php echo $disabled; ?>" <?php echo $disabled ?> >
                <input type="checkbox" id="current" row="experience-<?php echo $experience->id; ?>" <?php echo $checked; ?> > Current
              </div>
            </div>
          </div>
          <hr class="hr-main"></hr>
        <?php endforeach; ?>

        <p class="text-center add-exp">
          <span> + ADD EXPERIENCE </span> 
        </p>
        <p class="text-center save-button">
          <button id="save" type="button">SAVE</button> 
        </p>

        <div class="default-exp-container"> 
          <p class="text-left profile-content"> JOB TITLE</p>
          <input id="title" placeholder="occupation name"></input>
          <p class="text-left profile-content"> PROFESSIONAL FIELD</p>
          <input id="field" placeholder="field name"></input>
          <p class="text-left profile-content"> COMPANY NAME </p>
          <input id="comp_name" placeholder="name of company"></input>
          <div class="col-lg-12">
            <div class="col-lg-5">
              <p class="text-left profile-content"> DATE STARTED </p>
              <input id="startDate" type="date" name="bday">
            </div>
            <div class="col-lg-5 col-date-ended">
              <p class="text-left profile-content"> DATE ENDED </p>
              <input id="endDate" type="date" name="bday">
              <input type="checkbox" id="current"> Current
            </div>
          </div>
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

<div class="modal fade email-confirmation" data-keyboard="false" data-backdrop="static" id="emailConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="emailConfirmationModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">
          To view our latest features,<br>
          please confirm your email
        </h1>
        <p class="text-center main-title third">
          In case you didn't get it the first
          <br>
          time, we will gladly resend another
          <br>
          confirmation email
        </p>
        <div class="text-center">
          <button type="button" class="close done-button">
            Resend confirm email
          </button>
        </div>
      </div>   
    </div>
  </div>
</div>
<div class="modal fade email-confirmation" data-keyboard="false" data-backdrop="static" id="subscribeModal" tabindex="-1" role="dialog" aria-labelledby="emailConfirmationModalLabel">
  <div class="modal-dialog " role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <h1 class="text-center main-title second">
          To view our latest features,<br>
          please subscribe
        </h1>
        <div class="text-center">
          <a href="/settings#subscription">
            <button type="button" class="close done-button">
              Subscribe Now
            </button>
          </a>
        </div>
      </div>   
    </div>
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

          <h1 class="sub-header text-center">WELCOME TO BUSINESS ACADEMY</h1>
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
</style>
@stop