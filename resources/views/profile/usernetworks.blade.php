@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/user-network.css">
  <script src="/js/users-profile.js"></script>
</head>
<div class="col-sm-3 col-md-2 sidebar" style="overflow: hidden;padding:0;">
  <div class="sidebar-header">
    <div class="sidebar-container text-center">
      <div class="row-header">
        <h1 class="sub-header text-center"><?php echo $user->name; ?></h2>
        <p class="text-center"><?php echo $user->occupation; ?></p>
        <img data-toggle="modal" data-target="#upload-image" class="user-img" style="background-image:url(<?php echo $user->image; ?>);"></img>
        <p class="text-center profile-position">
          <?php if($user->user_type == "consultant"): ?>
            <span style="color:#a10081;">★</span> 
          <?php endif; ?>
          <?php echo $user->user_type; ?> 
        </p>
      </div>
    </div>
  </div>
</div>
<div class="col-lg-10 main-body">
  <div class="row row-network text-center">
    <h1 class="text-center"> YOUR NETWORK (<?php echo count($connected_users); ?>)</h1>
    <div class="img-container">
      <?php foreach ($connected_users as $con): ?>
        <?php 
          if($con->user_a->id == $user->id)
            $conUser = $con->user_b;
          else
            $conUser = $con->user_a;
        ?>
        <div class="img">
          <img style="background-image:url(<?php echo $conUser->image; ?>)"></img>
          <h1 class="text-center"> 
            <?php echo $conUser->name; ?> 
            <br>
            <span> 
              <?php echo $conUser->user_type; ?> 
            </span>
          </h1>
          <?php if($conUser->id != $current_user->id):?>
            <?php
              $is_found = $conUser->isConnected($conUser->id, $current_user->id);
              if($is_found):
            ?>
              <button type="button" class="btn btn-outlined btn-primary">
                CONNECTED
              </button>
            <?php else: ?>
              <button type="button" class="btn btn-outlined btn-primary not">
                NOT CONNECTED
              </button>
            <?php endif; ?>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div class="footer-background"></div>
@stop