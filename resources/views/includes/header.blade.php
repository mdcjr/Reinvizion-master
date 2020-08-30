<!-- NAVBAR
================================================== -->
<div class="navbar-wrapper">
  <div class="container">

	<nav class="navbar navbar-inverse navbar-fixed-top">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		  </button>
		  <a class="navbar-brand" href="/">{{ config('app.name', 'Reinvizion') }}</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
		  <ul class="nav navbar-nav">
			<li class="active"><a href="/">Home</a></li>
			<?php
				use Illuminate\Support\Facades\Auth;
				if(!Auth::check()){
					echo '<li><a href="/register">Register</a></li>'; 
				}
			?>
			
			
			<?php 
				
				if(Auth::check()) //if user is authenticated
				{
					echo '<li><a href="/logout">Log out</a></li>';
					echo '<li><a href="/profile">My Account</a></li>';  
				}
				else
				{
					echo '<li><a href="/login">Log in</a></li>'; 
				}
			
			?>
		  </ul>
		</div>
	  </div>
	</nav>

  </div>
</div>