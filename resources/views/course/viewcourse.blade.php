<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/user-course.css">
</head>
@extends('layouts.usercoursesidebarlayout')
@section('content')
<input type="text" id="name_value" value="<?php echo $user_name; ?>" hidden="hidden">
<input type="text" id="image_value" value="<?php echo $user_image; ?>" hidden="hidden">
<input type="text" id="course_value" value="<?php echo $course->name; ?>" hidden="hidden">
<div class="row video-container main">
  <div class="video">
    <iframe class="vimeo-video" frameborder="0"></iframe>
  </div>
</div>
<div class="row row-header">
  <div class="col-lg-6">
    <!-- <h1 style="float:left;">TAUGHT BY: MICHAEL CHAPMAN</h1> -->
  </div>
  <div class="col-lg-6">
    <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#sendMessageModal">
      <span>send a message</span>
    </button>
  </div>
</div>
<h1 class="summary">SUMMARY | ASSIGNMENT</h1>
<div class="row row-summary">
  <h1 class="summary-title text-left"><?php echo $course->name; ?></h1>
  <p class="summary-body text-left">
    <!-- <?php echo $course->summary; ?> -->
  </p>
</div>
<hr class="hr-main"></hr>
<div class="row row-profile">
  <div class="col-lg-8 section-left">
    <div class="section section-discussions">
      <h1 style="margin:20px 0 0;" class="text-center"> DISCUSSIONS </h1>
      <div class="comments-container">
      </div>
      <!--<?php 
        if (isset($comments)) {
          foreach ($comments as $comment) {
            $yrdata= strtotime('' .$comment->created_at);
            echo '<div class="container-duscussion">
                    <div class="col-lg-1" style="padding:0;">
                      <div class="image">
                        <img src="' .$comment->user->image .'"></img>
                      </div>
                    </div>
                    <div class="col-lg-11 discuss-body">
                      <p class="discuss-body-title">' .$comment->user->name .' | <span>' .date('M', $yrdata) .'/' .date('d', $yrdata) .' | ' .date('h:i A', $yrdata) .'</span></p>
                      <p class="discuss-body-message">' .$comment->body .'</p>';
            $replies = $comment->replies()->take(5);
            if(isset($replies)) {
              foreach ($replies as $reply) {
                $yrdata= strtotime('' .$reply->created_at);
                echo '<div class="row" style="margin:30px 0 0;">
                        <div class="col-lg-1 discussion-col" style="padding:0;">
                          <div class="image">
                            <img src="' .$reply->user->image .'"></img>
                          </div>
                        </div>
                        <div class="col-lg-11 discuss-body discussion-col">
                          <p class="discuss-body-title">' .$reply->user->name .' | <span>' .date('M', $yrdata) .'/' .date('d', $yrdata) .' | ' .date('h:i A', $yrdata) .'</span></p>
                          <p class="discuss-body-message">' .$reply->body .'</p>
                        </div>
                      </div>';
              }
              if($comment->replies()->count() > 5)
                echo '<h2 class="text-center view-all comments"> <span class="view-all-button" comment_id="' .$comment->id .'" index="5">VIEW MORE REPLIES</span> </h2>';
            }
            echo    '
                      <div class="row row-' .$comment->id .' reply-container" style="margin:30px 0 0;">
                        <div class="col-lg-1" style="padding:0;">
                        </div>
                        <div class="col-lg-11 discuss-body">
                          <textarea id="replyComment" reply_id=' .$comment->id .' row="row-' .$comment->id .'" placeholder="Write a reply..."></textarea>
                          <button type="button" id="reply-save" class="reply-save-button" 
                              style="  margin: 15px 0 0 450px;
                              border: 1px solid;
                              border-color: #ff0586;
                              background-color: white;
                              color: #ff0586;" >SUBMIT</button>
                        </div>
                      </div>
                    </div>
                  </div>';
          }
          if($course->course_comments->Where('reply_id', '=', 0)->count() > 10)
            echo '<h2 class="text-center view-all comments main"> <span  index="10" class="view-all-button">VIEW MORE COMMENTS</span> </h2>';
          else 
            echo '<div class="view-all comments" style="display:none;"></div>';
        }
      ?>-->
      <textarea class="discus-thread add-comment" placeholder="Start a thread..."></textarea>
      <button type="button" id="message-save" class="reply-save-button">SUBMIT</button>
    </div>
  </div>
  <div class="col-lg-4 section-right">
    <div class="row">
      <div class="section section-videos text-center">
        <h1 class="text-center" style="margin:20px 0 30px;"> UPLOADED<br>ASSIGNMENTS </h1>
        <?php 
          if (isset($assignments)) {
            echo '<div class="video-container">';
            foreach ($assignments->take(5) as $assignment) {
              echo '<div class="video">
                      <p>By ' .$assignment->user->name .'</p>
                      <iframe src="' .$assignment->video_url .'"></iframe>
                      <!-- <div class="button">
                        <div class="arrow"></div>
                      </div> -->
                    </div>';
            }
            echo '</div>';
          }
        ?>
        <div class="button-container">
          <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#assignmentsModal">
            <span class="view-all-button">VIEW ALL</span> 
          </button>
        </div>
        <hr></hr>
        <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#sendAssignmentModal">
          <span class="view-all-button">+SUBMIT ASSIGNMENT</span> 
        </button>
      </div>
    </div>
  </div>
