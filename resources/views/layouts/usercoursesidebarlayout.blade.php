<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
  <!-- Custom styles for this template -->
  <!-- <link href="css/dashboard.css" rel="stylesheet"> -->
  <script src="https://player.vimeo.com/api/player.js"></script>
  <!--<script src="/js/users-profile.js"></script>-->
  <script src="/js/users-courses.js"></script>
  </head>

  <body>

    <header class="container">
        @include('includes.head-profile')
    </header>

    <div class="container-fluid" style="padding-top: 65px">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="overflow: hidden;padding:0;">
          <ul>
            <li>
              <div class="sidebar-header">
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button> -->
                <div class="sidebar-container text-center">
                  <p class="course-name"><?php echo $course->name; ?></p>
                  <div class="arrow-down"></div>
                  <?php 
                    if(isset($sections)): ?>
                      <?php $k=0; foreach ($sections as $section):?>
                        <div class="section-container section<?php echo $section->id; ?> <?php if($k == 0) {echo "active";} ?>" style=<?php if($k == 0) {echo "display:block;";} ?>>
                          <h3 class="section-name">
                            <?php echo $section->name; ?>
                          </h3>
                          <?php
                            $index = 0;
                            $subs = $section->sub_sections;
                            if(count($subs) > 0): 
                          ?>
                            <?php foreach($subs as $sub): ?> 
                              <h3 class="course-section" value="video{{$sub->id}}" sub-id="{{$sub->id}}" index="{{$index}}"><?php echo $sub->name; ?></h3>
                            <?php $index = $index + 1; endforeach; ?>
                            <hr style="height:1px;margin-bottom: 40px;"></hr>
                          <?php endif; ?>
                          <?php
                            $k = $k + 1;
                            $isActive = true;
                            if($section->section_index > 1) {
                              $secUser = $section->user_course_sections->Where("user_id", "=", $current_user->id)->first();
                              if(!isset($secUser)) {
                                $isActive = false;
                              }
                            }

                            if(isset($sections[$k])):
                          ?>
                            <?php 
                              $sectIndex;
                              if($sectIndex < $sections[$k]->section_index) {
                                $isActive = false;
                              }
                            ?>
                            <h3 class="next-section <?php if(!$isActive){ echo "inactive"; }?>" target="section{{$sections[$k]->id}}">
                              <span style="text-decoration: underline;">NEXT SECTION</span>
                              <!-- <span class="arrow-right"></span> -->
                              <br>
                              <span class="next-section-name"><?php echo $sections[$k]->name; ?></span>
                              <br>
                              <?php if($sectIndex < $sections[$k]->section_index){ 
                                $indexCount = ($sections[$k]->section_index * 7) - $userInterval;
                              ?>
                                <span class="next-section-name section-countdown">{{number_format($indexCount)}} day(s) to go.</span>
                              <?php } ?>
                            </h3>
                          <?php endif; ?>
                        </div>
                      <?php endforeach; ?>
                  <?php endif; ?>
                </div>
              </div>
            </li>
            <li>
              <div class="text-container">
                <p>YOUR COURSES <span style="margin-left:5px;"> >> </span>
                </p>
              </div>
            </li>
          </ul>
          <!-- @include('includes.usersidebar') -->
        </div>
    
    <!-- include content -->
        <div class="col-sm-9 col-sm-offset-3 col-md-10 main" style="margin:0;padding:0;">
          @yield('content')
        </div>
      </div>
    </div>
  </body>
</html>