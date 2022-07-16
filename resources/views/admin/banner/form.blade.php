@extends('layouts.admin.master')

@section('title','Banner')

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
                <div>{{ __((isset($banner) ? 'Edit' : 'Create New') . ' Banner') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.banner.index') }}" class="btn-shadow btn btn-danger">
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
            <form class="row" role="form" id="NewsFrom" method="POST" action="{{ isset($banner) ? route('admin.banner.update',$banner->id) : route('admin.banner.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($banner))
                    @method('PUT')
                @endif
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Banner Info</h5>
                            <div class="form-group">
                                <label for="">Banner Name <small class="text-danger"><strong>*</strong></small></label>
                                <input type="text" name="banner_name" value="{{ $banner->banner_name ?? old('banner_name')  }}" class="form-control @error('banner_name') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                @error('banner_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Status </label>
                                <select name="status" class="form-control">
                                    <option value="1" @isset($banner) @if($banner->status = 1) selected  @endif @endisset>Enable</option>
                                    <option value="0" @isset($banner) @if($banner->status = 0) selected  @endif @endisset>Disable</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <button type="button" class="btn btn-danger"  on-click="resetForm('NewsFrom')"><i class="fas fa-redo"></i></button>
                                @isset($banner)
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Update</button>
                                @else
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</button>
                                @endisset
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    menubar: true
  });
</script>
@endpush