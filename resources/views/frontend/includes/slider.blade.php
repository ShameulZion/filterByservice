
<section class="slider">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      @foreach($sliders as $slider)
        @foreach($slider->sliderItems as $key => $item)
          <li data-target="#carouselExampleIndicators" data-slide-to="0" @if($key==0) class="active" @endif></li>
          @endforeach
      @endforeach
    </ol>
    <div class="carousel-inner">
      @foreach($sliders as $slider)
        @foreach($slider->sliderItems as $key => $item)
          <div class="carousel-item @if($key==0) active @endif">
            <img class="d-block w-100" src="{{ $item->getFirstMediaUrl('image') ?? ''  }}" alt="First slide">
          </div>
        @endforeach
      @endforeach
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="arrow" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="arrow" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</section>
