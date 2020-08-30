@extends('emails.maintemplate')
@section('content')
<div style="float:left; width:100%; margin:50px 0; text-align:center;">
  <h1 style="font-size:36px; margin: 0;">
    <strong style="color: #f6087d; font-size: 50px; font-weight: 500;">OOPS!</strong>
  </h1>
  <h1 style="margin: 0;">
    <strong style="color: #f6087d; font-size: 27px; font-weight: 500;">LOOKS LIKE YOUR PAYMENT DIDN'T GO THROUGH</strong>
  </h1>
  <p style="color:#171717; font-size:19px;">
    but that's okay, we can help. Please log in to your Business Academy<br>
    account to update your subcsription settings. If any problems persist,<br>
    please contact (<a style="color:#171717;">support@reinvizion.com</a>).
  </p>
  <button style="background:#1a1a1a; padding: 7px 32px; color:#fff; margin:10px 0 0; font-size: 18px; cursor:pointer;">SUBSCRIPTION SETTINGS</button>
</div>
@stop
