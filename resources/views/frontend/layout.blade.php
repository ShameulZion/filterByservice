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

@include('frontend.includes.slider')

@include('frontend.includes.event')

@include('frontend.includes.exhibition')

@include('frontend.includes.service')

@include('frontend.includes.speaker')

@include('frontend.includes.partner')

@include('frontend.includes.sponsor')

@include('frontend.includes.testimonial')

    <div class="footer-top">
        <h4>Ready to get started?</h4>
        <div class="button">
            <a href="{{ url('/registration-form') }}" class="customBtn btn-white"><span>Register Now</span></a>  
        </div>
    </div>

@endsection