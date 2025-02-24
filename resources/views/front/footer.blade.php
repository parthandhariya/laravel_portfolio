<div class="row footer">
<div class="site-footer">
      <div class="container">
        <div class="row">
          
          @foreach ($footer as $key => $value)
            @if(is_null($value->footer_heading) || $value->footer_heading == "")
              @continue
            @endif
            <div class="col-lg-3">
              <div class="widget">
                <h3>{{ $value->footer_heading ?? '' }}</h3>
                {{-- <address>43 Raymouth Rd. Baltemoer, London 3910</address> --}}
                <ul class="list-unstyled links">
                  <li>{{ $value->footer_line1  ?? ''}}</li>
                  <li>{{ $value->footer_line2  ?? ''}}</li>
                  <li>{{ $value->footer_line3  ?? ''}}</li>
                  <li>{{ $value->footer_line4  ?? ''}}</li>                  
                </ul>
              </div>
              <!-- /.widget -->
            </div>

          @endforeach
          
          <!-- /.col-lg-4 -->
        </div>
        <!-- /.row -->

        <div class="row mt-0">
          <div class="col-12 text-center">
            <!-- 
              **==========
              NOTE: 
              Please don't remove this copyright link unless you buy the license here https://untree.co/license/  
              **==========
            -->

            {{-- <p>
              Copyright &copy;
              <script>
                document.write(new Date().getFullYear());
              </script>
              . All Rights Reserved. &mdash; Designed with love by
              <a href="https://untree.co">Untree.co</a>
              <!-- License information: https://untree.co/license/ -->
            </p>
            <div>
              Distributed by
              <a href="https://themewagon.com/" target="_blank">themewagon</a>
            </div> --}}
          </div>
        </div>
      </div>
      <!-- /.container -->
    </div>

    <!-- Preloader -->
    <div id="overlayer"></div>
    <div class="loader">
      <div class="spinner-border" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>

    {{-- <script src="https://gomaps.pro/library.js"></script> --}}
    

    <script src="{{ asset('client/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('client/assets/js/tiny-slider.js') }}"></script>
    <script src="{{ asset('client/assets/js/aos.js') }}"></script>
    <script src="{{ asset('client/assets/js/navbar.js') }}"></script>
    <script src="{{ asset('client/assets/js/counter.js') }}"></script>
    <script src="{{ asset('client/assets/js/custom.js') }}"></script>
</div>