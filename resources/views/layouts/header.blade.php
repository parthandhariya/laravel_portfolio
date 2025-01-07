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

      <!-- Notifications Dropdown Menu -->

      @if(auth()->user()->user_type == "admin")

        @php
          $eloquant = "\App\Models\PropertyDetail";
          $totalPendingImage = $eloquant::whereNotNull('property_image')->where('image_status',0)->count();

          $totalUserWisePendingImage = $eloquant::select('user_id',\DB::raw('count(*) as totalImage'))->whereNotNull('property_image')->where('image_status',0)->groupBy('user_id')->get();
                  
        @endphp

        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">{{ $totalPendingImage > 0 ? $totalPendingImage : '' }}</span>
          </a>


          @if($totalPendingImage > 0)

            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width: 280px;">
              <span class="dropdown-item dropdown-header">{{ $totalPendingImage .' Notifications' }} </span>
              <div class="dropdown-divider"></div>
              
              @foreach($totalUserWisePendingImage as $key => $value)
              <a href="{{ route('property.images.view',[$value->user_id]) }}" class="dropdown-item">
                <img src="{{ $value->user->profile_image ?? asset('images/default-profile-picture.png') }}" width="35" height="35" class="img-circle" alt="User Image"> {{ $value->totalImage . ' Images Pending' }}
                {{-- <span class="float-right text-muted text-sm">12 hours</span> --}}
              </a>
              @endforeach
                          
              <div class="dropdown-divider"></div>
              {{-- <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
            </div>

          @endif

        </li>
      @endif
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="margin-top: -6px;">
        @if(!is_null(auth()->user()->profile_image))         
          <img src="{{ auth()->user()->profile_image }}" width="35" height="35" class="img-circle elevation-2" alt="User Image">
        @else
          <img src="{{ asset('images/default-profile-picture.png') }}" width="35" height="35" class="img-circle elevation-2" alt="User Image">
        @endif
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">          
          @if(auth()->user()->user_type == "user")
            <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
            <div class="dropdown-divider"></div>
          @endif
          <a class="dropdown-item" href="{{ route('logout') }}">Log Out</a>
        </div>
      </li>
      

    </ul>
  </nav>
  <!-- /.navbar -->