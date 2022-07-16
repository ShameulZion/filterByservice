@extends('layouts.admin.master')

@section('title','Add Banner')

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
                <div>{{ __('Add Banner') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.module.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to Module list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Module Banner Info</h5>
                </div>

                <form action="{{ url('admin/module/banner') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="">Module Name <small class="text-danger"><strong>*</strong></small></label>
                        <input type="text" name="name" value="{{ old('name')  }}" class="form-control @error('name') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Module Name" >
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Banner <small class="text-danger"><strong>*</strong></small></label>
                        <select name="setting[banner]" class="form-control @error('name') is-invalid @enderror">
                            @foreach($banners as $banner)
                            <option value="{{ $banner->id }}">{{ $banner->banner_name }}</option>
                            @endforeach
                        </select>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Width <small class="text-danger"><strong>*</strong></small></label>
                        <input type="text" name="setting[width]" value="{{ old('width')  }}" class="form-control @error('width') is-invalid @enderror" field-attributes="required autofocus" placeholder="Width" >
                        @error('width')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Height <small class="text-danger"><strong>*</strong></small></label>
                        <input type="text" name="setting[height]" value="{{ old('height')  }}" class="form-control @error('height') is-invalid @enderror" field-attributes="required autofocus" placeholder="Height" >
                        @error('height')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <select name="setting[status]" id="" class="form-control @error('status') is-invalid @enderror">
                            <option value="1">Enable</option>
                            <option value="0">Disable</option>
                        </select>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-shadow btn-sm">Save</button>
                        <a href="{{ route('admin.module.index') }}" class="btn-shadow btn btn-danger btn-sm">{{ __('Cancel') }}</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')

@endpush