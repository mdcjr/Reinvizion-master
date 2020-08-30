<html lang="en">
  @include('includes.head')
  <head>
    <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
    <link rel="stylesheet" type="text/css" href="css/landing-page-001.css">
  </head>
  <style>
    body {
      background-image: url('/images/coming-soon-bg.jpg');
      background-repeat: no-repeat;
      background-size: 100%;
    }
    .navbar.navbar-default.navbar-fixed-top.topnav {
      background-image: linear-gradient(to right,#fcfcfc,#c9c9c9,#fcfcfc)!important;
      padding: 30px 0;
    }
    .content-section-a.a-1 {
      float: left;
      width: 100%;
      padding: 92px 0 30px;
      background: none;
    }
    .content-section-a.a-1 .back-container {
      float: left;
      margin: 20px 0 0 20px;
      cursor: pointer;
    }
    .content-section-a.a-1 .back-container p {
      float: left;
      font-weight: 500;
      letter-spacing: 2px;
      margin: 0;
      color: #fff;
      font-size: 14px;
      padding: 0;
      width: auto;
    }
    .content-section-a.a-1 .back-container .arrow-left {
      width: 0;
      height: 0;
      margin: 2px 10px 0 0 ;
      float: left;
      border-right: 8px solid #fff;
      border-top: 8px solid transparent;
      border-bottom: 8px solid transparent;
    }
    .content-section-a.a-1 h1, .content-section-a.a-1 h2, .content-section-a.a-1 p{
      float: left;
      width: 100%;
      font-weight: 500;
      padding: 0 0 0 300px;
      color: #fff;
      margin: 0 0 20px;
    }
    .content-section-a.a-1 h1 {
      font-size: 45px;
      padding-top: 60px;
      margin-bottom: 30px;
    }
    .content-section-a.a-1 p {
      font-size: 23px;
      font-weight: 200;
      padding: 0;
      margin: 0;
    }
    .content-section-a.a-1 p a{
      color: #fff;
      text-decoration: underline;
      cursor: pointer;
    }
    .btn {
      margin: 50px 0 0;
      font-size: 20px;
    }
  </style>

  <body>
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
      <div class="container topnav">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <img width="230" class="img-responsive center-block" src="images/reinvizion (1).png"  alt="Reinvizion" title="Reinvizion"> 
        </div>
      </div>
    </nav>
    <div class="content-section-a a-1">
      <a href="/">
        <div class="back-container">
          <div class="arrow-left"></div>
          <p> back </p>
        </div>
      </a>
      <h1>
        SOMETHING<br>
        AWESOME IS<br>
        COMING SOON
      </h1>
      <h2> BUT WHILE YOU'RE HERE<h2>
      <p>Check out <a href="/#business-academy">Business Academy</a>!</p>

      <button type="button" data-dismiss="modal" class="btn btn-outlined btn-primary"  data-toggle="modal" data-target="#fourthModal">
        ALREADY A MEMBER?
      </button>
    </div>

  </body>
  @include('includes.modals')
</html>