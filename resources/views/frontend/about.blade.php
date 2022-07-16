@extends('layouts.frontend.master')

@section('title')
    About | BIID EXPO & DIALOGUE | AGRITECH BANGLADESH
@endsection
@section('description')
About | BIID EXPO & DIALOGUE | AGRITECH BANGLADESH
@endsection
@section('keywords')
About | BIID EXPO & DIALOGUE | AGRITECH BANGLADESH
@endsection

@section('content')

<div class="page-heading-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>{{ $page->title }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="main-content">
                    <div class="row">
                        @if(count($page->media))
                        <div class="col-md-12">
                            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    @foreach($page->getMedia('image') as $key => $media)
                                        <li data-target="#carouselExampleIndicators" data-slide-to="0" @if($key==0) class="active" @endif></li>
                                    @endforeach
                                </ol>
                                <div class="carousel-inner">
                                    @foreach($page->getMedia('image') as $key => $media)
                                        <div class="carousel-item @if($key==0) active @endif">
                                            <img class="d-block w-100" src="{{ $media->getUrl() }}" alt="First slide">
                                        </div>
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
                        </div>
                        @else 

                        @endif
                        <div class="col-md-12">
                            <div class="maim-content-description">
                                {!! $page->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="sidebar">
                    <div class="sidebar-inner">
                        <ul class="list-group">
                            <li class="list-group-item sidebar-title"><h3>Important Links</h3></li>
                            @foreach($sidebars as $sidebar)
                                <li class="list-group-item">
                                    <a href="{{ url($sidebar->slug) }}"><i class="fa fa-angle-double-right" aria-hidden="true"></i> {{ $sidebar->title }}</a>
                                    @if(count($sidebar->childs))
                                        <ul>
                                            @foreach($sidebar->childs as $child)
                                                <li><a href="{{ url($child->slug) }}">{{ $child->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection