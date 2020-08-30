<!-- <!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <style>
            .header{

            }
            .footer{

            }
        </style>
    </head>
    <body>
        <header>
            <h1>REINVIZION</h1>
        </header>
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2 id="title">Welcome To Your Business Academy</h2>
                <button><a href="{{ URL::to('register/verify/' . $confirmation_code) }}">CONFIRM EMAIL</a></button>
                <p>Reinvizion’s Business Academy is an online training platform designed to stay current with today's market. Our program contains the formula that is helping aspiring entrepreneurs become successful.
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <p>Reinvizion’s Business Academy is an online training platform designed to stay current with today's market. Our program contains the formula that is helping aspiring entrepreneurs become successful.
                </p>
            </div>
            <div class="col-md-6">
                <p>ELEVATING YOUR TRANSITION IN LIFE</p>
                <h2>BUSINESS ACADEMY</h2>
                <p>Reinvizion’s Business Academy is an online training platform designed to stay current with today's market. Our program contains the formula that is helping aspiring entrepreneurs become successful.
                </p>
            </div>
        </div>
        <footer>
        </footer>
    </body>
</html> -->
@extends('emails.maintemplate')
@section('content')
<div style="float:left; width:100%; margin:50px 0; text-align:center;">
  <h1 style="font-size:36px; margin: 0;">
    <strong style="color: #f6087d; font-size: 45px; font-weight: 500;">WELCOME TO <br>REINVIZION</strong>
  </h1>
  <button style="background:#1a1a1a; padding: 7px 32px; color:#fff; margin:20px 0 0; font-size: 18px; cursor:pointer;">
    <a style="color:#fff; text-decoration: none;" href="{{ URL::to('register/verify/' . $confirmation_code) }}">CONFIRM EMAIL</a>
  </button>
  <p style="color:#171717; font-size:19px; margin: 30px 0 0;">
    Reinvizion’s is an online platform designed to stay<br> 
    current with today's market. Our program contains the formula that is helping<br> 
    aspiring entrepreneurs become successful.
  </p>
</div>
<div style="background-image:url(http://54.245.60.112/images/business-academy.jpeg); background-size: 50% 100%; background-repeat: no-repeat; float:left; width:100%;">
  <div style="float:right; width:47%; margin: 30px 0;">
    <h1 style="margin-top:0px;">
      <small><strong style="color: #1a1a1a; font-weight: 700; font-size: 14px;">ELEVATING YOUR TRANSITION IN LIFE</strong></small><br>
      <strong style="color: #f6087d; font-size: 35px; font-weight: 500;">BUSINESS ACADEMY</strong>  
    </h1> 
    <h4 style="color:#171717; font-size:15px; margin:0; font-weight:500;">
      Reinvizion's Business Academy is an online training<br>
      platform designed to stay current with today's market.<br>
      Our program contains the formula that is helping<br>
      apsiring entrepreneurs become successful.
    </h4>
  </div>
</div>
@stop
