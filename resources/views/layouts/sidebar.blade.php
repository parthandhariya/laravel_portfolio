<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ (auth()->user()->user_type == "admin") ? route('admin.home') : route('home') }}" class="brand-link">

      @if(is_null(auth()->user()->dashboard_image))
        {{-- <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> --}}
        <img src="{{ asset('images/dashboard_image/default_dashboard_image.png') }}" alt="AdminLTE Logo" class="brand-image w-100 elevation-3" style="opacity: .8; float: none; margin-left: 0;">
        {{-- <span class="brand-text font-weight-light">AdminLTE 3</span>  --}}
      @else
        <img src="{{ auth()->user()->dashboard_image }}" alt="AdminLTE Logo" class="w-100 brand-image elevation-3" style="opacity: .8; float: none; margin-left: 0;">
        <!-- <span class="brand-text font-weight-light">AdminLTE 3</span> -->
      @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                         
          <li class="nav-item menu-open">
            

            @if(auth()->user()->user_type == "admin")
              <ul class="nav nav-treeview">                
                <li class="nav-item">
                  <a href="{{ route('allusers.index') }}" class="nav-link active">
                    <i class="far fa-user nav-icon"></i>
                    <p>All Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('admin.factoryreset') }}" class="nav-link active">
                    <p>Factory Reset</p>                   
                    <i class="fa fa-trash nav-icon right pl-2" aria-hidden="true"></i>
                    
                  </a>
                </li>              
              </ul>
            @endif

            @if(auth()->user()->user_type == "user")
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('frontend',auth()->user()->slug) }}" target="_blank" class="nav-link" style="background-color: #28a745; border-color:#28a745; color:#fff;">
                    <i class="fa fa-eye"></i>
                    <p>Preview Website</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('pages.index') }}" class="nav-link active">
                    <i class="fa fa-file nav-icon"></i>
                    <p>Pages</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('themeoption.index') }}" class="nav-link active">
                    <i class="fa fa-paint-brush nav-icon"></i>
                    <p>Theme Options</p>
                  </a>
                </li>
              </ul> 
          </li>          

          
          
          

        

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-list-ul"></i>
              <p>
              Property Detail
              <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">              
              <li class="nav-item">
                <a href="{{ route('propertycategory.index') }}" class="nav-link">
                  <i class="fa fa-th-list nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('propertyprice.index') }}" class="nav-link">
                  <i class="fa fa-tags nav-icon"></i>
                  <p>Price</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('property.list.view') }}" class="nav-link">
                  <i class="fa fa-table nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('footer.index') }}" class="nav-link custom-menu-style">
              <i class="fa fa-ellipsis-h nav-icon"></i>
              <p>Footer</p>
            </a>
          </li>
          
          @endif

        </ul>


      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>