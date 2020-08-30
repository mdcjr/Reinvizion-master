<head>
  <link rel="stylesheet" type="text/css" href="/css/admin-profile.css">
</head>
@extends('layouts.adminsidebarlayout')
@section('content')
<div class="row row-header text-center">
  <div class="col-lg-12">
    <h1 class="sub-header text-center"><?php echo $user_name; ?></h2>
    <p class="text-center"> Graphic Designer</p>
    <div class="stars-container">
      <div class="star-ratings-css-top" style="width: 90%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
    </div>
  </div>
</div>
<div class="row row-profile">
  <div class="col-lg-8 mar-section">
    <div class="section section-profile">
      <div class="col-lg-4">
        <img data-toggle="modal" data-target="#upload-image" class="user-img" src="/images/facebook-avatar.png"></img>
        <p class="text-center profile-position"><span style="color:#a10081;">★</span> INSTRUCTOR </p>
      </div>
      <div class="col-lg-8">
        <p class="text-left profile-content"> BUSINESS GOAL: <span style="font-style: italic;font-weight: 200;"> PROFESSION</span> </p>
        <p class="text-left profile-content"> EDUCATION: <span style="font-style: italic;font-weight: 200;"> SCHOOL, DEGREE</span> </p>
        <p class="text-left profile-content"> LOCATION: <span style="font-style: italic;font-weight: 200;"> CITY, STATE</span> </p>
        <p class="text-left profile-content"> WEBSITE: <a style="font-style: italic;font-weight: 200;"> http://www.website.com</a> </p>
        <p class="text-left profile-content"> MEMBER SINCE: <span style="font-style: italic;font-weight: 200;"> JANUARY 2017</span> </p>
      </div>
      <div class="profile-bio text-center">
        <p> <?php echo $user->bio; ?> </p>
      </div>
      <div class="edit-button-container">
        <!-- <p class="edit-button">Edit</p> -->
        <button type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#editUserModal">
          <span>Edit</span>
        </button>  
        <!-- <p class="cancel-button">Cancel</p>
        <p class="save-button">Save</p> -->
      </div>
    </div>
  </div>
