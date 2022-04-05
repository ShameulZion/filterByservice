@extends('layouts.backend.master')

@section('title','User')

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
                <div>{{ __((isset($page) ? 'Edit' : 'Create New') . ' Page') }}</div>
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
            <form role="form" id="userFrom" method="POST" action="{{ isset($page) ? route('admin.page.update',$page->id) : route('admin.page.store') }}" enctype="multipart/form-data">
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
                                    <label for="">Page Title <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" name="title" value="{{ $page->title ?? ''  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">SEO Keyword</label>
                                    <input type="text" name="slug" value="{{ $page->slug ?? ''  }}" class="form-control @error('slug') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Slug" >
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="editor" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{ $page->description ?? ''  }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Sort Order</label>
                                    <input type="text" name="sort_order" value="{{ $page->sort_order ?? ''  }}" class="form-control @error('sort_order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Sort Order" >
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
                                    <select name="parent_id" class="form-control  @error('parent_id') is-invalid @enderror">
                                        <option value="0" selected>Parent Page</option>
                                        @foreach($pages as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Featured Image (Only Image are allowed)</label>
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"  data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image') : ''  }}" />
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Status</label>
                                        <input type="checkbox" name="status" value="1" class="custom-switch" value="{{ isset($page) ? $page->status : 'null'  }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Top</label>
                                        <input type="checkbox" name="top" value="1" class="custom-switch" value="{{ isset($page) ? $page->top : 'null'  }}">
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('userFrom')"><i class="fas fa-redo"></i></button>

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
            </form>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: false
  });
</script>
@endpush