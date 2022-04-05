@extends('layouts.admin.master')

@section('title','Filter Profile')

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
                <div>{{ __((isset($filterProfile) ? 'Edit' : 'Create New') . ' Filter Profile') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('filterProfile.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- form start -->
            <form role="form" id="userFrom" method="POST" action="{{ isset($filterProfile) ? route('filterProfile.update',$filterProfile->id) : route('filterProfile.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($filterProfile))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Filter Profile Info</h5>

                                <div class="form-group">
                                    <label for="">Filter Profile Name <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" id="title" name="title" value="{{ $filterProfile->title ?? ''  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Sort Order </small></label>
                                    <input type="number" name="sort_order" value="{{ $filterProfile->sort_order ?? ''  }}" class="form-control @error('sort_order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Sort Order" >
                                    @error('sort_order')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="card-title">Status</label>
                                        <input type="checkbox" name="status" value="1" class="custom-switch" value="1" {{ isset($filterProfile->status) ? 'checked' : ''  }} />
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('userFrom')"><i class="fas fa-redo"></i></button>

                                @isset($filterProfile)
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Update</button>
                                @else
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</button>
                                @endisset
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')

@endpush