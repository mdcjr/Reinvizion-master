<!-- NAVBAR
================================================== -->
<div class="navbar-wrapper">
  <div class="container">

    <nav class="navbar navbar-inverse navbar-fixed-top" style="min-height: 65px;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/"><img width="200" class="img-responsive center-block" src="/images/reinvizion (1).png"  alt="Reinvizion" title="Reinvizion">  </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div class="user-dropdown-container">
            <p class="nav navbar-nav navbar-brand"id="header_user_name"><span class="span-star" style="">★</span><?php echo $user_name; ?></p>
            <div class="user-notif-count">1</div>
            <div class="profile-dropdown">
              <div class="arrow-down"></div>
              <div class="image-container">
                <img src="/images/alternative-learning.jpg"></img>
                <p class="text-center profile-position"> VIEW PROFILE </p>
              </div>
              <p class="nav navbar-nav navbar-brand">CREATE A COURSE</p>
              <p class="nav navbar-nav navbar-brand">STUDENT PROGRESS</p>
              <p class="nav navbar-nav navbar-brand">ACCOUNT</p>
              <a href="/settings">
                <p class="nav navbar-nav navbar-brand">SETTINGS</p>
              </a>
              <p class="nav navbar-nav navbar-brand">
                <a href="/logout">LOG OUT </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </nav>

  </div>
</div>