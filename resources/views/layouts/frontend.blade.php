
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
	<link rel="shortcut icon" href="{!! asset('admin/logo.png') !!}">

	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="{!! asset('fontawesome/css/all.css') !!}">

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

	<!-- toastr -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('css/toastr.min.css')}}"/>
	<style media="screen">
        .search_select{
            background-color:#EFEBEA;
            border:0;
            color:#F78536;
            font-weight: bold;
        }
		.mt-75{
			margin-top: -75px;
		}
		@media only screen and (max-width: 1366px) {
			.search_bar{
				padding: 0;
			}
		}
		.no-border tr td{
			border:0 !important;
			padding: 2px !important;
		}
    </style>

	@yield('styles')


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
							<h1 id="fh5co-logo"><a href="{!! route('frontend.home') !!}"><i class="fa fa-bus-alt"></i>{{ config('app.name') }}</a></h1>
							<!-- START #fh5co-menu-wrap -->
							<nav id="fh5co-menu-wrap" role="navigation">
								<ul class="sf-menu" id="fh5co-primary-menu">
									<li class="active"><a href="{!! route('frontend.home') !!}">Home</a></li>
									<li>
										<a class="fh5co-sub-ddown">Package</a>
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
									<li><a href="{!! route('frontend.contact') !!}">Contact</a></li>
									@if (auth('customer')->check())
										<li>
											<a class="fh5co-sub-ddown">{{ auth('customer')->user()->name }}</a>
											<ul class="fh5co-sub-menu">
												<li>
													<a href="{{ route('customer.dashboard') }}">
														Dashboard
													</a>
												</li>
												<li>
													<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
														Sign out
													</a>
												</li>

												<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                                            {{ csrf_field() }}
		                                        </form>
											</ul>
										</li>
									@else
										<li>
											<a class="fh5co-sub-ddown">Account</a>
											<ul class="fh5co-sub-menu">
												<li><a href="{!! route('login') !!}">Sign in</a></li>
												<li><a href="{!! route('customer.register') !!}">Sign up</a></li>
											</ul>
										</li>
									@endif
								</ul>
							</nav>
						</div>
					</div>
				</header>

				<!-- end:header-top -->

				@yield('content')

				<footer>
					<div style="padding:0 0 40px 0; " id="footer">
						<div style="background: #525457; padding-top: 60px">
							<div class="container">
								<div class="row row-bottom-padded-md">
									<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
										<h3>About Travel</h3>
										<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
										<h3>Top Hotels</h3>
										<ul>
											@if ($top_5_hotels)
												@foreach ($top_5_hotels as $hotel)
													<li><a href="{!! route('frontend.hotel.details',$hotel->slug) !!}">{{ $hotel->name }}</a></li>
												@endforeach
											@endif
										</ul>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
										<h3>Best Places</h3>
										<ul>
											@if ($top_5_places)
												@foreach ($top_5_places as $place)
													<li><a href="{!! route('frontend.place.details',$place->slug) !!}">{{ $place->title }}</a></li>
												@endforeach
											@endif
										</ul>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
										<h3>Social Media</h3>
										<ul>
											<li><a href="#">Facebook</a></li>
											<li><a href="#">Twitter</a></li>
											<li><a href="#">YouTube</a></li>
										</ul>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
										<h3>User Account</h3>
										<ul>
											<li><a href="{!! route('login') !!}">Sign in</a></li>
											<li><a href="{!! route('customer.register') !!}">Sign up</a></li>
											<li><a href="{!! route('customer.dashboard') !!}">Account settings</a></li>
										</ul>
									</div>
									<div class="col-md-2 col-sm-2 col-xs-12 fh5co-footer-link">
										<h3>Company</h3>
										<ul>
											<li><a href="{!! route('about-us') !!}">About Us</a></li>
											<li><a href="{!! route('terms_n_onditions') !!}">Terms & Conditions</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div style="background: #393e46; padding-top: 25px" class="">
							<div class="container">
								<div class="row">
									<div class="col-md-6 text-left">
										<p>© {{ date('Y') }} {{ config('app.name')}}, All right reserved.</p>
									</div>
									<div class="col-md-6 text-right">
										<div style="line-height: 8px">
											<p><b>Corporate office</b></p>
											<p>House: 45, Road: 13/C, Block: E, Banani, Dhaka, Bangladesh</p>
										</div>
										<div style="line-height: 8px">
											<p><b>Contact us</b></p>
											<p>Email: ask@tb-bd.com </p>
											<p>Phone: +8809617617617</p>
										</div>
									</div>
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
	<script src="{!! asset('js/vuejs/vue.js') !!}"></script>
	<script src="{!! asset('js/vuejs/app.js') !!}"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
	<!-- toastr -->
    <script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>
    <script type="text/javascript">
        @if (Session::has('success'))
            toastr.success("{{Session::get('success')}}")
        @endif
        @if (Session::has('info'))
            toastr.info("{{Session::get('info')}}")
        @endif
    </script>
	@yield('scripts')
	</body>
</html>
