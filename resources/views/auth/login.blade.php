<!DOCTYPE html>

<html lang="en">

<head>

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Login</title>



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

  <!-- /.login-logo -->

  <div class="card card-outline card-primary">

    <div class="text-center">

      <!-- <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a> -->

      <img src="{{ asset('images/login_page_image/loginpage.png') }}" class="w-100" height="100" />

    </div>

    <div class="card-body">

      

      @if (session('message'))

          <div class="alert alert-success">

              {{ session('message') }}

          </div>

      @endif

      

      @if($errors->any())        

          {!! implode('', $errors->all('<div class="text-red">:message</div>')) !!}

      @endif



      <form action="{{ route('login') }}" method="post">

        @csrf

        <div class="input-group mb-3">

          <input type="text" name="username" class="form-control" placeholder="Email or Mobile">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-user"></span>

            </div>

          </div>

        </div>

        <div class="input-group mb-3">

          <input type="password" name="password" class="form-control" placeholder="Password">

          <div class="input-group-append">

            <div class="input-group-text">

              <span class="fas fa-lock"></span>

            </div>

          </div>

        </div>

        <div class="row">

          {{-- <div class="col-8">

            <div class="icheck-primary">

              <input type="checkbox" name="remember" id="remember">

              <label for="remember">

                Remember Me

              </label>

            </div>

          </div> --}}

          <!-- /.col -->

          <div class="col-12">

            <button type="submit" class="btn btn-primary btn-block">Sign In</button>

          </div>

          <!-- /.col -->

        </div>

      </form>
      

      {{-- <p class="mb-1">

        <a href="{{ route('forgotpassword') }}">I forgot my password</a>

      </p> --}}

      <p class="mb-0 mt-2">

        <a href="{{ route('register') }}" class="text-center">Register a new membership</a>

      </p>

    </div>

    <!-- /.card-body -->

  </div>

  <!-- /.card -->

</div>

<!-- /.login-box -->



<!-- jQuery -->

<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->

<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->

<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>



<script type="text/javascript">

  

  $( document ).ready(function() {    

    $('input').prop('autocomplete','off');

  });



</script>



</body>

</html>

