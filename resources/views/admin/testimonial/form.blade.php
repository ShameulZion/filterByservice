@extends('layouts.admin.master')

@section('title','Testimonial')

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
                <div>{{ __((isset($testimonial) ? 'Edit' : 'Create New') . ' Testimonial') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.testimonial.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="NewsFrom" method="POST" action="{{ isset($testimonial) ? route('admin.testimonial.update',$testimonial->id) : route('admin.testimonial.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($testimonial))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Testimonial Info</h5>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Name <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="text" name="name" value="{{ $testimonial->name ?? old('name')  }}" class="form-control @error('name') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Designation <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="text" name="designation" value="{{ $testimonial->designation ?? old('designation')  }}" class="form-control @error('designation') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Designation" >
                                        @error('designation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Company <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" name="company" value="{{ $testimonial->company ?? old('company')  }}" class="form-control @error('company') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Company" >
                                    @error('company')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Description <small class="text-danger"><strong>*</strong></small></label>
                                    <textarea name="description" id="editor1" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{ $testimonial->description ?? old('description')  }}</textarea>
                                    @error('description')
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
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"  data-default-file="{{ isset($testimonial) ? $testimonial->getFirstMediaUrl('image') : old('image')  }}" />
                                    @error('image')
                                        <span class="text-danger font-12" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Sort Order </label>
                                    <input type="text" name="sort_order" value="{{ $testimonial->sort_order ?? old('sort_order')  }}" class="form-control @error('sort_order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Sort Order" >
                                    @error('sort_order')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @isset($testimonial) @if($testimonial->status = 0) selected  @endif @endisset>Disable</option>
                                        <option value="1" @isset($testimonial) @if($testimonial->status = 1) selected  @endif @endisset>Enable</option>
                                    </select>
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('NewsFrom')"><i class="fas fa-redo"></i></button>

                                @isset($testimonial)
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
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    menubar: true
  });
</script>
@endpush