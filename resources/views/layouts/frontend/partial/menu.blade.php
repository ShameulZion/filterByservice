<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container nav-wrap">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ setting('site_logo') != null ?  Storage::disk('media')->url(setting('site_logo')) : '' }}" />
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav justify-content-end">
        @foreach($menus as $menu)
          <li class="nav-item">
            <a class="nav-link" href="{{ url($menu->slug) }}">{{ $menu->title }}</a>
          </li>
        @endforeach
        <li class="nav-item contact">
        <a class="nav-link green-text-btn" href="{{ route('contact-us') }}">Contact Us <span class="arrow"></span></a>
        </li>
      </ul>
    </div>
  </div>
</nav>