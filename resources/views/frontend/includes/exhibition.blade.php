<section class="exhibitors section-wrap">
    <div class="container nav-wrap">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">Upcoming Exhibitors</h2>
                <p>GITF is a business-to-business platform for agricultural professionals, from small scale farmers to commercial enterprises, to engage and conduct business with some of the world's leading suppliers to the agricultural industry.</p>
            </div>
        </div>
        <div class="row">
            @foreach($events as $event)
                <div class="col-md-3 col-sm-4 col-6 ">
                    <div class="item">
                        <a href="{{ url('event/'.$event->slug) }}">
                            <div class="shadow"></div>
                            <div class="title">{{ $event->title }}</div>
                            <div class="date">{!! $event->description !!}</div>
                            <img src="{{ $event->getFirstMediaUrl('image') }}">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="button">
                    <a class="customBtn" href="{{ url('/event') }}"><span>View More</span></a>
                </div>
            </div>
        </div>
    </div>
</section>