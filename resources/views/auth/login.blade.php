<style>
  .login {
    margin: 60px 0;
  }
  .login .form-group {
    margin-left: 35px!important;
    margin-right: 50px!important;
  }
  .login label{
    text-align: left!important;
    font-weight: 700;
    padding: 0!important;
  }
  .login label h1{
    font-size: 20px;
  }
  .login .button {
    border: 1px solid #000;
    color: #000;
    background: none;
    font-weight: 200;
    margin-top: 20px;
    padding: 10px 30px;
  }
  .login .button.enabled {
    color: #fff;
    background: #f6087d;
    border-color:#fff;
  }
  .login .title {
    font-weight: 700;
    color: #f6087d;
  }
  .login a.forgot {
    color: inherit;
    margin-left: 35px;
    text-decoration: underline;
    cursor: pointer;
  }
  .login a:hover{
    text-decoration: none;
  }
  .login .button.enabled.fb {
    background-color: #4267b2;
    border-color: #4267b2;
    padding: 10px 20px;
  }
  .login .button.enabled.gg {
    padding: 10px 20px;
    border: 1px solid #3079ed;
    color: #fff;
    text-shadow: 0 1px rgba(0,0,0,0.1);
    background-color: #4d90fe;
    background-image: -webkit-linear-gradient(top,#4d90fe,#4787ed);
    background-image: -moz-linear-gradient(top,#4d90fe,#4787ed);
    background-image: -ms-linear-gradient(top,#4d90fe,#4787ed);
    background-image: -o-linear-gradient(top,#4d90fe,#4787ed);
    background-image: linear-gradient(top,#4d90fe,#4787ed);
  }

</style>

<form class="form-horizontal login" role="form" method="post" action="{{ url('login') }}">
    {{ csrf_field() }}

    <div class="form-group" style="margin-bottom:0px;">
      <h1 class="modal-title title" id="d2">LOGIN</h1>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">
          <h1>EMAIL</h1>
        </label>

        <!-- <div class="col-md-6"> -->
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="help-block" >
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        <!-- </div> -->
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <!-- <label for="password" class="col-md-4 control-label">Password</label> -->
        <label for="email" class="col-md-4 control-label">
          <h1>PASSWORD</h1>
        </label>

        <!-- <div class="col-md-6"> -->
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        <!-- </div> -->
    </div>
    <a data-target="#forgotPasswordModal" data-toggle="modal" href="#forgotPasswordModal" data-dismiss="modal">FORGOT PASSWORD?</a>
    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-primary button login-submit">
        SUBMIT
      </button>
      <a href="/auth/facebook" style="margin-left:15px;">
        <div class="btn btn-primary button enabled fb">
          FACEBOOK
        </div>
      </a>
      <!-- <a href="/auth/google" style="margin-left:15px;">
        <div class="btn btn-primary button enabled gg">
          G+
        </div>
      </a> -->
    </div>

    <!--<div class="form-group"> 
        <div class="col-md-6 col-md-offset-4">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember"> Remember Me
                </label>
            </div>
        </div>
    </div> -->

    <!-- <div class="form-group">
        <div class="col-md-8 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Login
            </button>

            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                Forgot Your Password?
            </a>
        </div>
    </div> -->
</form>
