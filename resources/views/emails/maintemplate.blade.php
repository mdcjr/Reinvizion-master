<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8">
    <style>
      .header {
        
      }
    </style>
  </head>
  <body>
    <div style="width:1000px;display:block;margin:0 auto;">
      <header style="background:#000; padding: 20px 0; float:left; width:100%;">
        <img width="230" style="margin-right: auto;margin-left: auto; display:block;" src="http://54.245.60.112/images/reinziion-logo-white.png" alt="Reinvizion" title="Reinvizion">
      </header>
      <div style="background-image:url(http://54.245.60.112/images/learning-hub.jpeg); background-size: cover; background-repeat: no-repeat; border: none;
        padding: 0; width:100%; float:left; height: 350px;">
        <div style=" background: rgba(0,0,0,0.5); padding: 175px 0;">
        </div>
      </div>
      @yield('content')
      <footer style="background:#000; padding: 60px 0; float:left; width:100%;">
      </footer>
    </div>
  </body>
</html>