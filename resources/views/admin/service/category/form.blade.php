@extends('layouts.admin.master')

@section('title','Category')

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
                <div>{{ __((isset($category) ? 'Edit' : 'Create New') . ' Category') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('category.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="userFrom" method="POST" action="{{ isset($category) ? route('category.update',$category->id) : route('category.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Category Info</h5>

                                <div class="form-group">
                                    <label for="">Category Name</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Category Name" name="title" value="{{ $category->title ?? old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Category Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" placeholder="Category Slug" name="slug" value="{{ $category->slug ?? old('slug') }}" readonly>
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Category Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ $category->description ?? old('description') }}</textarea>
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
                                    <lebel for="">Select Parent Category</lebel>
                                    <select name="parent_id" class="form-control  select @error('parent_id') is-invalid @enderror">
                                        <option value="0" selected>Select Parent Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if (isset($category)) {{ $category->parent_id == $category->id ? 'selected' : ''  }} @endif >{{ $category->title }}</option>
                                            @if(count($category->childs))
                                                @foreach($category->childs as $child)
                                                    <option value="{{ $child->id }}" @if (isset($category)) {{ $category->parent_id == $child->id ? 'selected' : ''  }} @endif > -- {{ $child->title }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Select Department</label>
                                    <select name="department_id" class="form-control select @error('department_id') is-invalid @enderror">
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" @if (isset($category)) {{ $category->department_id == $department->id ? 'selected' : ''  }} @endif>{{ $department->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Image</label>
                                    <input type="file" name="image" class="dropify @error('image') is-invalid @enderror" data-default-file="{{ isset($category) ? asset('/media/category/'.$category->image) : '' }}" />
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">                                    
                                    <label for="">Select Filter Profile</label>
                                    <select name="filter_profiles[]" class="form-control select @error('filter_profiles') is-invalid @enderror" data-placeholder="Select a Filter *" data-allow-clear="true">
                                        @foreach($filter_profiles as $filter_profile)
                                            <option value="{{ $filter_profile->id }}" @if (isset($category)) @foreach($category->filterProfiles as $filterProfileCategory) {{ $filterProfileCategory->id == $category->id ? 'selected' : '' }} @endforeach @endif>{{ $filter_profile->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('filter_profiles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <input type="checkbox" name="status" value="1" class="custom-switch" value="1" {{ isset($category->status) ? 'checked' : ''  }} />
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('userFrom')"><i class="fas fa-redo"></i></button>
                                @if (isset($category))
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Update</button>
                                @else
                                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Create</button>
                                @endif
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

    $('#title').change(function(e){
        $.get('{{ route('category.checkSlug')}}',
            { 'title': $(this).val() },
            function(data){
                $('#slug').val(data.slug);
            }
        );
    })
</script>
@endpush