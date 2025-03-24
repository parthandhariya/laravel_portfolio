<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="{{ asset('images/user_site_favicon/user_favicon.png') ?? '' }}" />

    <head>
		
        <title>Laravel</title>
        	<!-- Fonts -->
        	<link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        	<!-- Google Font: Source Sans Pro -->
			 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
			 <!-- Font Awesome Icons -->
			 <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
			
			 <!-- Select2 -->
			 <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
			 <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

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

		  <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet" />

          	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

          	<!--Plugin CSS file with desired skin-->
    		{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/> --}}

			@yield('style')

			<style type="text/css">
				.custom-menu-style{
					background-color: rgba(255, 255, 255, .9);
    				color: #343a40 !important;
				}
				.custom-menu-style:hover{
					background-color: rgba(255, 255, 255, .9) !important;
    				color: #343a40 !important;
				}

				.far, .fa-bell {
			      position: relative;
			    }
			    .far, .fa-bell::after {
			      content: "";
			      position: absolute;
			      top: 10px;
			      right: 30px;
			      width: 10px;
			      height: 10px;			      
			      border-radius: 50%;
			      border: 2px solid white;
			    }

				body:not(.layout-fixed) .main-sidebar {
					height: inherit;
					min-height: 100%;
					position: fixed;
					top: 0;
				}

				.content-header {
					padding: 5px .5rem;
				}
			</style>			 
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