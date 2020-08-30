<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
  <!-- Custom styles for this template -->
  <!-- <link href="css/dashboard.css" rel="stylesheet"> -->
  <!--<script src="/js/users-admin.js"></script>-->
  <script src="/js/users-profile-public.js"></script>
  </head>

  <body>

    <header class="container">
        @include('includes.head-profile-public')
    </header>

    <div class="container-fluid" style="padding-top: 65px">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar" style="overflow: hidden;padding:0;">
          <ul>
            <li>
              <div class="sidebar-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">X</button>
                <div class="sidebar-container text-center">
                  <p>THE JOURNEY<br>YOU LEAD</p>
                  <div class="arrow-down"></div>
                  <?php 
                    foreach ($courses as $course) {
                      echo '<h3>' .$course->name .'</h3>';
                    } 
                  ?>
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
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" style="margin:0;padding-left:60px;padding-right: 100px;">
          @yield('content')
        </div>
      </div>
    </div>
  </body>
</html>