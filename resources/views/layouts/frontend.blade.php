
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>{{ config('app.name') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />

  <!--
	//////////////////////////////////////////////////////

	FREE HTML5 TEMPLATE
	DESIGNED & DEVELOPED by FREEHTML5.CO

	Website: 		http://freehtml5.co/
	Email: 			info@freehtml5.co
	Twitter: 		http://twitter.com/fh5co
	Facebook: 		https://www.facebook.com/fh5co

	//////////////////////////////////////////////////////
	 -->

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>

	<!-- Animate.css -->
	<link rel="stylesheet" href="{!! asset('frontend/css/animate.css') !!}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{!! asset('frontend/css/icomoon.css') !!}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{!! asset('frontend/css/bootstrap.css') !!}">
	<!-- Superfish -->
	<link rel="stylesheet" href="{!! asset('frontend/css/superfish.css') !!}">
	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{!! asset('frontend/css/magnific-popup.css') !!}">
	<!-- Date Picker -->
	<link rel="stylesheet" href="{!! asset('frontend/css/bootstrap-datepicker.min.css') !!}">
	<!-- CS Select -->
	<link rel="stylesheet" href="{!! asset('frontend/css/cs-select.css') !!}">
	<link rel="stylesheet" href="{!! asset('frontend/css/cs-skin-border.css') !!}">

	<link rel="stylesheet" href="{!! asset('frontend/css/style.css') !!}">


	<!-- Modernizr JS -->
	<script src="{!! asset('frontend/js/modernizr-2.6.2.min.js') !!}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="{!! asset('frontend/js/respond.min.js') !!}"></script>
	<![endif]-->

	</head>
	<body>
		<div id="fh5co-wrapper">
			<div id="fh5co-page">

				<header id="fh5co-header-section" class="sticky-banner">
					<div class="container">
						<div class="nav-header">
							<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
							<h1 id="fh5co-logo"><a href="{!! route('frontend.home') !!}"><i class="icon-airplane"></i>{{ config('app.name') }}</a></h1>
							<!-- START #fh5co-menu-wrap -->
							<nav id="fh5co-menu-wrap" role="navigation">
								<ul class="sf-menu" id="fh5co-primary-menu">
									<li class="active"><a href="{!! route('frontend.home') !!}">Home</a></li>
									<li>
										<a href="{!! route('frontend.packages') !!}" class="fh5co-sub-ddown">Package</a>
										<ul class="fh5co-sub-menu">
											@if ($package_types->count())
												@foreach ($package_types as $type)
													<li><a href="{!! route('frontend.type.packages',$type->slug) !!}">{{ $type->type }}</a></li>
												@endforeach
											@endif
											<li><a href="{!! route('frontend.packages') !!}">All</a></li>
										</ul>
									</li>
									<li><a href="{!! route('frontend.places') !!}">Place</a></li>
									<li><a href="">Contact</a></li>
								</ul>
							</nav>
						</div>
					</div>
				</header>

				<!-- end:header-top -->

				@yield('content')

				<footer>
					<div id="footer">
						<div class="container">

							<div class="row">
								<div class="col-md-6 col-md-offset-3 text-center">
									<p class="fh5co-social-icons">
										<a href="#"><i class="icon-twitter2"></i></a>
										<a href="#"><i class="icon-facebook2"></i></a>
										<a href="#"><i class="icon-instagram"></i></a>
										<a href="#"><i class="icon-dribbble2"></i></a>
										<a href="#"><i class="icon-youtube"></i></a>
									</p>
									<p>Copyright 2016 Free Html5 <a href="#">Module</a>. All Rights Reserved. <br>Made with <i class="icon-heart3"></i> by <a href="" target="_blank">Freehtml5.co</a> / Demo Images: <a href="" target="_blank">Unsplash</a></p>
								</div>
							</div>
						</div>
					</div>
				</footer>



			</div>
			<!-- END fh5co-page -->

		</div>
		<!-- END fh5co-wrapper -->

		<!-- jQuery -->


	<script src="{!! asset('frontend/js/jquery.min.js') !!}"></script>
	<!-- jQuery Easing -->
	<script src="{!! asset('frontend/js/jquery.easing.1.3.js') !!}"></script>
	<!-- Bootstrap -->
	<script src="{!! asset('frontend/js/bootstrap.min.js') !!}"></script>
	<!-- Waypoints -->
	<script src="{!! asset('frontend/js/jquery.waypoints.min.js') !!}"></script>
	<script src="{!! asset('frontend/js/sticky.js') !!}"></script>

	<!-- Stellar -->
	<script src="{!! asset('frontend/js/jquery.stellar.min.js') !!}"></script>
	<!-- Superfish -->
	<script src="{!! asset('frontend/js/hoverIntent.js') !!}"></script>
	<script src="{!! asset('frontend/js/superfish.js') !!}"></script>
	<!-- Magnific Popup -->
	<script src="{!! asset('frontend/js/jquery.magnific-popup.min.js') !!}"></script>
	<script src="{!! asset('frontend/js/magnific-popup-options.js') !!}"></script>
	<!-- Date Picker -->
	<script src="{!! asset('frontend/js/bootstrap-datepicker.min.js') !!}"></script>
	<!-- CS Select -->
	<script src="{!! asset('frontend/js/classie.js') !!}"></script>
	<script src="{!! asset('frontend/js/selectFx.js') !!}"></script>

	<!-- Main JS -->
	<script src="{!! asset('frontend/js/main.js') !!}"></script>

	</body>
</html>
