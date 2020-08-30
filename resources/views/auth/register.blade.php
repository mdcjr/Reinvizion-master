
<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}" accept-charset="UTF-8">
  {{ csrf_field() }}
  <label style="margin-top:30px" for="name" class="control-label">NAME</label>
  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
  @if ($errors->has('name'))
    <span class="help-block">
      <strong>{{ $errors->first('name') }}</strong>
    </span>
  @endif

  <label for="email" class="control-label">EMAIL</label>
  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
  @if ($errors->has('email'))
    <span class="help-block">
      <strong>{{ $errors->first('email') }}</strong>
    </span>
  @endif

  <label for="password" class="control-label">PASSWORD</label>
  <input id="password" type="password" class="form-control" name="password" required>
  <div id='password_error'>
    @if ($errors->has('password'))
      <span class="help-block">
        <strong>{{ $errors->first('password') }}</strong>
      </span>
    @endif
  </div>  

  <label for="password-confirm" class="control-label">RE-ENTER PASSWORD</label>
  <input id="password-confirm" type="password" class="form-control" name="password_confirm" required>
  <div id='password_error'>
    @if ($errors->has('password-confirm'))
      <span class="help-block">
        <strong>{{ $errors->first('password-confirm') }}</strong>
      </span>
    @endif
  </div>
  <label for="password-confirm" class="control-label">DOB MM/DD/YYYY</label>
  
  <input id="birthdate" type="date" name="birthdate" value="{{ old('birthdate') }}" required>
  <div id="birthdate_error">
    @if ($errors->has('birthdate'))
      <span class="help-block">
        <strong>{{ $errors->first('birthdate') }}</strong>
      </span>
    @endif
  </div>
  <p class="age-warning">*MUST BE 18 YEARS OR OLDER TO REGISTER</p>

  <div class="text-left" style="font-weight:200;margin:10px 0 0;">
    <input type="checkbox"> I wish to receive email updates.
  </div>

  <div style="display:none;">
    <input type="checkbox" id="remember_me" name="remember_me"> Remember Me
    <input id="occupation" type="text" class="form-control" name="occupation">
    <input id="user_type" type="text" class="form-control" name="user_type" value="{{ old('user_type') }}">
  </div>
  <button type="submit" class="btn btn-primary">
    NEXT
  </button>
</form>


