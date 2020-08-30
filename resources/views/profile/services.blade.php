@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/user-services.css">
  <script src="/js/users-profile.js"></script>
</head>
<div class="text-center services">
	@if ($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
	@endif
	<div class="row row-header text-center">
  	<div class="col-lg-12">
  		<h1> BUSINESS SERVICES </h1>
  	</div>
  </div>
	<section style="background-image: url(/images/puzzles.jpg);">
		<div class="container">
			<h3> BUSINESS ACCELERATOR </h3>
			<p> 
				When you join Reinvizion, you have the ability to qualify for our Business Accelerator Program. Reinvizion will have open registrations twice a year for submission into our Accelerator program. If your company is selected, you will have the opportunity to Pitch Reinvizion for funding.
			</p>
			<button type="button" data-dismiss="modal" data-toggle="modal" data-target="#businessServiceModal"> GET STARTED </button>
		</div>
	</section>
	<section style="background-image: url(/images/t-shirts.jpg);">
		<div class="container">
			<h3> APPAREL DESIGN </h3>
			<p>
				Custom apparel will give you an edge in turning people into walking billboards for your company or group. We specialize in t-shirt designs for groups, teams, and businesses. Get your custom printed t-shirt today by clicking the link below and enter our easy to use online design studio to get started.
			</p>
			<button type="button" id="apparelButton" onclick=" window.open('https://reinvizion.secure-decoration.com','_blank')" > GET STARTED </button>
		</div>
	</section>
	<section style="background-image: url(/images/web-design.jpg);">
		<div class="container">
			<h3> WEB DESIGN </h3>
			<p>
				If you need a team of qualified developers to build a responsive website for your business, we have you covered! We specialize in the following.
			</p>
			<ul class="dash">
				<li>
					<span> - </span> Full Functional Website
				</li>
				<li>
					<span> - </span> Responsive design for desktop, mobile, and tablet devices
				</li>
				<li> 
					<span> - </span> E-Commerce integration
				</li>
				<li>
					<span> - </span> Integration of PayPal
				</li>
				<li>
					<span> - </span> Monthly plans for content management and updates
				</li>
			</ul>
			<button type="button" data-dismiss="modal" data-toggle="modal" data-target="#webServiceModal">
				GET STARTED 
			</button>
		</div>
	</section>
	<section style="background-image: url(/images/soc-media.jpg);">
		<div class="container">
			<h3> SOCIAL MEDIA MARKETING </h3>
			<p>
				Do you need a team that is dedicated to handling your social media account? Let us management the online social aspects of your business, while you focus on creating a great product for your customers and clients.
			</p>
			<ul>
				<li>
					Management of Facebook, LinkedIn, Twitter, Instagram, Pinterest etc.
				</li>
				<li>
					Interacting, replying comments and follow up.
				</li>
				<li>
					Grow and increase your Facebook fan page likes and Twitter followers
				</li>
				<li>
					Use of top #hashtags and mentions to propagate your message and rank in social searches, feeds, search engine listings.
				</li>
				<li>
						Post Scheduling on your profiles
				</li>
				<li>
						Providing SCL Media Plans for your accounts
				</li>
				<li>
						WordPress management and fixing
				</li>
				<li>
						Content writing, posting and editing
				</li>
				<li>
					Facebook marketing, comments, updates, fan page, likes and posting
				</li>
			</ul>
			<button type="button" data-dismiss="modal" data-toggle="modal" data-target="#socialServiceModal">
				GET STARTED 
			</button>
		</div>
	</section>
  </div>
</div>
<div class="footer-background"></div>
<?php if ($current_user->has_visited_business_services == 0) { ?>
	<?php 
		$current_user->has_visited_business_services = true; 
		$current_user->save(); 
	?>
	<div class="footer-background services" style="background: #232323;"></div>
	<button id="welcome-popup-button" type="button" data-dismiss="modal"  class="edit-button" data-toggle="modal" data-target="#welcome-popup" style="display:none;"></button>
  <div class="modal fade welcome-popup upload-image services" data-keyboard="false" data-backdrop="static" id="welcome-popup" tabindex="-1" role="dialog" aria-labelledby="welcome-popup">
    <div class="modal-dialog" role="document" style="position:relative;">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
        <div class="modal-header">

          <h1 class="sub-header text-center">WELCOME TO BUSINESS SERVICES</h1>
          <h2 class="sub-header text-center" style="font-size: 24px;">PLEASE CHECK IN PERIODICALLY FOR UPDATES ON YOUR SERVICES</h2>
          <p class="text-center">
            <button id="submit" type="button" data-dismiss="modal" data-toggle="modal" data-target="#editUserModal" style="font-family: MyriadProRegular !important; font-size: 18px;">DONE</button>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script> 
  	$(document).ready(function() {
  		$('#welcome-popup-button').trigger('click');
  	});

  </script>
<?php } ?>
@stop
@include('includes.modals')
