<div class="row footer">
<div class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="widget">
              <h3>{{ $footer[0]->footer->footer_heading ?? '' }}</h3>
              {{-- <address>43 Raymouth Rd. Baltemoer, London 3910</address> --}}
              <ul class="list-unstyled links">
                <li>{{ $footer[0]->line1  ?? ''}}</li>
                <li>{{ $footer[0]->line2  ?? ''}}</li>
                <li>{{ $footer[0]->line3  ?? ''}}</li>
                <li>{{ $footer[0]->line4  ?? ''}}</li>
                <li>{{ $footer[0]->line5  ?? ''}}</li>
              </ul>
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="widget">
              <h3>{{ $footer[1]->footer->footer_heading ?? '' }}</h3>
              <ul class="list-unstyled float-start links">
                <li>{{ $footer[1]->line1  ?? ''}}</li>
                <li>{{ $footer[1]->line2  ?? ''}}</li>
                <li>{{ $footer[1]->line3  ?? ''}}</li>
                <li>{{ $footer[1]->line4  ?? ''}}</li>
                <li>{{ $footer[1]->line5  ?? ''}}</li>
              </ul>              
            </div>
            <!-- /.widget -->
          </div>
          <!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <div class="widget">
              <h3>{{ $footer[2]->footer->footer_heading ?? '' }}</h3>
              <ul class="list-unstyled links">
                <li><a href="{{ $footer[2]->line1  ?? '' }}">{{ $footer[2]->line1  ?? '' }}</a></li>
                <li><a href="{{ $footer[2]->line2  ?? '' }}">{{ $footer[2]->line2  ?? '' }}</a></li>
                <li><a href="{{ $footer[2]->line3  ?? '' }}">{{ $footer[2]->line3  ?? '' }}</a></li>
                <li><a href="{{ $footer[2]->line4  ?? '' }}">{{ $footer[2]->line4  ?? '' }}</a></li>
                <li><a href="{{ $footer[2]->line5  ?? '' }}">{{ $footer[2]->line5  ?? '' }}</a></li>
              </ul>

              {{-- <ul class="list-unstyled social">
                <li>
                  <a href="#"><span class="icon-instagram"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-twitter"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-facebook"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-linkedin"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-pinterest"></span></a>
                </li>
                <li>
                  <a href="#"><span class="icon-dribbble"></span></a>
                </li>
              </ul> --}}
            </div>
            <!-- /.widget -->
          </div>
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