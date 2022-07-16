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
                    <h1>Speaker</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-event-area speaker">
    <div class="container">
        <div class="row">
            @foreach($speakers as $speaker)
            <div class="col-md-6 col-sm-12">
                <div class="spk-item left">
                    <div class="spk-img">
                        <img src="{{ $speaker->getFirstMediaUrl('image')  }}">
                    </div>
                    <div class="spk-content">
                        <h5 class="name">{{ $speaker->name }}</h5>
                        <div class="spk-desc">{{ $speaker->designation }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection