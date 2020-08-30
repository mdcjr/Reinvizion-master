@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/user-business-reviews.css">
  <link rel="stylesheet" type="text/css" href="/css/jquery.rateyo.css">
  <script src="/js/jquery.rateyo.js"></script>
  <style> 
    .rateyo {
      max-width: 110px; 
      margin: 8px 0; 
      float:left;
      padding: 0;
    }

    #pagination {
      overflow: auto;
    }

    #pagination > a {
      font-size: 20px;
      cursor: pointer;
      text-decoration: none;
    }

    #pagination > span {
      display: inline-block;
      margin: auto;
      color: #337ab7;
    }

    @media (max-width:767px) {
      .rateyo {
        float: none;
        margin: auto;
        margin-top: 15px;
      }

      #pagination > a { padding: 0 20px; }
    }
  </style>
</head>
<div class="col-lg-12 main-body ">
  <div class="row row-profile-header text-center">
    <div class="col-lg-9">
      <h1 class="sub-header text-center" style="font-family: AauxRegular !important;"> 
        <?php if (!isset($business)) { 
          echo 'YOUR'; 
        } else {
          echo strtoupper($business->name);
        } ?> REVIEWS 
      </h1>
      <ul id='business-reviews'>
        <?php $rating_message = ['', 'POOR', 'GOOD', 'VERY GOOD', 'GREAT', 'EXCELLENT'] ?>
      	<?php foreach($business_reviews as $review) { ?>
      		<li>
      			<div>
      				<div style="clear: both; overflow: auto;">
                <?php
                  $img_src = "/images/facebook-avatar.png";

                  if (isset($business) && $review->reviewer()->image != "") {
                    $img_src = $review->reviewer()->image;
                  } else if (!isset($business) && $review->business()->user()->first()->image != "") {
                    $img_src = $review->business()->user()->first()->image;
                  }
                ?>    					
      					<!-- <img class="reviewer" style="background-image:url('< ?php echo $img_src; ?>')" />	      					 -->
                <div class="reviewer-img" data-business-set="<?php echo isset($business); ?>" style="background-image:url('<?php echo $img_src; ?>')"></div>
      					<div class="info">
                  <?php
                    $review_created = date_create($review->created_at);
                    $review_date_str = date_format($review_created, 'F j, Y')
                  ?>
      						<p>
                    <?php if (!isset($business)) {
                      echo 'for '.$review->business()->name;
                    } else {
                      echo 'by '.$review->reviewer()->name;
                    } ?> on <?php echo $review_date_str; ?> 
                  </p>
      						<div class="rating-title">
      							<!-- <img src='/images/star-rating.png' /> -->
                    <div class='rateyo user-review' data-review-rating="<?php echo number_format($review->rating, 1); ?>"></div>
      							<p> <?php echo $rating_message[(int)$review->rating] ?> CUSTOMER SERVICE </p>
      						</div>
      					</div>
      				</div>	
      			</div>    		
      			<div class="message"> 
      				<p> 
      					<?php echo $review->message; ?>
      				</p>
      			</div>
      		</li>
      	<?php } ?>
      </ul>
      <div id="pagination" style="overflow: auto; margin-bottom: 20px;">
        <?php if ($pagination['previous_url'] != "") { ?>
          <a href="<?php echo $pagination['previous_url']; ?>" style="float:left;"><--</a>
        <?php } ?>
        <span> 
          <?php echo $pagination['current_page'].'/'.$pagination['total_page']; ?>
        </span>
        <?php if ($pagination['next_url'] != "") { ?>
          <a href="<?php echo $pagination['next_url']; ?>" style="float:right;">--></a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<div class="footer-background"></div>
<script src="/js/users-profile.js"></script>
<script>
  $(document).ready(function() {
    $('.rateyo').each(function(index) {
      $(this).rateYo({
        rating: parseFloat($(this).attr('data-review-rating')),
        normalFill: "#d3d3d3",
        ratedFill: "#F6087D",
        starWidth: "22px",
        readOnly: true
      });
    });   
  });
</script>
@stop