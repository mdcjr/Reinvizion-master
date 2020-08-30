<form class="form-horizontal forgot-password" role="form" method="POST" action="{{ url('/password/email') }}">
  {{ csrf_field() }}

  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-4 control-label">ENTER EMAIL</label>

    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
    <div style="clear: both;"> </div>
    <span class="help-block"> </span>
    <!-- @if ($errors->has('email'))
      <span class="help-block" style="clear: both;">
        <strong>{{ $errors->first('email') }}</strong>
      </span>
    @endif -->
    @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
    <script>
      $(document).ready(function(){
        // $("#success-password-button").trigger('click');
        // $("#success-register-button").trigger('click');
      });
    </script>
    @endif
  </div>

  <div class="form-group">
    <button type="submit" name="submit" class="btn btn-primary button btn-outlined forgot-button">
      SUBMIT
    </button>
  </div>
</form>