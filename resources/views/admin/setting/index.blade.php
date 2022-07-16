@extends('layouts.admin.master')

@section('title','Speaker')

@push('css')

@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-pages icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __('Settings') }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">
                    <ul class="nav nav-justified">
                        <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-0" class="active nav-link">General</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-1" class="nav-link">Mail</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-2" class="nav-link">Socialite</a></li>
                        <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-3" class="nav-link">Social Url</a></li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-eg7-0" role="tabpanel">
                            <form id="settingsFrom" autocomplete="off" role="form" method="POST" action="{{ route('admin.setting.appearance.update') }}" enctype="multipart/form-data" class="row">
                                @csrf
                                @method('PATCH')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Store Name</label>
                                        <input type="text" class="form-control @error('site_title') is-invalid @enderror" name="site_title" value="{{ setting('site_title') ?? old('site_title') }}" placeholder="Store Name">
                                        @error('site_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ setting('email') ?? old('email') }}">
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta Title</label>
                                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" placeholder="Meta Title" value="{{ setting('meta_title') ?? old('meta_title') }}" />
                                        @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ setting('address') ?? old('address') }}</textarea>
                                        @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Logo</label>
                                        <input type="file" class="dropify @error('site_logo') is-invalid @enderror" name="site_logo"  data-default-file="{{ setting('site_logo') != null ?  Storage::disk('media')->url(setting('site_logo')) : '' }}" />
                                        @error('site_logo')
                                            <span class="text-danger font-12" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Store Owner</label>
                                        <input type="text" class="form-control @error('store_owner') is-invalid @enderror" name="store_owner" placeholder="Store Owner" value="{{ setting('store_owner') ?? old('store_owner') }}">
                                        @error('store_owner')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telephone Or Mobile</label>
                                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" placeholder="Telephone Or Mobile" value="{{ setting('telephone') ?? old('telephone') }}">
                                        @error('telephone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta Keyword</label>
                                        <input type="text" class="form-control @error('meta_keyword') is-invalid @enderror" name="meta_keyword" placeholder="Meta Keyword" value="{{ setting('meta_keyword') ?? old('meta_keyword') }}">
                                        @error('meta_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Meta Description</label>
                                        <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror">{{ setting('meta_description') ?? old('meta_description') }}</textarea>
                                        @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Favicon</label>
                                        <input type="file" class="dropify @error('site_favicon') is-invalid @enderror" name="site_favicon"  data-default-file="{{ setting('site_favicon') != null ?  Storage::disk('media')->url(setting('site_favicon')) : '' }}" />
                                        @error('site_favicon')
                                            <span class="text-danger font-12" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger" onClick="resetForm('settingsFrom')">
                                            <i class="fas fa-redo"></i>
                                            <span>Reset</span>
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-arrow-circle-up"></i>
                                            <span>Update</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab-eg7-1" role="tabpanel">
                            <form id="settingsFrom" autocomplete="off" role="form" method="POST" action="{{ route('admin.setting.mail.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_mailer">Mailer <code>{ key: mail_mailer }</code></label>
                                            <input type="text" name="mail_mailer" id="mail_mailer"
                                                class="form-control @error('mail_mailer') is-invalid @enderror"
                                                value="{{ setting('mail_mailer') ?? old('mail_mailer') }}"
                                                placeholder="Mailer">
                                            @error('mail_mailer')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_encryption">Mail Encryption <code>{ key: mail_encryption }</code></label>
                                            <input type="text" name="mail_encryption" id="mail_encryption"
                                                class="form-control @error('mail_encryption') is-invalid @enderror"
                                                value="{{ setting('mail_encryption') ?? old('mail_encryption') }}"
                                                placeholder="Encryption Type">
                                            @error('mail_encryption')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_host">Mail Host <code>{ key: mail_host }</code></label>
                                            <input type="text" name="mail_host" id="mail_host"
                                                class="form-control @error('mail_host') is-invalid @enderror"
                                                value="{{ setting('mail_host') ?? old('mail_host') }}"
                                                placeholder="Mail Host">
                                            @error('mail_host')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mail_port">Mail Port <code>{ key: mail_port }</code></label>
                                            <input type="text" name="mail_port" id="mail_port"
                                                class="form-control @error('mail_port') is-invalid @enderror"
                                                value="{{ setting('mail_port') ?? old('mail_port') }}"
                                                placeholder="Mail Port">
                                            @error('mail_port')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="mail_username">Mail Username <code>{ key: mail_username }</code></label>
                                    <input type="text" name="mail_username" id="mail_username"
                                        class="form-control @error('mail_username') is-invalid @enderror"
                                        value="{{ setting('facebook') ?? old('facebook') }}"
                                        placeholder="Username">
                                    @error('mail_username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mail_password">Mail Password <code>{ key: mail_password }</code></label>
                                    <input type="password" name="mail_password" id="mail_password"
                                        class="form-control @error('mail_password') is-invalid @enderror"
                                        value="{{ setting('mail_password') ?? old('mail_password') }}"
                                        placeholder="Password">
                                    @error('mail_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mail_from_address">Mail From Address <code>{ key: mail_from_address }</code></label>
                                    <input type="email" name="mail_from_address" id="mail_from_address"
                                        class="form-control @error('mail_from_address') is-invalid @enderror"
                                        value="{{ setting('mail_from_address') ?? old('mail_from_address') }}"
                                        placeholder="From Address">
                                    @error('mail_from_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mail_from_name">Mail From Name <code>{ key: mail_from_name }</code></label>
                                    <input type="text" name="mail_from_name" id="mail_from_name"
                                        class="form-control @error('mail_from_name') is-invalid @enderror"
                                        value="{{ setting('mail_from_name') ?? old('mail_from_name') }}"
                                        placeholder="From Name">
                                    @error('mail_from_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-danger" onClick="resetForm('settingsFrom')">
                                        <i class="fas fa-redo"></i>
                                        <span>Reset</span>
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span>Update</span>
                                    </button>
                                </div>
                            </form>
                        </div>


                        <div class="tab-pane" id="tab-eg7-2" role="tabpanel">
                            <form id="settingsFrom" autocomplete="off" role="form" method="POST" action="{{ route('admin.setting.socialite.update') }}" enctype="multipart/form-data" class="row">
                                @csrf
                                @method('PATCH')
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Facebook</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="facebook_client_id">Facebook Client Id</label>
                                                        <input type="text" name="facebook_client_id" id="facebook_client_id" class="form-control @error('mail_mailer') is-invalid @enderror" value="{{ setting('facebook_client_id') ?? old('facebook_client_id') }}" placeholder="Client Id">
                                                        @error('facebook_client_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="facebook_client_secret">Facebook Client Secret</label>
                                                        <input type="text" name="facebook_client_secret" id="facebook_client_secret" class="form-control @error('facebook_client_secret') is-invalid @enderror" value="{{ setting('facebook_client_secret') ?? old('facebook_client_secret') }}" placeholder="Secret">
                                                        @error('facebook_client_secret')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Google</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="google_client_id">Google Client Id</label>
                                                        <input type="text" name="google_client_id" id="google_client_id" class="form-control @error('mail_mailer') is-invalid @enderror" value="{{ setting('google_client_id') ?? old('google_client_id') }}" placeholder="Client Id">
                                                        @error('google_client_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="google_client_secret">Google Client Secret</label>
                                                        <input type="text" name="google_client_secret" id="google_client_secret" class="form-control @error('google_client_secret') is-invalid @enderror" value="{{ setting('google_client_secret') ?? old('google_client_secret') }}" placeholder="Secret">
                                                        @error('google_client_secret')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3>Google</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="github_client_id">Github Client Id</label>
                                                        <input type="text" name="github_client_id" id="github_client_id" class="form-control @error('mail_mailer') is-invalid @enderror" value="{{ setting('github_client_id') ?? old('github_client_id') }}" placeholder="Client Id">
                                                        @error('github_client_id')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="github_client_secret">Github Client Secret</label>
                                                        <input type="text" name="github_client_secret" id="github_client_secret" class="form-control @error('github_client_secret') is-invalid @enderror" value="{{ setting('github_client_secret') ?? old('github_client_secret') }}" placeholder="Secret">
                                                        @error('github_client_secret')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-4">
                                    <button type="button" class="btn btn-danger" onClick="resetForm('settingsFrom')">
                                        <i class="fas fa-redo"></i>
                                        <span>Reset</span>
                                    </button>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-arrow-circle-up"></i>
                                        <span>Update</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="tab-pane" id="tab-eg7-3" role="tabpanel">
                            <form id="settingsFrom" autocomplete="off" role="form" method="POST" action="{{ route('admin.setting.social.update') }}" enctype="multipart/form-data" class="row">
                                @csrf
                                @method('PATCH')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Facebook</label>
                                        <input type="text" class="form-control @error('facebook') is-invalid @enderror" name="facebook" placeholder="Facebook Url" value="{{ setting('facebook') ?? old('facebook') }}" />
                                        @error('facebook')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">LinkedIn</label>
                                        <input type="text" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" placeholder="LinkedIn Url" value="{{ setting('linkedin') ?? old('linkedin') }}" />
                                        
                                        @error('linkedin')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Youtube</label>
                                        <input type="text" class="form-control @error('youtube') is-invalid @enderror" name="youtube" placeholder="Youtube Url" value="{{ setting('youtube') ?? old('youtube') }}" />
                                        
                                        @error('youtube')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Reddit</label>
                                        <input type="text" class="form-control @error('reddit') is-invalid @enderror" name="reddit" placeholder="Reddit Url" value="{{ setting('reddit') ?? old('reddit') }}" />
                                        
                                        @error('reddit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Twitter</label>
                                        <input type="text" class="form-control @error('twitter') is-invalid @enderror" name="twitter" placeholder="Twitter Url" value="{{ setting('twitter') ?? old('twitter') }}" />
                                        
                                        @error('twitter')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Instagram</label>
                                        <input type="text" class="form-control @error('instagram') is-invalid @enderror" name="instagram" placeholder="Instagram Url" value="{{ setting('instagram') ?? old('instagram') }}" />
                                        
                                        @error('instagram')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Pinterest</label>
                                        <input type="text" class="form-control @error('pinterest') is-invalid @enderror" name="pinterest" placeholder="Pinterest Url" value="{{ setting('pinterest') ?? old('pinterest') }}" />
                                        
                                        @error('pinterest')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="">Quora</label>
                                        <input type="text" class="form-control @error('quora') is-invalid @enderror" name="quora" placeholder="Quora Url" value="{{ setting('quora') ?? old('quora') }}" />
                                        
                                        @error('quora')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-danger" onClick="resetForm('settingsFrom')">
                                            <i class="fas fa-redo"></i>
                                            <span>Reset</span>
                                        </button>

                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-arrow-circle-up"></i>
                                            <span>Update</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Datatable
            $("#datatable").DataTable();
        });
    </script>
@endpush