</div>
<hr class="hr-main"></hr>
<div class="row row-profile">
  <div class="col-lg-12">
    <div class="col-work">
      <div class="section section-work">
        <h1 class="text-center" style="margin:0;"> PROFESSIONAL EXPERIENCE </h1>
        <div class="row text-left work-content">
          <?php 
            $experiences = $user->experiences->take(5);
            foreach ($experiences as $experience):
          ?>
            <div class="col-lg-12">
              <p class="work-title"><?php echo $experience->title; ?></p>
              <p class="work-position"><?php echo $experience->field; ?></p>
              <p class="work-place"> <?php echo $experience->comp_name; ?> | 
                <?php
                  $startDate= strtotime('' .$experience->start_date);
                  $endDate= strtotime('' .$experience->end_date);
                  echo '<span>' .date('M Y', $startDate) .' - ' .date('M Y', $endDate) .'</span> '
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
    </div>
    <hr class="hr-main"></hr>
    <div class="col-work">
      <div class="section section-discussions text-center">
        <h1 style="margin:20px 0 0;"> REVIEWS </h1>
        <?php 
          for ($x = 0; $x <= 3; $x++) {
            echo '<h3>MONTH/DAY | TIME</h3>
              <p>"Always watch where you are going. Otherwise, you may step on a piece of the forest that was left out by mistake."
                <br>- <span>Winnie the Pooh</span>
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
    <!-- <hr class="hr-main"></hr>
    <div class="row" style="padding: 0 25px;">
      <div class="col-lg-12" style="padding:0 5px 0 0;">
        <div class="section section-videos">
          <h1 class="text-center" style="margin:20px 0 30px;"> UPLOADED VIDEOS </h1>
          <div class="video-container">
            <img src="images/business-academy.jpg" class="video"></img>
            <p>Entrepreneurship 1: Part 1</p>
          </div>
          <div class="video-container">
            <img src="images/business-academy.jpg" class="video"></img>
            <p>Entrepreneurship 1: Part 2</p>
          </div>
          <div class="video-container">
            <img src="images/business-academy.jpg" class="video"></img>
            <p>Entrepreneurship 1: Part 3</p>
          </div>
          <div class="video-container">
            <img src="images/business-academy.jpg" class="video"></img>
            <p>Entrepreneurship 1: Part 4</p>
          </div>
          <h2 class="text-center" style="margin:60px 0 30px;"> <span class="view-all-button">VIEW ALL UPLOADS</span> </h2>
        </div>
      </div>
      <hr class="hr-main"></hr>
      <div class="col-lg-12" style="padding: 0 0 0 5px;">
        <div class="section section-feedback text-center">
          <h1 style="margin:20px 0 10px;"> FEEDBACK </h1>
          <h3>MONTH/DAY | TIME</h3>
          <p>"You can't stay in your corner of the
            Forest waiting for others to come to
            you. You have to go to them sometimes."<br>
            - <span>Winnie the Pooh</span>
          </p>
          <h3>MONTH/DAY | TIME</h3>
          <p>"You can't stay in your corner of the
            Forest waiting for others to come to
            you. You have to go to them sometimes."<br>
            - <span>Winnie the Pooh</span>
          </p>
          <h3>MONTH/DAY | TIME</h3>
          <p>"You can't stay in your corner of the
            Forest waiting for others to come to
            you. You have to go to them sometimes."<br>
            - <span>Winnie the Pooh</span>
          </p>
          <h2 class="text-center"> <span class="view-all-button">VIEW ALL</span> </h2>
        </div>
      </div>
    </div> -->
  </div>
  <!-- <div class="col-lg-4 section-right">
    <div class="section section-rating">
      <h1 class="text-center" style="margin:20px 0;font-size:23px;"> OVERALL RATING </h1>
      <hr></hr>
      <h1 class="text-center" style="margin:0;font-size:23px;"> 4.5 OUT OF 5 (15) </h1>
      <div class="stars-container">
        <div class="star-ratings-css-top" style="width: 90%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
      </div>
    </div>
    <div class="section section-courses">
      <h1 class="text-center" style="margin:20px 0;font-size:23px;"> COURSES TAUGHT </h1>
      <hr></hr>
      <?php 
        for ($x = 0; $x < 6; $x++) {
          echo '<h1 class="courses-name"> COURSE NAME</h1>';
        } 
      ?>
      <h2 style="margin:20px 0 0;"> <span class="view-all-button">+CREATE COURSE</span> </h1>
    </div>
  </div> -->
</div>
<div class="row row-footer">
  <hr></hr>
  <h1 class="text-center"> NETWORK (150)</h1>
  <div class="img-container">
    <?php 
    for ($x = 0; $x < 5; $x++) {
        echo '<div class="img">
          <img src="/images/alternative-learning.jpg"></img>
          <h1 class="text-center" style="margin:10px 0 0;"> NAME </h1>
          <p class="text-center" style="font-style: italic;font-weight: 200;"> CURRENT POSITION </p>
        </div>';
    } 
    ?>
  
  <a href="/profile/networks"><h4 class="page-header text-center"><span>VIEW CONNECTIONS<span></h1></a>
  </div>
</div>

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
        <input id="occupation" value="<?php echo $user->occupation; ?>"></input>
        <p class="text-left profile-content"> FIELD OF BUSINESS</p>
        <input id="profession" value="<?php echo $user->profession; ?>"></input>
        <p class="text-left profile-content"> EDUCATION</p>
        <input id="school" value="<?php echo $user->school; ?>"></input>
        <p class="text-left profile-content"> DEGREE</p>
        <input id="degree"value="<?php echo $user->degree; ?>"></input>
        <p class="text-left profile-content"> WEBSITE </p>
        <input id="website" value="<?php echo $user->website; ?>"></input>
        <div class="col-lg-12">
          <div class="col-lg-5">
            <p class="text-left profile-content"> BIRTH DATE </p>
            <!-- <input type="date" name="bday" value="<?php echo $user->created_at ?>" > -->
            <!-- <input type="date" name="bday" value="2013-01-08" > -->
            <?php
              $yrdata= strtotime('' .$user->birthdate);
              $date = "" .date('Y', $yrdata) ."-".date('m', $yrdata) ."-" .date('d', $yrdata);
              echo '<input id="birthdate" type="date" name="bday" value="' .$date .'" >'
            ?>
          </div>
          <div class="col-lg-5" style="float:right;">
            <p class="text-left profile-content"> GENDER </p>
            <select name="gender">
              <option value="NO">No Answer</option>
              <option value="F">F</option>
              <option value="M">M</option>
            </select>
          </div>
        </div>
        <p class="text-left profile-content"> BIO </p>
        <textarea id="bio" maxlength="250" placeholder="send a message..."><?php echo $user->bio; ?></textarea>

        <hr class="hr-main"></hr>

        <h2 class="sub-header text-center">CONTACT INFO</h2>
        <p class="text-left profile-content"> EMAIL</p>
        <input id="email" value="<?php echo $user->email; ?>"></input>
        <p class="text-left profile-content"> PHONE</p>
        <input id="phone" value="<?php echo $user->phone; ?>"></input>
        <p class="text-left profile-content"> ADDRESS</p>
        <input id="addr" value="<?php echo $user->addr; ?>"></input>
        <div class="col-lg-12">
          <div class="col-lg-5">
            <p class="text-left profile-content"> CITY </p>
            <input id="city" value="<?php echo $user->city; ?>"></input>
          </div>
          <div class="col-lg-5" style="float:right;">
            <p class="text-left profile-content"> STATE </p>
            <input id="state" value="<?php echo $user->state; ?>"></input>
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

        <h1 class="sub-header text-center">YOUR REVIEWS</h1>
        <h1 class="text-center rating" style="margin:0;font-size:23px;"> 4.5 OUT OF 5 (15) </h1>
        <div class="stars-container">
          <div class="star-ratings-css-top" style="width: 90%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
          <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
        </div>
        <div class="comments-container">
          <?php 
            $comments = $user->comments->where('reply_id', '=', '0');
            if (isset($comments)) {
              foreach ($comments as $comment) {
                $yrdata= strtotime('' .$comment->created_at);
                // echo '<p class="text-left profile-content"> MEMBER SINCE: <span>' .date('M Y', $yrdata) .'</span> </p>';

                echo '<div class="container-duscussion">
                        <div class="col-lg-1" style="padding:0;">
                          <div class="image">
                            <img src="/images/alternative-learning.jpg"></img>
                          </div>
                        </div>
                        <div class="col-lg-11 discuss-body">
                          <div class="col-lg-12">
                            <p class="discuss-body-title">' .$comment->user->name .' | <span>' .date('M', $yrdata) .'/' .date('d', $yrdata) .' | ' .date('h:i A', $yrdata) .'</span></p>
                            <div class="stars-container">
                              <div class="star-ratings-css-top" style="width: 90%"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                              <div class="star-ratings-css-bottom"><span>★</span><span>★</span><span>★</span><span>★</span><span>★</span></div>
                            </div>
                          </div>
                          <p class="discuss-body-message">' .$comment->body .'</p>
                        </div>
                      </div>
                      <hr class="hr-main"></hr>';
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">UPLOAD YOUR PROFILE IMAGE</h1>
        <h2 class="sub-header text-LEFT">CURRENT PHOTO</h2>
        <img src="/images/facebook-avatar.png"></img>

        <!-- <textarea id="bio" maxlength="250" placeholder="write a message..."></textarea> -->

        <div class="browse-container text-center">
          <p>+ BROWSE IMAGES</p>
        </div>

        <p class="text-center">
          <button id="submit" type="button">SUBMIT</button> 
        </p>
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
          $experiences = $user->experiences;
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
              <div class="col-lg-5" style="float:right;">
                <p class="text-left profile-content"> DATE ENDED </p>
                <?php
                  $endDate= strtotime('' .$experience->end_date);
                  $date = "" .date('Y', $endDate) ."-".date('m', $endDate) ."-" .date('d', $endDate);
                  echo '<input id="endDate" type="date" name="bday" value="' .$date .'" >'
                ?>
                <input type="checkbox" id="current" row="experience-<?php echo $experience->id; ?>"> Current
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
            <div class="col-lg-5" style="float:right;">
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

@stop