<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="author" content="Untree.co" />
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

        .footer{
            min-width: 100%;
        }
       
    </style>

    

    <title>
        {{ $user->themeOption[0]->site_name ?? '' }}
    </title>
</head>