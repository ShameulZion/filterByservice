<!DOCTYPE html>
<html lang="zxx">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<title>BIID EXPO & DIALOGUE | AGRITECH BANGLADESH</title> 

		<!-- Favicon -->
		<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
		<!-- Owl Carousel -->
		<link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.css')}}" />
		<!-- Bootstrap Style -->
		<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css')}}" />
		<!-- Basic Style -->
		<link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}" />		

	</head> 

	<body>

		<header>
            @include('layouts.frontend.partial.menu')
		</header>

        @yield('content')

        @include('layouts.frontend.partial.footer')

		<script src="{{('frontend/js/jquery.min.js')}}"></script>
		<script src="{{('frontend/js/bootstrap.min.js')}}"></script>
		<script src="{{('frontend/js/owl.carousel.min.js')}}"></script>
		<script type="text/javascript">
			$('#event-list').owlCarousel({
				loop:true,
				margin:10,
				nav:true,
				navText: ["<span class='arrow'></span>","<span class='arrow'></span>"],
				responsive:{
					0:{
						items:4
					},
					600:{
						items:4
					},
					1000:{
						items:5
					}
				}
			});
			$('#partner-list').owlCarousel({
				loop:true,
				margin:10,
				nav:true,
				navText: ["<span class='arrow'></span>","<span class='arrow'></span>"],
				responsive:{
					0:{
						items:4
					},
					600:{
						items:4
					},
					1000:{
						items:5
					}
				}
			});
			$('#sponsor-list').owlCarousel({
				loop:true,
				margin:10,
				nav:true,
				navText: ["<span class='arrow'></span>","<span class='arrow'></span>"],
				responsive:{
					0:{
						items:4
					},
					600:{
						items:4
					},
					1000:{
						items:5
					}
				}
			});
			$('#testimonial-list').owlCarousel({
				loop:true,
				margin:10,
				nav:true,
				navText: ["<span class='arrow'></span>","<span class='arrow'></span>"],
				responsive:{
					0:{
						items:1
					},
					600:{
						items:1
					},
					1000:{
						items:1
					}
				}
			});
		</script>
	</body><!-- /body -->
</html><!-- /html -->