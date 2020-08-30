
<!DOCTYPE html>
<html lang="en">
@include('includes.head')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="css/landing-page-001.css">
  <script src="/js/landing-page.js"></script>
  <style>
    .business-academy1 {
      max-width: 480px;
      width: 100%;
    }

    .alt-learning2 {
      max-width: 450px;
      width: 100%;
    }

    #thirdModal { padding-left: 0 !important; }

    #thirdModal .modal-dialog {
      max-width: 800px;
      padding: 0 20px;
      width: 100%;
    }

    #thirdModal button.close {
      position: absolute;
      top: 0;
      right: 0;
      z-index: 1;
    }

    .register-popup ul > li.mobile {
      display: none;
    }

    @media (max-width:1199px) {
      .register-popup .modal-header li.form-container { width: 40%; }
      .register-popup .modal-header li.background-container { width: 60%; }
    }

    @media (max-width:768px) {
      #thirdModal { overflow-y: scroll; }
      #thirdModal::-webkit-scrollbar { width: 0; }

      #thirdModal .modal-content { padding: 0; }

      #thirdModal .modal-header > ul {
        display: block;
      }

      #thirdModal .modal-header > ul > li.mobile {
        display: block;
        overflow-y: auto;
        padding-bottom: 30px;
      }

      #thirdModal ul > li.mobile > h1.main-title { font-size: 25px; }
      #thirdModal ul > li.mobile > h1.main-title:first-child { margin-top: 30px; }

      #thirdModal ul > li.mobile > p.main-title { float: none; }
      #thirdModal ul > li.mobile > a { margin: 0 !important; }

      .register-popup .background-container button.btn-primary {
        float: none;
        margin: 20px auto 0 !important;
        display: block;
      }

      .register-popup ul li {
        width: 100% !important;
      }

      /*.register-popup ul li > form > label { display: none; }*/
    }
  </style>
</head>