</div>
<div class="row row-footer">
  <hr></hr>
  <h1 class="text-center"> YOUR CLASSMATES </h1>
  <div class="img-container">
    <?php 
    $tempUsers = array_slice($users, 0, 5);
    foreach ($tempUsers as $user) {
      echo '<a href="/users/' .$user->id .'"><div class="img">
        <img style="background-image:url(' . $user->image .');"></img>
        <h1 class="text-center" style="margin:10px 0 0;">' .$user->name .' </h1>
        <p class="text-center" style="font-style: italic;font-weight: 500;"> ' .$user->profession .' </p>
      </div></a>';
    } 
    ?>
  <div class="button-container text-center">
    <button type="button" data-dismiss="modal" data-toggle="modal" data-target="#classmatesModal">
      <span class="view-all-button">VIEW ALL</span> 
    </button>
  </div>
  </div>
</div>


<div class="modal fade send-message-popup" data-keyboard="false" data-backdrop="static" id="sendMessageModal" tabindex="-1" role="dialog" aria-labelledby="sendMessageModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">SEND A MESSAGE</h1>
        <h2 class="sub-header text-center">QUESTIONS? CONCERNS?</h2>

        <p class="text-left message-p"> YOUR MESSAGE </p>
        <textarea id="bio" maxlength="250" placeholder="write a message..."></textarea>

        <p class="text-center">
          <button id="submit" type="button">SUBMIT</button> 
        </p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade assignments-popup" data-keyboard="false" data-backdrop="static" id="assignmentsModal" tabindex="-1" role="dialog" aria-labelledby="assignmentsModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">UPLOADED ASSIGNMENTS</h1>

        <?php if (isset($assignments)):?>
          <div class="video-container">
            <?php foreach ($assignments as $assignment):?>
              <div class="video">
                <p>By <?php echo $assignment->user->name;?></p>
                <iframe src="<?php echo $assignment->video_url; ?>"></iframe>
              </div>
            <?php endforeach; ?>
          </div>

        <?php endif; ?>

        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close" id="submit">DONE</button> 
        </p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade classmates-popup" data-keyboard="false" data-backdrop="static" id="classmatesModal" tabindex="-1" role="dialog" aria-labelledby="classmatesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">YOUR CLASSMATES (<?php echo count($users); ?>)</h1>

        <?php foreach ($users as $classmate): ?>
          <a href="/users/<?php echo $classmate->id;?>">
            <div class="img text-center">
              <img style="background-image:url(<?php echo $classmate->image; ?>);"></img>
              <h1 class="text-center" style="margin:10px 0 0;"><?php echo $classmate->name; ?></h1>
              <p class="text-center"><?php echo $classmate->profession; ?></p>
            </div>
          </a>
        <?php endforeach; ?>

        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close" id="submit">DONE</button> 
        </p>
      </div>
    </div>
  </div>
</div>
<div class="modal fade send-assignment-popup" data-keyboard="false" data-backdrop="static" id="sendAssignmentModal" tabindex="-1" role="dialog" aria-labelledby="sendAssignmentModal">
  <div class="modal-dialog" role="document" style="position:relative;">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">UPLOAD AN ASSIGNMENT</h1>
        <div class="input-container">
          <p class="url-text"> Youtube URL: </p>
          <input id="url"></input>
        </div>

        <p class="text-center">
          <button id="submit" type="button">SUBMIT</button> 
        </p>
      </div>
    </div>
    <div class="loading">Loading&#8230;</div>
  </div>
</div>

<?php if($current_user->first_course): ?>
  <?php 
    $current_user->first_course = false;
    $current_user->save();
  ?>
  <button id="welcome-popup-button" type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#welcome-popup" style="display:none;">
  </button>
  <div class="modal fade welcome-popup upload-image" data-keyboard="false" data-backdrop="static" id="welcome-popup" tabindex="-1" role="dialog" aria-labelledby="welcome-popup">
    <div class="modal-dialog" role="document" style="position:relative;">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <div class="modal-header">

          <h1 class="sub-header text-center">LIKE BUSINESS ACADEMY</h1>
          <h2 class="sub-header text-center">TO GET FULL ACCESS, PLEASE<br>SUBSCRIBE BELOW:</h2>
          <p class="text-center">
            <a href="/settings#subscription">
              <button id="submit" type="button">SUBSCRIBE</button>
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#welcome-popup-button").trigger("click");
    });
  </script>
<?php endif; ?>
@stop