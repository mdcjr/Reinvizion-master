@extends('emails.maintemplate')
@section('content')
<div style="float:left; width:100%; margin:50px 0; text-align:center;">
  <h1 style="font-size:36px; margin: 0;">
    <strong style="color: #f6087d; font-size: 35px; font-weight: 500;">THANK YOU.</strong>
  </h1>
  <h1 style="margin: 0;">
    <strong style="color: #f6087d; font-size: 30px; font-weight: 500;">YOUR PAYMENT IS RECEIVED</strong><br/>
    <strong style="color: #f6087d; font-size: 24px; font-weight: 500;">(You will not be bill until the trail is over)</strong>
  </h1>
  <button action="www.reinvizion.com"style="background:#1a1a1a; padding: 7px 32px; color:#fff; margin:20px 0 0; font-size: 18px; cursor:pointer;">
  	<a style="color:#fff; text-decoration: none;" href="{{ URL::to('/')}}">CONTINUE LEARNING</a></button>
  <p style="color:#171717; font-size:17px;">If this wasn't you, please contact (<a style="color:#171717;">support@reinvizion.com</a>).</p>
</div>
@stop
