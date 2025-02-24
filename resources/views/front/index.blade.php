<!-- /*
* Template Name: Property
* Template Author: Untree.co
* Template URI: https://untree.co/
* License: https://creativecommons.org/licenses/by/3.0/
*/ -->

<!DOCTYPE html>
<html lang="en">
  
  @include('front.head')

  <body>


    <!-- Start Page Loader -->
    <div id="page-loader" class="page-loader d-none">
      <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <!-- End Page Loader -->

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icofont-close js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>
    
    @include('front.navbar')
    
    
    
    <div class="slider-container">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
          
          @if($user->themeOption->count() > 0 && !is_null($user->themeOption[0]->banner_images))

            @php
              $bannerImageArray = json_decode($user->themeOption[0]->banner_images,true);        
            @endphp
            
            @foreach ($bannerImageArray as $key => $value)
            
            <div class="swiper-slide"><img src="{{ $value }}" class="slider-img" alt="Image"></div>            
                              
            @endforeach

          @else
                        
            <div class="swiper-slide"><img src="{{ asset('client/assets/images/hero_bg_3.jpg') }}" class="slider-img" alt="Image 1"></div>
            <div class="swiper-slide"><img src="{{ asset('client/assets/images/hero_bg_2.jpg') }}" class="slider-img" alt="Image 2"></div>
            <div class="swiper-slide"><img src="{{ asset('client/assets/images/hero_bg_1.jpg') }}" class="slider-img" alt="Image 3"></div>

          @endif

        </div>  
      </div>
      {{-- <div class="swiper-pagination"></div> --}}
      <!-- Navigation -->
      {{-- <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div> --}}
    </div>  
      
    </div>

    
    <div class="custom-section-position">
      <div>
        {{--<div class="row mb-5 align-items-center">
          <div class="col-lg-6">
            <h2 class="font-weight-bold text-primary heading">
              Popular Properties
            </h2>
          </div>
          <div class="col-lg-6 text-lg-end">
            <p>
              <a
                href="#"
                target="_blank"
                class="btn btn-primary text-white py-3 px-4"
                >View all properties</a
              >
            </p>
          </div>
        </div> --}}

        <div class="row align-items-center ps-5">
          {{-- <img src="{{ asset('client/assets/images/coming_soon_page.webp') }}" /> --}}
          <div col-md-12>
            <input type="hidden" value="{{ $slug }}" id="slug">

            <div class="row auto-resize me-3">

              <div class="col-auto mb-4">

                <select class="form-control" name="option_id" id="option_id">
                  <option value="">-- Select Option --</option>
                  @foreach($propertyOption as $k => $v)
                    <option value="{{ $v->propertyOption->id }}">{{ $v->propertyOption->option_name }}</option>
                  @endforeach
                </select>
                
              </div>

              <div class="col-auto mb-4">
                
                <select class="form-control" name="category_id" id="category_id">
                  <option value="">-- Select Category --</option>
                  @foreach($propertyCategory as $k => $v)
                    <option value="{{ $v->propertyCategory->id }}">{{ $v->propertyCategory->name }}</option>
                  @endforeach
                </select>
                
              </div>

              <div class="col-auto mb-4">
                
                <select class="form-control" name="price_id" id="price_id">
                  <option value="">-- Select Price Range --</option>
                  @foreach($propertyPrice as $k => $v)
                    <option value="{{ $v->propertyPrice->id }}">{{ '₹' . number_format($v->propertyPrice->min_price, 2, '.', ','). ' to ' .'₹' . number_format($v->propertyPrice->max_price, 2, '.', ',') }}</option>
                  @endforeach
                </select>
                
              </div>
            
              <div class="col-auto col-md-2 mb-4">
                
                <select class="form-control" name="state_id" id="state_id">
                  <option value="">-- Select State --</option>
                  @foreach($propertyState as $k => $v)
                    <option value="{{ $v->state_id }}">{{ ucwords(strtolower($v->state->name)) }}</option>
                  @endforeach
                </select>
                
              </div>

              <div class="col-auto col-md-2 mb-4">
                
                <select class="form-control" name="city_id" id="city_id">
                  <option value="">-- Select City --</option>                  
                </select>
                
              </div>

              <div class="mb-4 col-md-1">
                <button id="btn_view_images" class="btn btn-primary">Search</button>
              </div>

            </div>

          </div>
        </div>

        
        <div class="row align-items-center pl-0">
          <div id="filterImages" class="ms-5">
            
          </div>
        </div>
                                  
      </div>
    </div>

              
    @include('front.footer')
    <!-- /.site-footer -->

    {{-- <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/tiny-slider.js"></script>
    <script src="assets/js/aos.js"></script>
    <script src="assets/js/navbar.js"></script>
    <script src="assets/js/counter.js"></script>
    <script src="assets/js/custom.js"></script> --}}

    {{-- <script src="https://gomaps.pro/library.js"></script> --}}
    {{-- <script src="https://maps.gomaps.pro/maps/api/place/queryautocomplete/json?input=NewDelhi&key=AlzaSyzCYIKwBp27mkuVR6o0VTPMlArHtJtDfIP"></script> --}}
    
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <script>

    


  $(document).ready(function(){
  
  
    
    
    



  //Get State wise cities
  $(document).on("change","#state_id",function(){
      var state_id = $(this).val();
      var option = '';
      $("#city_id").empty();
      $.ajax({
        url: "{{ route('getcityfromstatefilter') }}",
        data: { _token: $('meta[name="csrf-token"]').attr('content'), state_id:state_id, slug:$("#slug").val() },
        type: 'POST',
        success: function(res){
          option += '<option value = ' + 0 + '>--Select City--</option>';
          $.each(res, function(index,value){
            option += '<option value = '+ index +'>'+ value +'</option>';
          })
          
          $("#city_id").append(option);           
        }

      });
  });


  $(document).on("click","#btn_view_images",function(){

    var slug = $("#slug").val();
    var option_id = $("#option_id").val();
    var category_id = $("#category_id").val();
    var price_id = $("#price_id").val();
    var state_id = $("#state_id").val();
    var city_id = $("#city_id").val();

    // console.log(city_id);
    // return false;

    $("#filterImages").empty();
    
    $.ajax({
        url: "{{ route('frontend.filterimage') }}",
        method: "post",              
        dataType: 'text',
        data: {
          "_token": "{{ csrf_token() }}",
          'slug': slug,
          'option_id':option_id,
          'category_id':category_id,
          'price_id':price_id,
          'state_id':state_id,
          'city_id':city_id,
        },
        beforeSend: function() {

            $('#page-loader').removeClass('d-none');
        },
        success: function(res)
        {
          $("#filterImages").append(res);          
        },
        complete: function() {

          $('#page-loader').addClass('d-none');

        },
    });

  });                
        let map;       
  
        function updateMap(lat, lng) 
        {
          lat = parseFloat(lat);  // Ensure lat is a number
          lng = parseFloat(lng);  // Ensure lng is a number

          if (isNaN(lat) || isNaN(lng)) {
              console.error("Invalid latitude or longitude values:", lat, lng);
              return;
          }

          if (typeof map !== "undefined") {
              map.setCenter(new google.maps.LatLng(lat, lng));
              new google.maps.Marker({
                  position: { lat: lat, lng: lng },
                  map: map,
                  title: "Updated Location",
              });
          } else {
              console.error("Map is not initialized.");
          }
        }

  
        function initMap(lat, lng, mapId)
        {
          lat = parseFloat(lat);
          lng = parseFloat(lng);
          //alert(mapId);
          $("#map"+mapId).css({ "height": "400px"});
          //alert(mapId+'  '+lat+'  '+lng);
          map = new google.maps.Map(document.getElementById("map"+mapId), {
              center: { lat: lat, lng: lng },
              zoom: 10,
          });

          new google.maps.Marker({
              position: { lat: lat, lng: lng },
              map: map,
              title: "Initial Location",
          });
        }              

        function loadGoogleMaps(lat,lng,mapId) {
            if (window.google && window.google.maps) {
                initMap(lat,lng,mapId); // Example: San Francisco
                return;
            }
            
            var script = document.createElement("script");
            script.src = "https://maps.gomaps.pro/maps/api/js?key=AlzaSyrNlkOdl0-1B20KiC-KT8k-IgYGdwhJOpd&callback=loadGoogleMaps";
            script.async = true;
            script.defer = true;
            document.body.appendChild(script);
        }
   
        loadGoogleMaps();
        
        $(document).on("click",".btn-view-map",function(){          
          loadGoogleMaps($(this).data('lat'), $(this).data('lng'), $(this).attr('data-mapId'));          
        });
  });

  var swiper = new Swiper(".mySwiper", {
      loop: true,
      autoplay: {
          delay: 2000,
          disableOnInteraction: false,
      },
      navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
      },
      pagination: {
          el: ".swiper-pagination",
          clickable: true,
      },
  });

    </script>

  </body>
</html>
