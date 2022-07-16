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
                    <h1>Event</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-event-area">
    <div class="container">
        <div class="row">
            @foreach($events as $event)
            <div class="col-md-3 col-sm-3 event-details-list">
                <div class="card h-100 event-card">
                    <img src="{{ $event->getFirstMediaUrl('image') }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{!! $event->description !!}</p>
                        <a href="{{ url('registration-form') }}" class="customBtn"><span>Register</span></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection