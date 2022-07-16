<footer>
  	<div class="container">
    	<div class="row">
      		<div class="col-md-4 col-sm-12">
        		<div class="footer-1st">
          			<img src="{{ setting('site_logo') != null ?  Storage::disk('media')->url(setting('site_logo')) : '' }}">
          			<div class="footer-1st-address">
            			<p class="address"><i class="fa fa-map-marker"></i> <span>{{ setting('address') ?? old('address') }} </span></p>
            			<p class="address"><i class="fa fa-mobile"></i> <span> {{ setting('telephone') ?? old('telephone') }}</span></p>
            			<p class="address"><i class="fa fa-envelope"></i> <span> {{ setting('email') ?? old('email') }}</span></p>
          			</div>
        		</div>
      		</div>
			<div class="col-md-2 offset-md-1 col-sm-12">
				<div class="footer-2nd">
					<h5>Important Links</h5>
					<div class="footer-nav">
						<ul>
							@foreach($footers->skip(2)->take(6) as $footer)
								<li><a href="{{ url($footer->slug) }}">{{ $footer->title }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-2 offset-md-1 col-sm-12">
				<div class="footer-2nd">
					<h5>Quick Links</h5>
					<div class="footer-nav">
						<ul>
							@foreach($footers->skip(8) as $footer)
								<li><a href="{{ url($footer->slug) }}">{{ $footer->title }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-2 col-sm-12">
				<div class="footer-3nd">
					<h5>Follow us</h5>
					<div class="footer-nav">
						<ul>
							<li><a href="{{ url('/about-biid') }}">About biid</a></li>
							<li><a href="{{ url('/contact-us') }}">Contact Us</a></li>
						</ul>
					</div>
					<ul class="social">
						@if(!empty(setting('facebook')))
						<li class="facebook">
							<a href="{{ setting('facebook') ?? old('facebook') }}" class="fa fa-facebook" target="_blank" ></a>
						</li>
						@endif
						@if(!empty(setting('twitter')))
						<li class="twitter">
							<a href="{{ setting('facebook') ?? old('facebook') }}" class="fa fa-twitter" target="_blank" ></a>
						</li>
						@endif
						@if(!empty(setting('youtube')))
						<li class="youtube">
							<a href="{{ setting('youtube') ?? old('youtube') }}" class="fa fa-youtube-play" target="_blank" ></a>
						</li>
						@endif
						@if(!empty(setting('linkedin')))
						<li class="linkedin">									
							<a href="{{ setting('linkedin') ?? old('linkedin') }}" class="fa fa-linkedin" target="_blank" ></a>
						</li>
						@endif
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="copyright">
					<p>2022 © BIID Expo. | Developed by <a href="https://sypsolutions.com.bd" target="_blank">SYP Solutions Ltd.</a></p>
				</div>
			</div>
		</div>
	</div>
</footer>