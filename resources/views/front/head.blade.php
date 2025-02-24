<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ $user->themeOption[0]->site_favicon ?? '' }}" />

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap5" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    {{-- <link rel="stylesheet" href="{{ asset('client/assets/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/fonts/flaticon/font/flaticon.css') }}" />

    <link rel="stylesheet" href="{{ asset('client/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}" /> --}}


    <!-- Latest compiled and minified CSS -->
    <script src="https://gomaps.pro/library.js"></script>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



    <link rel="stylesheet" href="{{ asset('client/assets/fonts/icomoon/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/fonts/flaticon/font/flaticon.css') }}" />

    <link rel="stylesheet" href="{{ asset('client/assets/css/tiny-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('client/assets/css/style.css') }}" />


    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    

    @php
        $backgroundColor = NULL;
        $fontColor = NULL;
        $designColor = $user->themeOption[0]->background_and_font ?? NULL;
        
        if(!is_null($designColor))
        {
            $designColor = json_decode($designColor,true);
            $backgroundColor = $designColor['background'];
            $fontColor = $designColor['font'];
        }
    @endphp

    <style type="text/css">
                        
        .btn{
            font-size: 1.3rem !important;
        }

        .site-nav {            
            position: fixed;
            top: 0;
            z-index: 9;
            padding: 0;
            width: 100%;
        }

        .menu-bg-wrap{
            border-radius: 0;
            background-color: {{ $backgroundColor ?? '#005555' }};
            min-height:85px;
            max-height:85px;
        }

        .site-nav .site-navigation .site-menu > li > a {
            
            color: {{ $fontColor ?? 'rgba(255, 255, 255, 0.5)' }};
        }

        .hero, .hero > .container > .row {
            height: 92vh;
            /* min-height: 400px;            */
        }

        .hero-slide .img {            
            margin-top: 85px;
           
        }

        .hero-slide .img.overlay {
            position: relative;
            max-height: 400px;
        }

        .custom-contaier {            
            padding: 0;
            min-width: 100%;
        }
          
        #map {
            height: 400px;
            width: 100%;
        }

        .btn{
            border-radius: 0px;
            background-color: {{ $backgroundColor ?? '#005555' }} !important;
            color: {{ $fontColor ?? 'FFFFFF' }} !important;
        }

        .site-footer {
            background: antiquewhite;
            /* padding-top: 40px;             */
        }

        .custom-section-position{
            margin-top: 3rem !important;
            margin-bottom: 2rem !important;            
        }
       
        .swiper{
            margin-top: 8rem;
            height: 400px;
            overflow: hidden;           
        }

        .slider-img{
            height: 100% !important;
            width: 100%;
            overflow: hidden;
        }
    
        .alert-message{
            width: 75%;
        }

        #btn_view_images {
                width:100%;
        }

        .auto-break {
            white-space: pre-line;
            line-height: inherit !important;
        }
        .property-address{            
            padding-left: initial !important; 
        }

        .info-value-color{            
            color: forestgreen !important;
        }
        
        @media (max-width: 768px) {
            .alert-message {
                width:fit-content;
            }
            #btn_view_images {
                width:50%;
            }
        }

        @media (max-width: 480px) {
            .auto-resize {
                flex-direction: column;
            }
        }

        /* page loader css */
        .page-loader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1050; /* Ensure it covers other content */
        }

    </style>


    

    <title>
        {{ $user->themeOption[0]->site_name ?? '' }}
    </title>
</head>