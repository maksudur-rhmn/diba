<!doctype html>
<!--[if lt IE 7]>		<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang="">
<![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang="">
<![endif]-->
<!--[if gt IE 8]>
<!-->	<html class="no-js" lang="zxx"> <!--<![endif]-->

<!-- Mirrored from exprostudio.com/html/medlink/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Jun 2020 08:04:10 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ centralSettings()->title }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

       
    <link rel="apple-touch-icon" href="{{ asset('frontend_assets/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/jquery.countdown.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/customScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/fullcalendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/owl.theme.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/jquery-ui.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/color.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/responsive.css') }}">
    <script src="{{ asset('frontend_assets/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js') }}"></script>
    <script src="{{ asset('frontend_assets/js/trans.js') }}"></script>
    <style>
        .translated-ltr{margin-top:-40px;}
        .translated-ltr{margin-top:-40px;}
        .goog-te-banner-frame {display: none;margin-top:-20px;}

        .goog-logo-link {
        display:none !important;
        } 

        .goog-te-gadget{
        color: transparent !important;
        }
        .goog-te-gadget-simple img{
            display: none;
        }
    </style>
</head>

<body class="tg-home tg-login">
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!--************************************
			Preloader Start
	*************************************-->
    {{-- <div class="preloader-outer">
        <div class="pin"></div>
        <div class="pulse"></div>
    </div> --}}
    <!--************************************
			Preloader End
	*************************************-->

    <!--************************************
			Wrapper Start					
	*************************************-->
    <div id="tg-wrapper" class="tg-wrapper tg-haslayout">
        <!--************************************
				Header Start					
		*************************************-->
        <header id="tg-header" class="tg-header tg-haslayout">
            <!--
			<div class="tg-topbar">
				<div class="container">
					<div class="row">
						<div class="col-xs-12 col-sm-12">
							<span class="tg-quickadvice">Get a Quick Advice: <strong>(+4) 1234 5667 - 9</strong></span>
							<ul class="tg-contactinfo">
								<li><a href="#">info@domain.com</a></li>
								<li><address>147 Tottenham, London, W1T 1JY</address></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-xs-12">
                        <strong class="tg-logo">
                            <a href="index.html"><img src="{{ asset('uploads/settings') }}/{{ centralSettings()->logo }}" alt="image description"></a>
                        </strong>
                        <div class="tg-navigationarea">
                            <nav id="tg-nav" class="tg-nav">
                                <div class="navbar-header">
                                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tg-navigation" aria-expanded="false">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                </div>
                                <div id="tg-navigation" class="tg-navigation collapse navbar-collapse">
                                    <ul>
                                        <li><a href="{{ url('/') }}">Home</a></li>
                                        <li><a href="{{ route('front.about') }}">About Us</a></li>
                                        <li><a href="{{ route('front.docs') }}">Doctors</a></li>
                                        <li><a href="{{ route('front.hos') }}">Hospitals</a></li>
                                        <li><a href="{{ route('front.phar') }}">Pharmacies</a></li>
                                        <li><a href="{{ route('front.ambu') }}">Ambulance</a></li>
                                        @guest
                                        <li><a href="{{ route('login') }}" class="join">Login</a></li>
                                        <li><a href="{{ route('register') }}" class="join">Sign up</a></li>
                                        @endguest
                                        @auth
                                        <li><a style="cursor: pointer" class="dropdown-item notify-item join"  {{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                                <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                        <li><a href="{{ route('home') }}" class="join">My account</a></li>
                                        @endauth
                                    </ul>
                                    <span id="google_translate_element"></span>
                                </div>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>


        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- Success Message --}}
        <!--************************************
				Header End						
		*************************************-->