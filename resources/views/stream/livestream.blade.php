@extends('layouts.usersidebarlayout')
@section('content')
	  <?php 
    $API_KEY = env("YOUTUBE_API_KEY");
    $ChannelID = env("YOUTUBE_CHANNEL_ID");

    $channelInfo = 'https://www.googleapis.com/youtube/v3/search?part=snippet&channelId='.$ChannelID.'&type=video&eventType=live&key='.$API_KEY;

    $extractInfo = file_get_contents($channelInfo);
    $extractInfo = str_replace('},]',"}]",$extractInfo);
    $showInfo = json_decode($extractInfo, true);

    if($showInfo['pageInfo']['totalResults'] === 1){
      echo '	<div class"stream-container" style="margin-top: 100px; text-align:center; background-color: #000000; color:#FFFFFF;">
          			<h2>Live Stream!</h2>
          			<iframe width="800" height="600" src="https://www.youtube.com/embed/live_stream?channel=UCP8W8u1-ry5JNMoTVFbQtdw&autoplay=1" frameborder="0" allowfullscreen> style="padding: 25px;"</iframe>
        			</div>';    
    }else{
    	echo '	<div class="stream-container" style="margin-top: 100px; text-align:center; background-color: #000000; color:#FFFFFF;>
  							<h2>Live stream is currently offline. Please come back when stream is online.</h2>
  						</div>';
    }
  ?>

@stop