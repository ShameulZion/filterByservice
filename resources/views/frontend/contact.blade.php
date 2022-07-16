@extends('layouts.frontend.master')

@section('title')
    Contact Us | BIID EXPO & DIALOGUE | AGRITECH BANGLADESH
@endsection
@section('description')
    
@endsection
@section('keywords')
    
@endsection

@section('content')

<div class="page-heading-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-heading">
                    <h1>Contact Us</h1>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-content-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footer-content">
                <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active show" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true">Headquarters</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false">China Agent</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active p-3" id="one" role="tabpanel" aria-labelledby="one-tab">
                        <div class="contact-page bg-gray">
                            <div class="contact-adress">
                                <ul>
                                    <h3><span style="font-weight: bold;"><span>{{ setting('site_title') ?? old('site_title') }}</span></h3>
                                    <li><i class="fa fa-map-marker"></i> <span>{{ setting('address') ?? old('address') }}</span></li>
                                    <li><i class="fa fa-envelope"></i> <span>{{ setting('email') ?? old('email') }}</span></li>
                                    <li><i class="fa fa-mobile"></i> <span>{{ setting('telephone') ?? old('telephone') }}</span></li>
                                </ul>
                                <div class="m-2">
                                    @if(Session::has('flash_message_error'))
                                        <div class="alert alert-error alert-dismissible fade show" role="alert">
                                            <strong>{!! session('flash_message_error') !!}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif   
                                    @if(Session::has('flash_message_success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{!! session('flash_message_success') !!}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <form class="contact_form" action="{{ route('contact-us') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Name" value="" id="input-name" class="form-control  @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email" value="" id="input-email" class="form-control  @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="phone" placeholder="Phone" value="" id="input-phone" class="form-control  @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="subject" placeholder="Subject" value="" id="input-subject" class="form-control  @error('subject') is-invalid @enderror">
                                                @error('subject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea name="enquiry" placeholder="Message" rows="3" id="input-enquiry" class="form-control  @error('enquiry') is-invalid @enderror"></textarea>
                                                @error('enquiry')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <button class="btn customBtn btn-block" type="submit"><span>Submit</span></button>
                                    </div>
                                </form>
                            </div>
                            <div class="contact-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.162838544416!2d90.36078641536348!3d23.81280789230534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c12707bc0001%3A0x7a0b0a17a803c76c!2sHouse-19%2C%201%20Road-5%2C%20Dhaka%201216!5e0!3m2!1sen!2sbd!4v1650867450883!5m2!1sen!2sbd"  width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>      
                    </div>
                    <div class="tab-pane fade p-3" id="two" role="tabpanel" aria-labelledby="two-tab">
                        <div class="contact-page bg-gray">
                            <div class="contact-adress">
                                <ul>
                                    <h3><span style="font-weight: bold;">China Agent</span></h3>
                                    <li><i class="fa fa-map-marker"></i> <span>Mr. Jeff Lee | Zhongshan Tengda Sega Exhibition Co., Ltd. | Mr.  Gary | CHINA BUILDMAN FAIRS INTERNATIONAL CBFI)</span></li>
                                    <li><i class="fa fa-envelope"></i> <span>wm01@td-star.net | gary_niu@build-ccpit.org </span></li>
                                    <li><i class="fa fa-phone"></i> <span>Tel:(+86)18025688500 | 18025688500</span></li>
                                    <li><i class="fa fa-mobile"></i> <span>(+86) 13726040498 | 1581080852</span></li>
                                    <li><i class="fa fa-globe"></i> <span>www.td-star.net | www.hktexpo.com</span></li>
                                </ul>
                                
                                <div class="m-2">
                                    @if(Session::has('flash_message_error'))
                                        <div class="alert alert-error alert-dismissible fade show" role="alert">
                                            <strong>{!! session('flash_message_error') !!}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif   
                                    @if(Session::has('flash_message_success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{!! session('flash_message_success') !!}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                </div>
                                <form class="contact_form" action="{{ route('contact-us') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Name" value="" id="input-name" class="form-control  @error('name') is-invalid @enderror">
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Email" value="" id="input-email" class="form-control  @error('email') is-invalid @enderror">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="phone" placeholder="Phone" value="" id="input-phone" class="form-control  @error('phone') is-invalid @enderror">
                                                @error('phone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="text" name="subject" placeholder="Subject" value="" id="input-subject" class="form-control  @error('subject') is-invalid @enderror">
                                                @error('subject')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <textarea name="enquiry" placeholder="Message" rows="3" id="input-enquiry" class="form-control  @error('enquiry') is-invalid @enderror"></textarea>
                                                @error('enquiry')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="buttons">
                                        <button class="btn customBtn btn-block" type="submit"><span>Submit</span></button>
                                    </div>
                                </form>
                            </div>
                            <div class="contact-map">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3650.162838544416!2d90.36078641536348!3d23.81280789230534!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c12707bc0001%3A0x7a0b0a17a803c76c!2sHouse-19%2C%201%20Road-5%2C%20Dhaka%201216!5e0!3m2!1sen!2sbd!4v1650867450883!5m2!1sen!2sbd"  width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div>
                        </div>           
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection