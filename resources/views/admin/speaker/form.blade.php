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
                <div>{{ __((isset($speaker) ? 'Edit' : 'Create New') . ' Speaker') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.speaker.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="NewsFrom" method="POST" action="{{ isset($speaker) ? route('admin.speaker.update',$speaker->id) : route('admin.speaker.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($speaker))
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
                                        <input type="text" name="name" value="{{ $speaker->name ?? old('name')  }}" class="form-control @error('name') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Designation <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="text" name="designation" value="{{ $speaker->designation ?? old('designation')  }}" class="form-control @error('designation') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Designation" >
                                        @error('designation')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Facebook Url</label>
                                        <input type="url" name="facebook" value="{{ $speaker->facebook ?? old('facebook')  }}" class="form-control @error('facebook') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Facebook Url" >
                                        @error('facebook')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Twitter Url</label>
                                        <input type="url" name="twitter" value="{{ $speaker->twitter ?? old('twitter')  }}" class="form-control @error('twitter') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Twitter Url" >
                                        @error('twitter')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Linkedin Url</label>
                                        <input type="url" name="linkedin" value="{{ $speaker->linkedin ?? old('linkedin')  }}" class="form-control @error('linkedin') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Linkedin Url" >
                                        @error('linkedin')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Sort Order </label>
                                        <input type="text" name="sort_order" value="{{ $speaker->sort_order ?? old('sort_order')  }}" class="form-control @error('sort_order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Sort Order" >
                                        @error('sort_order')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @isset($speaker) @if($speaker->status = 0) selected  @endif @endisset>Disable</option>
                                        <option value="1" @isset($speaker) @if($speaker->status = 1) selected  @endif @endisset>Enable</option>
                                    </select>
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
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"  data-default-file="{{ isset($speaker) ? $speaker->getFirstMediaUrl('image') : old('image')  }}" />
                                    @error('image')
                                        <span class="text-danger font-12" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('NewsFrom')"><i class="fas fa-redo"></i></button>

                                @isset($speaker)
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