@extends('layouts.admin.master')

@section('title','Pages')

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
                <div>{{ __((isset($page) ? 'Edit' : 'Create') . ' Page') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.page.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="NewsFrom" method="POST" action="{{ isset($page) ? route('admin.page.update',$page->id) : route('admin.page.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($page))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Page Info</h5>

                                <div class="form-group">
                                    <label for="">Title <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" name="title" value="{{ $page->title ?? old('title')  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="editor1" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{ $page->description ?? old('description')  }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Meta Title <small class="text-danger"><strong>*</strong></small></label>
                                            <input type="text" name="meta_title" value="{{ $page->meta_title ?? old('meta_title')  }}" class="form-control @error('meta_title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Meta Title" >
                                            @error('meta_title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Meta Keywords</small></label>
                                            <input type="text" name="meta_keyword" value="{{ $page->meta_keyword ?? old('meta_keyword')  }}" class="form-control @error('meta_keyword') is-invalid @enderror" field-attributes="required autofocus" placeholder="Meta Keywords" >
                                            @error('meta_keyword')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Description</small></label>
                                    <textarea name="meta_description" placeholder="Meta Description" class="form-control @error('meta_description') is-invalid @enderror">{{ $page->meta_description ?? old('meta_description')  }}</textarea>
                                    @error('meta_description')
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
                                    <label for="">Image</label>
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image[]" multiple />
                                    @error('image')
                                        <span class="text-danger font-12" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Sort Order</label>
                                    <input type="text" name="sort_order" value="{{ $page->sort_order ?? old('sort_order')  }}" class="form-control @error('sort_order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Sort Order" >
                                    @error('sort_order')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="parent_id">Parent Page</label>
                                    <select name="parent_id" class="form-control @error('parent_id') is-invalid @enderror">
                                        <option value="0">Select Parent</option>
                                        @foreach($pages as $parentpage)
                                            <option value="{{ $parentpage->id }}" @isset($page) @if($page->parent_id == $parentpage->id) selected  @endif @endisset>{{ $parentpage->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" @isset($page) @if($page->status = 1) selected  @endif @endisset>Enable</option>
                                        <option value="0" @isset($page) @if($page->status = 0) selected  @endif @endisset>Disable</option>
                                    </select>
                                </div>

                                <div class="form-group m-2 row">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="select-all" name="top" {{ isset($page->top) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="select-all">Top</label>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('NewsFrom')"><i class="fas fa-redo"></i></button>

                                @isset($page)
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
                <div class="row">
                    @isset($page)
                        @foreach($page->getMedia('image') as $media)
                            <div class="col-md-3">
                                <div class="main-card mb-3 card">
                                    <div class="card-body">
                                        <img src="{{ isset($page) ? $media->getUrl() : old('image')  }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endisset
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#editor',
    
  });
  tinymce.init({
    selector: 'textarea#editor1',
    plugins: 'table,code',
    menubar: true,
    table_appearance_options: false
  });
</script>
@endpush