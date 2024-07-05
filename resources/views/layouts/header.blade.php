<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="margin-top: -6px;">
        @if(!is_null(auth()->user()->profile_image))         
          <img src="{{ auth()->user()->profile_image }}" width="35" height="35" class="img-circle elevation-2" alt="User Image">
        @else
          <img src="{{ asset('images/default-profile-picture.png') }}" width="35" height="35" class="img-circle elevation-2" alt="User Image">
        @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">          
          <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->