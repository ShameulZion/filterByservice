@extends('layouts.admin.master')

@section('title','Banner')

@push('css')
    <style>
        .modal-dialog{
            box-shadow: none;
        }
        .modal-backdrop{
            height: auto !important;
            width: auto !important;
            background-color: transparent !important;
        }
    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-pages icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($bannerItem) ? 'Edit' : 'Create New') . ' Banner') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.banner.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to Banner List') }}
                    </a>
                    <a class="btn-shadow btn btn-danger" href="{{ route('admin.banner.banner-list',$banner->id) }}">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Banner List') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form role="form" id="NewsFrom" method="POST" action="{{ isset($bannerItem) ? route('admin.banner.item.banner-update',['id'=>$banner->id,'itemId'=>$bannerItem->id]) : route('admin.banner.item.banner-store',$banner->id) }}" enctype="multipart/form-data">
                @csrf
                @if (isset($bannerItem))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Slide Info</h5>
                                <div class="form-group">
                                    <label for="">Title <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" name="title" value="{{ $bannerItem->title ?? old('title')  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Title" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            <div class="form-group">
                                <label for="">Website Url <small class="text-danger"><strong>*</strong></small></label>
                                <input type="text" name="url" value="{{ $bannerItem->url ?? old('url')  }}" class="form-control @error('url') is-invalid @enderror" field-attributes="required autofocus" placeholder="Website Url" >
                                @error('url')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Sort Order <small class="text-danger"><strong>*</strong></small></label>
                                <input type="text" name="sort_order" value="{{ $bannerItem->sort_order ?? old('sort_order')  }}" class="form-control @error('sort_order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Sort Order" >
                                @error('sort_order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Featured Image and Status</h5>
                                
                                <div class="form-group">
                                    <label for="">Featured Image (Only Image are allowed) <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"  data-default-file="{{ isset($bannerItem) ? $bannerItem->getFirstMediaUrl('image') : old('image')  }}" />
                                    @error('image')
                                        <span class="text-danger font-12" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('NewsFrom')"><i class="fas fa-redo"></i></button>

                                @isset($bannerItem)
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