<body style="padding:0;">

  <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-left">
          <li>
            <img width="230" class="img-responsive center-block" src="/images/reinziion-logo-white.png"  alt="Reinvizion" title="Reinvizion">     
          </li>
        </ul> 
        <ul class="nav navbar-nav navbar-right">
          <li>
            <?php 
              if(Auth::check()) //if user is authenticated
              {
                echo '<a class="header-a" href="/profile">
                    <button type="button" data-dismiss="modal" class="btn btn-outlined btn-primary" data-toggle="modal" style="margin: 0 0 0 20px;">
                      MY ACCOUNT 
                    </button>
                  </a>';
                echo '<a class="header-a" href="/logout">
                    <button type="button" data-dismiss="modal" class="btn btn-outlined btn-primary" data-toggle="modal" style="margin: 0 0 0 20px;">
                      LOG OUT 
                    </button>
                  </a>';
              }
              else
              {
                echo '<button id="member-button" type="button" data-dismiss="modal" class="btn btn-outlined btn-primary"  data-toggle="modal" data-target="#fourthModal">
                    ALREADY A MEMBER?
                  </button>';
              }
            ?>      
          </li>
        </ul> 
      </div>
    </div>
  </nav>

  <?php 
    $API_KEY = env("YOUTUBE_API_KEY");
    $ChannelID = env("YOUTUBE_CHANNEL_ID");

    $channelInfo = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='.$ChannelID.'&type=video&eventType=live&key='.$API_KEY;

    $extractInfo = file_get_contents($channelInfo);
    $extractInfo = str_replace('},]',"}]",$extractInfo);
    $showInfo = json_decode($extractInfo, true);

    if($showInfo['pageInfo']['totalResults'] === 1){
      echo '<div class"stream-banner" style="margin-top: 100px; text-align:center; background-color: #000000; color:#FFFFFF;">
          <h2>Live Stream!</h2>
          <iframe width="800" height="600" src="https://www.youtube.com/embed/live_stream?channel=UCP8W8u1-ry5JNMoTVFbQtdw&autoplay=1" frameborder="0" allowfullscreen> style="padding: 25px;"</iframe>
        </div>';    
    }
  ?>


  <div class="intro-header" id="logo" >
    <video playsinline autoplay muted loop id="bgvid">
      <source src="/videos/landing-video.mp4" type="video/mp4">
    </video>
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="intro-message">
            <img width="300" class="img-responsive center-block title-image" src="images/reinvizion (1).png"  alt="Reinvizion" title="Reinvizion"></img>
            <p class="text-center">
              <h5 class="text-center title-text">LEARN, BUILD AND INVEST.</h5>
            </p>
            <br>
            <p class="text-center" style="margin-bottom:30px;color:#000;">
              <span class="network-name" style="font-size:30px; font-weight: 500; color:#333333;"> 
                CHOOSE YOUR JOURNEY
              </span>
            </p>
            <ul class="list-inline intro-social-buttons" style="padding-bottom:15%;"> 
              <li>
                <button type="button" data-dismiss="modal"  class="btn btn-outlined btn-primary" data-toggle="modal" data-target="#myModal">
                  <span class="network-name">
                    BUSINESS HUB
                  </span>
                </button>
              </li>
              <li>
                <button type="button" data-dismiss="modal"  class="btn btn-outlined btn-primary second" data-toggle="modal" data-target="#businessAcademyModal">
                  <span class="network-name">BUSINESS ACADEMY</span>
                </button>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div> 
  <!-- /.intro-header -->

  <!-- Page Content -->


  <!-- <div class="content-section-a a-1">

      <div class="container">
          <div class="row">
              <div class="col-lg-4"> </div>
              
             
                  <div class="clearfix"></div>
              
              <h2 class="section-heading text-center">
                  <span style="font-style: italic;">"The great aim of education is not knowledge <br>but action."</span> -Herbert Spencer
              </h2>
              
          <h2>  
              <p class="text-center" style="font-weight: 200;font-size: 25px;word-spacing: 4px;">
                 We Reinvizion&copy; a new direction towards building businesses <br>through providing innovative education and developing a next <br>generation
                  platform for businesses,while  helping profes-<br>sionals secure financial freedom.
              
              </p>
          </h2>
              
          
          </div>
          
       </div>
  </div> -->

  
  <!-- /.content-section-b -->
  
  <!-- <div class="content-section-b principals">
    <div class="container">
      <div class="row">
        <div class="col-lg-4"> </div>
        <div class="clearfix"></div>
        
        <h2 class="section-heading text-center">
          REINVIZION'S CORE PRINCIPALS
        </h2>
      </div>
      <div class="row">
        <div class="col-lg-4 text-center"> 
          <h1>
            <strong class="strong-title">LEARN</strong>  
          </h1> 
          <h4>
            We have developed an online data-<br>
            base of courses that will not only<br>
            instill sound principles of business,<br>
            but give you the foundation to excel<br>
            as a business professional.
          </h4>
        </div>
        <div class="col-lg-4 text-center"> 
          <h1>
            <strong class="strong-title">BUILD</strong>  
          </h1> 
          <h4>
            We aim be apart of your transition in<br>
            life; helping you develop your incredi-<br>
            ble idea into an actual business!
          </h4>
        </div>
        <div class="col-lg-4 text-center"> 
          <h1>
            <strong class="strong-title">INVEST</strong>  
          </h1> 
          <h4>
            Our Accelerator Program grants<br>
            funding to strong leaders with great<br>
            ideas that have completed our pro-<br>
            gram!
          </h4>
        </div>
      </div>
    </div>
  </div> -->

  <div class="content-section-a" id="business-academy">
    <div class="mask">
      <div class="container ">
        <div class="row">
          <div class="col-sm-6 business-academy1">
            <h1 style="margin-top:0px;">
              <small><strong>ELEVATING YOUR TRANSITION IN LIFE</strong></small><br>
              <strong class="strong-title">BUSINESS HUB</strong>  
            </h1> 
            <h4>
              Our social media platform provides small businesses with a global mindset, a presence to share their services with the world.
            </h4>
            <button type="button" data-dismiss="modal"  class="btn btn-outlined btn-primary button" data-toggle="modal" data-target="#myModal">
              <span class="network-name">BUSINESS HUB</span>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>

 <div class="content-section-b" id="learning-hub">
    <div class="mask">
      <div class="container">
        <div class="row">
          <div class="col-sm-6 alt-learning2">
            <h1 style="margin-top:0px;">
              <small><strong>ELEVATING YOUR TRANSITION IN LIFE</strong></small><br>
              <strong class="strong-title">BUSINESS ACADEMY</strong>
            </h1> 
            <h4>
              Reinvizion’s Business Academy is an online training platform for entrepreneurs, designed to give a strong foundation for business development from actual business practitioners.
            </h4>
            <button type="button" data-dismiss="modal"  class="btn btn-outlined btn-primary button" data-toggle="modal" data-target="#businessAcademyModal">
              <span class="network-name">BUSINESS ACADEMY</span>
            </button> 
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('includes.footer')

  @include('includes.modals')
  
  <script>
    $(document).ready(function() {
      $('.navbar-header > button.navbar-toggle').on('click', function(e) {
        e.preventDefault();

        var target_id = $(this).attr('data-target')

        $(target_id).slideToggle(600);
      });
    });
  </script>
</body>

</html>
