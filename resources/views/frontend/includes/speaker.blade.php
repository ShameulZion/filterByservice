<section class="speaker section-wrap">
    <div class="container nav-wrap">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">Our Speaker</h2>
            </div>
        </div>
        <div class="row">
            @foreach($speakers as $speaker)
                <div class="col-md-6 col-sm-12">
                    <div class="spk-item left">
                        <div class="spk-img">
                            <img src="{{ $speaker->getFirstMediaUrl('image') ?? ''  }}">
                        </div>
                        <div class="spk-content">
                            <h5 class="name">{{ $speaker->name }}</h5>
                            <div class="spk-desc">{{ $speaker->designation }}</div>
                            <a href="{{ url('speaker') }}" class="green-text-btn">View Details <span class="arrow"></span></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="button">
                <a class="customBtn" href="{{ url('/speaker') }}"><span>View More</span></a>
            </div>
        </div>
    </div>
</section>