@extends('layouts.usersidebarlayout')
@section('content')
<head>
  <link rel="shortcut icon" href="{{{ asset('images/fav-reinvizion.png') }}}">
  <link rel="stylesheet" type="text/css" href="/css/user-profile.css">
  <link rel="stylesheet" type="text/css" href="/css/user-messages.css">
  <script src="/js/users-profile.js"></script>
  <script src="/js/users-messages.js"></script>
</head>
<div class="messages-main text-center">
  <div class="col-sm-3 col-md-2 inbox text-center" style="overflow: hidden;">
    <h1>CONVERSATIONS</h1>
    
    <?php $k = 0; foreach($conv_users as $conv):?>
      <?php 
        $user = $conv['user'];
      ?>
      <hr>
      <?php 
        $active_class = "";
        if( ($k == 0 && $existing_conversation == null) || ($existing_conversation != null && ($existing_conversation->user_id_a == $user->id || $existing_conversation->user_id_b == $user->id)) ) { 
          $active_class = ' active'; 
        }
      ?>
      <div class="user<?php echo $active_class ?>" row="<?php echo 'user-' .$k; ?>">
        <div class="image" style="background-image:url(<?php echo $user->image; ?>);"></div>
        <p>
          <?php 
            $name = $user->name;
            $truncated = (strlen($name) > 15) ? substr($name, 0, 15) . '...' : $name;
            echo $truncated; 
          ?>
        </p>
        <?php if($conv['count'] > 0): ?>
          <div class="count"><?php echo $conv['count'];?></div>
        <?php endif; ?>
      </div>
    <?php $k++; endforeach; ?>

    <p id="find-users" data-dismiss="modal" data-toggle="modal" data-target="#classmatesModal" class="start-convo"> + START A CONVERSATION</p>
  </div>
  <div class="col-sm-9 col-md-10 message-body">
    <h1> YOUR CONVERSATION STARTS HERE </h1>
    <div class="conversation">
      <?php $curDate = null ?>
      <?php $k=0; foreach($conv_messages as $convo):?>
        <?php
          $active_class = "";
          if( ($k == 0 && $existing_conversation == null) || ($existing_conversation != null && $convo['convId'] == $existing_conversation->id) ) { 
            $active_class = ' active'; 
          }
        ?>
        <div class="current_conv <?php echo $active_class ?> <?php echo 'user-' .$k; ?>" convId="<?php echo $convo['convId']?>">
          <div class='messages'>
            <?php foreach($convo['messages'] as $message): ?>
              <?php
                $today = new DateTime();
                $today = $today->format('Y-m-d');
                $date= new DateTime('' .$message->created_at);
                $strip = $date->format('Y-m-d');

                if(!isset($curDate)) {
                  $curDate = $strip;
                  echo '<p class="date"><span>' .$date->format('M j') .'</span></p>';
                } 
                elseif($curDate < $strip) {
                  $curDate = $strip;
                  if($curDate == $today)
                    echo '<p class="date"><span>TODAY</span></p>';
                  else
                    echo '<p class="date"><span>' .$date->format('M j') .'</span></p>';
                }
              ?>
              <div class="message">
                <?php if($message->sender->id != $current_user->id):?>
                  <div class="col-lg-1">
                    <div class="image" style="background-image:url(<?php echo $message->sender->image; ?>);"></div>
                    <p class="username"><?php echo $message->sender->name; ?></p>
                  </div>
                  <div class="col-lg-10 body text-left">
                    <p><?php echo $message->body;?></p>
                  </div>
                  <div class="col-lg-1 time">
                    <?php
                      $date= strtotime('' .$message->created_at);
                      echo '<p>' .date('G:i A', $date) .'</p>';
                    ?>
                  </div>
                <?php else: ?>
                  <div class="col-lg-1 time">
                    <?php
                      $date= strtotime('' .$message->created_at);
                      echo '<p>' .date('G:i A', $date) .'</p>';
                    ?>
                  </div>
                  <div class="col-lg-10 body text-right">
                    <p><?php echo $message->body;?></p>
                  </div>
                  <div class="col-lg-1">
                    <div class="image" style="background-image:url(<?php echo $message->sender->image; ?>);"></div>
                    <p class="username"><?php echo $message->sender->name; ?></p>
                  </div>
                <?php endif; ?>
              </div>
            <?php endforeach; ?>
          </div>
          <div class='reply-box'>
            <textarea class="discus-thread add-comment <?php echo 'rec-com-' . $convo['send_id'];?>" placeholder="your conversation continues here..."></textarea>
            <button type="button" id="message-save" class="reply-save-button" receiver="<?php echo $convo['send_id']; ?>">SUBMIT</button>
          </div>
        </div>
      <?php $k++; endforeach; ?>
    </div>
  </div>
</div>
<div class="modal fade classmates-popup" data-keyboard="false" data-backdrop="static" id="classmatesModal" tabindex="-1" role="dialog" aria-labelledby="classmatesModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
      <div class="modal-header">

        <h1 class="sub-header text-center">USERS FOUND</h1>

        <div class="connection-container">
        </div>

        <p class="text-center">
          <button type="button" data-dismiss="modal" aria-label="Close" id="submit">DONE</button> 
        </p>
      </div>
    </div>
  </div>
</div>
<style>
.modal-backdrop {
  background-color: #f50c79;
}
</style>
<script>
  $(document).ready(function(){
    var header_height = $('.navbar-fixed-top').height();
    var window_height = $(window).height();
    var height = window_height - header_height;
    
    $('.messages-main').css('height', height);
    $('.message-body').scrollTop($('.message-body').height());
  });
</script>
@stop