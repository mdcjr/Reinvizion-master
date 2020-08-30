<head>
  <link rel="stylesheet" type="text/css" href="css/user-profile.css">
</head>
@extends('layouts.usersidebarlayout')
@section('content')
<div class="row row-header text-center">
  <div class="col-lg-12">
    <h4 class="page-header text-center">BUSINESS ACADEMY</h1>

    <h1 class="sub-header text-center">WELCOME!</h2>

    <button type="button" class="text-center">START LEARNING</button>
    
  </div>
  <div class="col-lg-12 row-progress">
    <div class="row">
      <div class="col-lg-10">
        <p class="text-center">CURRENT COURSE</p>
      </div>
      <div class="col-lg-10">
        <div class="max-progress">
          <div class="current-progress" style=<?php echo $current_course_value; ?>></div>
        </div>
      </div>
      <div class="col-lg-2 text-right">
        <p> %<?php echo $current_course; ?> DONE </p>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-10">
        <p class="text-center">OVERALL</p>
      </div>
      <div class="col-lg-10">
        <div class="max-progress">
          <div class="current-progress" style=<?php echo $overall_value; ?>></div>
        </div>
      </div>
      <div class="col-lg-2 text-right">
        <p> %<?php echo $overall; ?> DONE </p>
      </div>
    </div>
  </div>
</div>
<div class="row row-profile">
  <!-- <div class="table-responsive">
  </div> -->
  <div class="col-lg-8 section-left">
    <div class="section section-profile">
      <div class="col-lg-5">
        <img src="images/alternative-learning.jpg"></img>
        <p class="text-center" style="margin:10px 0 0;"> <?php echo $user_name; ?> </p>
        <p class="text-center" style="font-style: italic;font-weight: 500;"> CURRENT POSITION </p>
      </div>
      <div class="col-lg-7">
        <p class="text-left" style="margin:30px 0 0;"> BUSINESS GOAL: <span style="font-style: italic;font-weight: 500;"> PROFESSION</span> </p>
        <p class="text-left" style="margin:30px 0 0;"> EDUCATION: <span style="font-style: italic;font-weight: 500;"> SCHOOL, DEGREE</span> </p>
        <p class="text-left" style="margin:30px 0 0;"> LOCATION: <span style="font-style: italic;font-weight: 500;"> CITY, STATE</span> </p>
      </div>
    </div>
    <div class="section section-work">
      <h1 class="text-center" style="margin:20px 0 30px;"> WORK EXPERIENCE </h1>
      <div class="row text-left">
        <?php 
          for ($x = 0; $x < 6; $x++) {
            echo '<div class="col-lg-6">
              <p style="margin:15px 0 0;font-weight:200;"> PROFESSION </p>
              <h1 style="margin:0;"> BUSINESS </h1>
            </div>';
          } 
        ?>
      </div>
    </div>
    <div class="row" style="padding: 0 25px;">
      <div class="col-lg-6" style="padding:0 5px 0 0;">
        <div class="section section-videos">
          <h1 class="text-center" style="margin:20px 0 30px;"> UPLOADED<br>VIDEOS </h1>
          <div class="video-container">
            <div class="video"></div>
            <div class="video"></div>
            <div class="video"></div>
          </div>
          <hr></hr>
          <h2 class="text-center"> <span class="view-all-button">VIEW ALL</span> </h2>
        </div>
      </div>
      <div class="col-lg-6" style="padding: 0 0 0 5px;">
        <div class="section section-feedback text-center">
          <h1 style="margin:20px 0 30px;"> FEEDBACK </h1>
          <h3 style="margin:21px 0 0;">MONTH/DAY | TIME</h3>
          <p>"I fear not the man who has prac<br>
            ticed 10,000 kicks once, but I fear<br>
            the man who has practiced one kick<br>
            10,000 times." - <span>Bruce Lee</span>
          </p>
          <hr></hr>
          <h3>MONTH/DAY | TIME</h3>
          <p>"I fear not the man who has prac<br>
            ticed 10,000 kicks once, but I fear<br>
            the man who has practiced one kick<br>
            10,000 times." - <span>Bruce Lee</span>
          </p>
          <hr></hr>
          <h3>MONTH/DAY | TIME</h3>
          <p>"I fear not the man who has prac<br>
            ticed 10,000 kicks once, but I fear<br>
            the man who has practiced one kick<br>
            10,000 times." - <span>Bruce Lee</span>
          </p>
          <hr></hr>
          <h2 class="text-center"> <span class="view-all-button">VIEW ALL</span> </h2>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 section-right">
    <div class="section section-streak">
      <h1 class="text-center" style="margin:20px 0;font-size:23px;"> STREAKS </h1>
      <hr></hr>
      <h1 class="text-center"> CURRENT STREAK: </h1>
      <p class="text-center"> 3 DAYS </p>
      <h1 class="text-center"> LONGEST STREAK: </h1>
      <p class="text-center"> 5 DAYS </p>
      <h1 class="text-center" style="margin:40px 0;font-size:23px;"> BADGES </h1>
      <div class="badges-container">
        <div class="img"></div>
        <div class="img"></div>
        <div class="img"></div>
        <div class="img"></div>
        <div class="img"></div>
        <div class="img"></div>
      </div>
    </div>
    <div class="section section-discussions text-center">
      <h1 style="margin:20px 0 0;"> DISCUSSIONS </h1>
      <?php 
        for ($x = 0; $x < 4; $x++) {
          echo '<hr></hr>
            <h3>FROM (COURSE VIDEO NAME)</h3>
            <p>"I&quot;m not in this world to live up to<br>
              your expectations and you&quot;re not in<br>
              this world to live up to mine." -<br>
              <span>Bruce Lee</span>
            </p>';
        } 
      ?>
      <hr style="margin-top: 16px;"></hr>
      <h2 class="text-center"> <span class="view-all-button">VIEW ALL</span> </h2>
    </div>
  </div>
</div>
<div class="row row-footer">
  <hr></hr>
  <h1 class="text-center"> NETWORK </h1>
  <div class="img-container">
    <?php 
    for ($x = 0; $x < 5; $x++) {
        echo '<div class="img">
          <img src="images/alternative-learning.jpg"></img>
          <h1 class="text-center" style="margin:10px 0 0;"> NAME </h1>
          <p class="text-center" style="font-style: italic;font-weight: 500;"> CURRENT POSITION </p>
        </div>';
    } 
    ?>
  <h4 class="page-header text-center" style="margin-top:20px;">FIND MORE CONNECTIONS</h1>
  </div>
</div>
@stop