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

    <style type="text/css">
        .btn{
            font-size: 1.3rem !important;
        }
    </style>

    <title>
        {{ $user->themeOption[0]->site_name ?? '' }}
    </title>
</head>