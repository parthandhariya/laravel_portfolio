<nav class="site-nav">
      <div class="container custom-contaier">
        <div class="menu-bg-wrap">
          <div class="site-navigation">
            {{-- <a href="index.html" class="logo m-0 float-start">Property</a> --}}
            <img src="{{ $user->themeOption[0]->site_logo ?? '' }}" alt="" style="height: 45px; width: 100px;">

            <ul class="js-clone-nav d-none d-lg-inline-block text-start site-menu float-end">
              {{-- <li class="{{ $activeMenu == 'home' ? 'active' : '' }}"><a href="{{ route('frontuser.home',$user->slug) }}">Home</a></li>
              
              <li class="{{ $activeMenu == 'service' ? 'active' : '' }}"><a href="{{ route('frontuser.service',$user->slug) }}">Services</a></li>
              <li class="{{ $activeMenu == 'about' ? 'active' : '' }}"><a href="{{ route('frontuser.about',$user->slug) }}">About</a></li>
              <li class="{{ $activeMenu == 'contactus' ? 'active' : '' }}"><a href="{{ route('frontuser.contactus',$user->slug) }}">Contact Us</a></li> --}}

              {{-- @dd($pages); --}}
              @foreach($pages as $key => $value)
                
                @if($value->children()->count() > 0)
                
                    <li class="has-children">
                      <a href="#">{{ $value->name }}</a>
                      <ul class="dropdown">
                      
                        @foreach($value->children as $k => $v)

                            @if($v->children()->count() > 0)

                              <li class="has-children">
                                <a href="#">{{ $v->name }}</a>
                                <ul class="dropdown">

                                    @foreach($v->children as $k1 => $v1)

                                        @if($v1->children()->count() > 0)

                                        @else

                                          <li class=""><a href="{{ '' }}">{{ $v1->name }}</a></li>

                                        @endif

                                    @endforeach

                                </ul>
                              </li>  

                            @else
                              <li class=""><a href="{{ '' }}">{{ $v->name }}</a></li>
                            @endif

                        @endforeach

                      </ul>
                   </li>
                
                @else

                    
                    <li class=""><a href="{{ '' }}" class="">{{ $value->name }}</a></li>

                @endif

              @endforeach              
                            
            </ul>

            <a
              href="#"
              class="burger light me-auto float-end mt-1 site-menu-toggle js-menu-toggle d-inline-block d-lg-none"
              data-toggle="collapse"
              data-target="#main-navbar"
            >
              <span></span>
            </a>
          </div>
        </div>
      </div>
    </nav>