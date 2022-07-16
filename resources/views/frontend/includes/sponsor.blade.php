@foreach($sponsors as $banner)
<section class="sponsor section-wrap">
    <div class="container nav-wrap">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title">{{ $banner->banner_name}}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="sponsor-list" class="owl-carousel">
                    @foreach($banner->bannerItems as $bannerItem)
                        <div class="item">
                            @if(!empty($bannerItem->url))
                                <a href="{{ $bannerItem->url }}" target="_blank">
                                    <img src="{{ $bannerItem->getFirstMediaUrl('image') ?? ''  }}" alt="{{ $bannerItem->title }}">
                                </a>
                            @else
                                <img src="{{ $bannerItem->getFirstMediaUrl('image') ?? ''  }}" alt="{{ $bannerItem->title }}">
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach