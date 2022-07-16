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
                    <h1>{{ $news->title }}</h1>
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
                        @if(!empty($news->getMedia('image')))
                        <div class="col-md-12">
                            <div class="main-content-banner">
                                <img src="{{ $news->getFirstMediaUrl('image') }}" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        @endif
                        <div class="col-md-12">
                            <div class="maim-content-description">
                                {!! $news->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection