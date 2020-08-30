<!DOCTYPE html>
<html lang="en">
  <head>
    @include('includes.head')
  </head>

  <body>
   
 
 <header class="container">
      @include('includes.header')
  </header>

	<div id="main" class="container">
       @yield('content')
  </div>

  <footer class="container">
      @include('includes.footer')
  </footer>
 
 </body>
</html>