<section class="testimonial section-wrap">
    <div class="container nav-wrap">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">Testimonials</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="testimonial-list" class="owl-carousel">
                    @foreach($testimonials as $testimonial)
                        <div class="item row align-items-center">
                            <div class="col-sm-6 col-6">
                                <div class="test-item">
                                    <div class="test-content">{!! $testimonial->description !!}</div>
                                    <div class="test-author">
                                        <h6>{{ $testimonial->name }}</h6>
                                        <p>{{ $testimonial->company }} <br>{{ $testimonial->designation }} </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-6">
                                <div class="test-pic">
                                    <img src="{{ $testimonial->getFirstMediaUrl('image') ?? ''  }}">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>