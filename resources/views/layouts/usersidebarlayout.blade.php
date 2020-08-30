<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
	<!-- Custom styles for this template -->
	<!-- <link href="css/dashboard.css" rel="stylesheet"> -->
  <!-- <script src="js/users-profile.js"></script> -->
  </head>

  <body>

    <header class="container">
        @include('includes.head-profile')
    </header>

    <div class="container-fluid" style="padding: 65px 0 0;">
      <div class="row" style="margin:0;">
        <div class="col-sm-12 col-sm-offset-3 col-md-12 main" style="margin:0;padding-left:0;padding-right: 0;">
          @yield('content')
        </div>
      </div>
    </div>
  </body>
</html>