<head>
  <link rel="stylesheet" type="text/css" href="/css/admin-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/user-profile-public.css">
</head>
@extends('layouts.publicsidebarlayout')
@section('content')
<input type="text" id="user_id" value="<?php echo $user->id; ?>" hidden="hidden">
<div class="row row-header text-center">
  <div class="col-lg-12">
    <h1 class="sub-header text-center"><?php echo $user->name; ?></h2>
    <p class="text-center"><?php echo $user->occupation; ?></p>
    <?php
      if($current_user->id != $user->id){
        if($is_found == 1)
          echo '<h4 id="disconnect_button" class="page-header text-center connected"><span>CONNECTED<span></h4>';
        else
          echo '<h4 id="connect_button" class="page-header text-center"><span>CONNECT<span></h4>';
      }
    ?>
  </div>
</div>
<div class="row row-profile">
  <div class="col-lg-8 mar-section">
    <div class="section section-profile">
      <div class="col-lg-4">
        <img data-toggle="modal" data-target="#upload-image" class="user-img" style="background-image:url(<?php echo $user->image?>);"></img>
        <p class="text-center profile-position"><span style="color:#a10081;">★</span> INSTRUCTOR </p>
      </div>
      <div class="col-lg-8 public-profile-content row-profile-header">
        <p class="text-left profile-content"> BUSINESS GOAL:
          <span id="profession"> <?php echo $user->profession; ?></span> 
        </p>
        <p class="text-left profile-content"> EDUCATION:
          <span id="education"> <?php echo  "{$user->school}, {$user->degree}"; ?></span> 
        </p>
        <p class="text-left profile-content"> LOCATION:
          <span id="location"> <?php echo  "{$user->city}, {$user->state}"; ?></span>
        </p>
        <p class="text-left profile-website"> WEBSITE: 
          <a id="website"> <?php echo  "{$user->website}"; ?> </a> 
        </p>
        <?php
          $yrdata= strtotime('' .$user->created_at);
          echo '<p class="text-left"> MEMBER SINCE: <span>' .date('F Y', $yrdata) .'</span> </p>'
        ?>
      </div>
      <div class="profile-bio text-center">
        <p> <?php echo $user->bio; ?> </p>
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
      </div>
    </div>
    <hr class="hr-main"></hr>
    <div class="col-work">
      <div class="section section-discussions text-center">
        <h1 style="margin:20px 0 0;"> REVIEWS </h1>
        <?php 
          $comments = $user->comments->sortByDesc('id')->where('reply_id', '=', '0')->take(5);
          foreach ($comments as $comment) {
            $yrdata= strtotime('' .$comment->created_at);
            echo '<h3 style="text-transform:uppercase;" >' .date('M', $yrdata) .'/' .date('d', $yrdata) .' | ' .date('h:i A', $yrdata) .'</h3>
              <p>"' .$comment->body .'"
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
  </div>
</div>
<div class="row row-footer">
  <hr></hr>
  <h1 class="text-center"> NETWORK (<?php echo count($connected_users);?>)</h1>
  <div class="img-container">
    <?php 
      foreach ($connected_users as $con) {

        if($con->user_a->id == $user->id)
          $conUser = $con->user_b;
        else
          $conUser = $con->user_a;

        echo '<a href="/users/' .$conUser->id .'" target="_blank"> 
            <div class="img">
              <img style="background-image:url(' .$conUser->image .');"></img>
              <h1 class="text-center" style="margin:10px 0 0;"> ' .$conUser->name .' </h1>
              <p class="text-center" style="font-style: italic;font-weight: 500;">' .$conUser->profession .'</p>
            </div>
          </a>';
      }
        
    ?>
  
  <a href="/users/<?php echo $user->id; ?>/networks">
    <h4 class="page-header text-center"><span>VIEW CONNECTIONS<span></h4>
  </a>
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

@stop