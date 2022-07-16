@extends('layouts.frontend.master')

@section('title')
    {{ setting('meta_title') ?? old('meta_title') }}
@endsection
@section('description')
    {{ setting('meta_description') ?? old('meta_description') }}
@endsection
@section('keywords')
    {{ setting('meta_keyword') ?? old('meta_keyword') }}
@endsection

@section('content')

<div class="page-heading-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>News</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-event-area">
    <div class="container">
        <div class="row">
            @foreach($newses as $news)
            <div class="col-md-3 col-sm-3 mb-4">
                <div class="card h-100 event-card">
                    <img src="{{ $news->getFirstMediaUrl('image') }}" class="card-img-top" alt="..." height="146">
                    <div class="card-body">
                        <h5 class="card-title">{{ $news->title }}</h5>
                        <a href="{{ url('news/'.$news->slug) }}" class="customBtn"><span>View More</span></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection