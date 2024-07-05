<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Forgot Password (v2)</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="text-center">
      <img src="{{ asset('images/login_page_image/loginpage.png') }}" class="w-100" height="100" />
    </div>
    <div class="card-body">
      @if($errors->any())        
          {!! implode('', $errors->all('<div class="text-red login-box-msg">:message</div>')) !!}
      @endif
      <form action="{{ route('resetpasswordpost') }}"  method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
          
        <div class="input-group mb-3">
          <br>
          <label for="password" class="col-md-12">Email</label>
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <br>
          <label for="password" class="col-md-12">Password</label>
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <br>
          <label for="password" class="col-md-12">Confirm Password</label>
          <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">
          @if ($errors->has('password_confirmation'))
              <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
          @endif
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
      
        <div class="offset-md-12">
            <button type="submit" class="btn btn-primary">
                Reset Password
            </button>
        </div>
    </form>

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
