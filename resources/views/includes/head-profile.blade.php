<!-- NAVBAR profile
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
          <a class="navbar-brand" href="/" style="padding: 15px;"><img width="200" class="img-responsive center-block" src="/images/reinziion-logo-white.png"  
            alt="Reinvizion" title="Reinvizion">  </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <div class="user-dropdown-container first">
            <div class="relative-container">
              <p class="nav navbar-nav navbar-brand"id="header_user_name">
                <?php if($current_user->user_type == "consultant"): ?>
                  <span class="span-star" style="">★</span>
                <?php endif; ?>
                <?php 
                  if ($current_user->firstname != '' || $current_user->lastname != '') {
                    echo $current_user->firstname." ".$current_user->lastname; 
                  } else {
                    echo $current_user->name;
                  }
                ?>
              </p>
              <div class="profile-dropdown">
                <div class="arrow-down"></div>
                <div class="image-container">
                  <img style="background-image:url(<?php echo $current_user->image ?>);"></img>
                  <a href="/profile">
                    <p class="text-center profile-position"> VIEW PROFILE </p>
                   </a>
                </div>
                <!-- <p class="nav navbar-nav navbar-brand">BECOME INSTRUCTOR</p>
                <p class="nav navbar-nav navbar-brand">MY PROGRESS</p> -->
                <!-- <p class="nav navbar-nav navbar-brand">ACCOUNT</p> -->
                <?php if ($current_user->user_type == "Customer") { ?>
                  <a href="/reviews/business">
                    <p class="nav navbar-nav navbar-brand">REVIEWS</p>
                  </a>
                <?php } ?>
                <a href="/messages">
                  <p class="nav navbar-nav navbar-brand">MESSAGES</p>
                </a>
                <a href="/settings">
                  <p class="nav navbar-nav navbar-brand">SETTINGS</p>
                </a>
                <a href="/profile/services">
                  <p class="nav navbar-nav navbar-brand">BUSINESS SERVICES</p>
                </a>
                <p class="nav navbar-nav navbar-brand">
                  <a href="/logout">LOG OUT </a>
                </p>
              </div>
            </div>
            <?php if(isset($notifications)):?>
              <?php if(count($notifications) > 0): ?>
                <div class="relative-container">
                  <div class="user-notif-count"><?php echo count($notifications); ?></div>
                  <div class="notif-dropdown">
                    <div class="arrow-down"></div>
                    <?php 
                      $directs = $notifications->where('notif_type', '=', 'direct');
                      $others = $notifications->where('notif_type', '!=', 'direct');
                    ?>
                    <?php if(count($directs) > 0): ?>
                      <a href="/messages">
                        <div class="message-container">
                          <div class="col-lg-1" style="padding:0;">
                            <div class="user-notif-count"><?php echo count($directs);?></div>
                          </div>
                          <div class="col-lg-11" style="padding:0;">
                            <div class="message-direct text-left">
                              <p> New direct message </p>
                            </div>
                          </div>
                        </div>
                      </a>
                    <?php endif; ?>
                    <?php foreach($others as $notif): ?>
                      <?php if($notif->notif_type == "review"): ?>
                        <div class="message-container">
                          <div class="col-lg-1" style="padding:0;">
                            <div class="user-notif-count">1</div>
                          </div>
                          <div class="col-lg-11" style="padding:0;">
                            <div class="message-review text-left">
                              <p> You Have A New Review </p>
                            </div>
                          </div>
                        </div>
                      <?php else: ?>
                        <?php $course = $notif->course; ?>
                        <a href="/course/<?php echo $course->name; ?>">
                          <div class="message-container">
                            <div class="col-lg-2" style="padding:0;">
                              <div class="image"></div>
                            </div>
                            <div class="col-lg-10" style="padding:0;">
                              <div class="message-enroll text-left">
                                <p> <span>New enrollment</span> in <?php echo $course->name; ?> </p>
                              </div>
                            </div>
                          </div>
                        </a>
                      <?php endif; ?>
                    <?php endforeach; ?>
                    <!-- <div class="message-container">
                      <div class="col-lg-1" style="padding:0;">
                        <div class="user-notif-count">1</div>
                      </div>
                      <div class="col-lg-11" style="padding:0;">
                        <div class="message-review text-left">
                          <p> You Have A New Review </p>
                        </div>
                      </div>
                    </div>
                    <div class="message-container">
                      <div class="col-lg-2" style="padding:0;">
                        <div class="image"></div>
                      </div>
                      <div class="col-lg-10" style="padding:0;">
                        <div class="message-enroll text-left">
                          <p> <span>New enrollment</span> in Entrepreneurship 1 </p>
                        </div>
                      </div>
                    </div> -->
                    <p class="nav navbar-nav navbar-brand view-all-button">VIEW ALL</p>
                  </div>
                </div>
              <?php endif; ?>
            <?php endif; ?>
          </div>
          <div class="user-dropdown-container second">
            <div class="relative-container">
              <p class="nav navbar-nav navbar-brand"id="header_user_name">
                <?php if($current_user->user_type == "consultant"): ?>
                  <span class="span-star" style="">★</span>
                <?php endif; ?>
                <span class="span-user-name"><?php echo $user_name; ?></span>
                <?php if(isset($notifications)):?>
                  <?php if(count($notifications) > 0): ?>
                    <span class="user-notif-count"><?php echo count($notifications); ?></span>
                  <?php endif; ?>
                <?php endif; ?>
              </p>
              <div class="profile-dropdown">
                <div class="arrow-down"></div>
                <div class="image-container">
                  <img style="background-image:url(<?php echo $current_user->image ?>);"></img>
                  <p class="text-center profile-position"> <a href="/profile">VIEW PROFILE</a> </p>
                </div>
                <!-- <p class="nav navbar-nav navbar-brand">BECOME INSTRUCTOR</p>
                <p class="nav navbar-nav navbar-brand">MY PROGRESS</p>
                <p class="nav navbar-nav navbar-brand">ACCOUNT</p> -->
                <a href="/messages">
                  <p class="nav navbar-nav navbar-brand">MESSAGES</p>
                </a>
                <a href="/settings">
                  <p class="nav navbar-nav navbar-brand">SETTINGS</p>
                </a>
                <a href="/profile/services">
                  <p class="nav navbar-nav navbar-brand">BUSINESS SERVICES</p>
                </a>
                <p class="nav navbar-nav navbar-brand">
                  <a href="/logout">LOG OUT </a>
                </p>
              </div>
              <?php if(isset($notifications)):?>
                <?php if(count($notifications) > 0): ?>
                  <div class="notif-dropdown">
                    <div class="arrow-down"></div>
                    <?php 
                      $directs = $notifications->where('notif_type', '=', 'direct');
                      $others = $notifications->where('notif_type', '!=', 'direct');
                    ?>
                    <?php if(count($directs) > 0): ?>
                      <a href="/messages">
                        <div class="message-container">
                          <p>
                            <span class="user-notif-count"><?php echo count($directs);?></span>
                            <span class="message-direct">New direct message</span>
                          </p>
                        </div>
                      </a>
                    <?php endif; ?>
                    <?php foreach($others as $notif): ?>
                      <?php if($notif->notif_type == "review"): ?>
                        <div class="message-container">
                          <p>
                            <span class="user-notif-count">1</span>
                            <span class="message-review">You Have A New Review</span>
                          </p>
                        </div>
                      <?php else: ?>
                        <?php $course = $notif->course; ?>
                        <a href="/course/<?php echo $course->name; ?>">
                          <div class="message-container">
                            <p>
                              <span class="message-enroll"> <span>New enrollment</span> in <?php echo $course->name; ?></span>
                            </p>
                          </div>
                        </a>
                      <?php endif; ?>
                    <?php endforeach; ?>
                    <!-- <div class="message-container">
                      <p>
                        <span class="user-notif-count">1</span>
                        <span class="message-direct">New direct message</span>
                      </p>
                    </div>
                    <div class="message-container">
                      <p>
                        <span class="user-notif-count">1</span>
                        <span class="message-direct">New direct message</span>
                      </p>
                    </div> -->
                    <p class="nav navbar-nav navbar-brand view-all-button">VIEW ALL</p>
                  </div>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </nav>

  </div>
</div>