<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
    <head>        
        <title>Laravel</title>
        	<!-- Fonts -->
        	<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        	<!-- Google Font: Source Sans Pro -->
			 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
			 <!-- Font Awesome Icons -->
			 <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
			 <!-- Theme style -->
			 <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

			 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
		    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
		    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">


		    <!-- New css -->
		    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

		    <link
          rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css"
          />

          	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

          	<!--Plugin CSS file with desired skin-->
    		{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/> --}}

			@yield('style')			 
    </head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">

		@include('layouts.header')

		@include('layouts.sidebar')

		@yield('content')

		@include('layouts.footer')

		@include('sweetalert::alert')

	</div>
</body>

</html>