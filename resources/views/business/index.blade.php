@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/business.css">
</head>
<div class="col-lg-12 main-body business-page">
	<div class="sidebar-search">
		<a href="#"> ADVANCED SEARCH </a>
		<label> PLEASE ENTER BELOW: </label>
		<form id="business_search" method="get" url="/business/search">
			{{ csrf_field() }}
			<div class="form-group">
				<label> BUSINESS SERVICE </label>
				<input placeholder="enter keywords" id='keyword' />
			</div>			
			<div class="form-group">
				<label> STATE </label>
				<input placeholder="State" id="state" />
			</div>
			<div class="form-group">
				<label> CITY </label>
				<input placeholder="City" id="city" />
			</div>
			<div class="form-group">
				<button> SEARCH </button>
			</div>
		</form>
	</div>
	<div class="data-listing">
		<div class="row row-profile-header text-center">
	    <div class="col-lg-12">
	      <h1 class="sub-header text-center" id="user_name"> BROWSE BUSINESS </h1>
	      <ul id="businessListing">
	      	<?php foreach($businesses as $business) { ?>
	      		<li class="business-item">
	      			<div class="user-image">
                <a href="/users/<?php echo $business->user()->first()->id; ?>">
                  <!-- <img src="< ?php echo $business->image; ?>" /> -->
                  <div class='img' style="background-image:url('<?php echo $business->image; ?>');"></div>
                </a>
              </div>
              <div class="user-info">
              	<p>
                	<span> <?php echo $business->name; ?> </span>
                	<span> <?php echo $business->industry; ?> </span>
              	</p>
              </div>
              <div>
              	<?php
              		if ($business->isUserCustomer($current_user->id)) {
              			$connected_class = "connected";
              		} else {
              			$connected_class = "connect";
              		}
              	?>
                <button class="<?php echo $connected_class; ?>" onclick="business_connect(this)" data-user-id="<?php echo $current_user->id; ?>" data-business-id="<?php echo $business->id; ?>" >
                	<?php echo strtoupper($connected_class); ?> 
                </button>
              </div>
	      		</li>
	      	<?php } ?>
	      </ul>
	      <button id="browse_more_business" style="<?php if ($businesses->count() < 12) { echo "display: none;"; } ?>"> VIEW MORE </button>
	    </div>
	  </div>
	</div>
</div>
<div class="footer-background"> </div>
<script src="/js/users-profile.js"></script>
<script>
	$(document).ready(function() {
		$("#business_search").submit(function(e){
			e.preventDefault();
			data = {
				'keyword': $("#business_search #keyword").val(),
				'state': $("#business_search #state").val(),
				'city': $("#business_search #city").val()
			}

			$.ajax({
				'url': "/business/search",
				'method': $(this).attr('method'),
				'url': $(this).attr('url'),
				'type': 'json',
				'data': data,
				success: function(data) {
					console.log('search success');
					console.log(data);
					
					$("#businessListing").empty();

					if (data.businesses.length > 0) {
						data.businesses.forEach(function(business){
							var connect_class = "connect";

							if (business.is_connected) {
								connect_class = "connected";
							}

							// console.log(business);
							$("#businessListing").append(
								'<li class="business-item">'+
			      			'<div class="user-image">'+
		                '<a href="/users/'+business.user_id+'">'+
		                  '<div class="img" style="background-image: url('+business.image+')"></div>'+
		                '</a>'+
		              '</div>'+
		              '<div class="user-info">'+
		              	'<p>'+
		                	'<span> '+business.name+' </span>'+
		                	'<span> '+business.industry+' </span>'+
		              	'</p>'+
		              '</div>'+
		              '<div>'+
		                '<button class="'+connect_class+'" onclick="business_connect(this)" data-user-id="'+data.current_user_id+'" data-business-id="'+business.id+'"> '+connect_class.toUpperCase()+' </button>'+
		              '</div>'+
			      		'</li>'
		      		);
						});
					} else {
						$("#businessListing").append('<li class="business-item" style="font-size: 20px; font-family: AauxLightItalic !important;"> No Results Found </li>');
					}

					if (data.businesses.length < 12) {
						$("#browse_more_business").hide();
					}

					console.log($(".business-page .sidebar-search").height());
					console.log($(".business-page .data-listing").height());

					if ($(".business-page .sidebar-search").height() > $(".business-page .data-listing").height()) {
						$(".data-listing").height($(window).height());
					} else {
						console.log("do not append footer");
						$(".main-body.business-page").height($(".business-page .data-listing").height());
					}
					
				},
				error: function(data) {
					console.log('search server error');
					console.log(data)
				}
			})
		});
	});

	function business_connect(src) {
		var button = $(src);

		if ( $(button).hasClass('connect') ) {
			$(button).attr('disabled', true);

			var data = {
				'user_id': button.data("user-id"),
				'business_id': button.data("business-id")
			};

			$.ajax({
				'url': '/business/addCustomer',
				'method': 'post',
				'type': 'json',
				'data': data,
				success: function(data) {
					console.log(data);

					if (data.customer != null) {
						$(button).removeClass("connect");
						$(button).addClass("connected");
						$(button).text("CONNECTED");
					}
				},
				error: function(data) {
					console.log('Error creating customer. ')
					$(button).attr('disabled', false);
				}
			});
		}
	}
</script>
@stop