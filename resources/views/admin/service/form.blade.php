@extends('layouts.admin.master')

@section('title','Tag')

@push('css')
    <style>
        .service-inner-child{
            border: 1px solid gray;
            padding: 5px 15px 3px 15px;
            position: relative;
            margin: 10px 0;
        }
        .service-inner-child a {
            position: absolute;
            top: 0;
            right: 0;
            border-radius: 0;
            border-bottom-left-radius: 4px;
            padding: 0;
            height: 25px;
            width: 25px;
            line-height: 25px;
            margin: 0;
            text-align: center;
            font-size: 10px;
            font-weight: 700;
            z-index: 99999;
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
                <div>{{ __('Create New Service') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('service.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="userFrom" method="POST" action="{{ isset($service) ? route('service.update',$service->id) : route('service.store') }}" enctype="multipart/form-data" multiple>
                @csrf
                @if (isset($service))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Service Info</h5>

                                <div class="form-group">
                                    <label for="">Service Title <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter title" value="{{ $service->title ?? old('title')  }}" />
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Service Slug <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" id="slug"  name="slug" class="form-control @error('slug') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Slug" value="{{ $service->slug ?? old('slug')  }}" />
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Short Description</label>
                                    <textarea name="short_description" id="editor" placeholder="Description" class="form-control @error('short_description') is-invalid @enderror">{!! $service->short_description ?? old('short_description')  !!}</textarea>
                                    @error('short_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Order Button</label>
                                        <input type="url" name="order" class="form-control @error('order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Fiverr Order Url here" value="{{ $service->order ?? old('order')  }}" />
                                        @error('order')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Envato Button</label>
                                        <input type="url" name="envato" class="form-control @error('envato') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Envato Order Url here" value="{{ $service->envato ?? old('envato')  }}" />
                                        @error('envato')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Preview Button </label>
                                        <input type="url" name="preview" class="form-control @error('preview') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Preview Url here" value="{{ $service->preview ?? old('preview')  }}" />
                                        @error('preview')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label for="">Long Description</label>
                                    <textarea name="long_description" id="editor" placeholder="Long Description" class="form-control @error('long_description') is-invalid @enderror">{!! $service->long_description ?? old('long_description')  !!}</textarea>
                                    @error('long_description')
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
                                <div class="form-group">
                                    <label for="">Parent Category</label>
                                    <select name="category_id" class="form-control select @error('category_id') is-invalid @enderror">
                                        <option value="0" selected disabled>Select a Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if (isset($service)) {{ $service->category_id == $category->id ? 'selected' : ''  }} @endif>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                

                                <div class="form-group">                                    
                                    <label for="">Select Category</label>
                                    <select name="categories[]" class="form-control select @error('categories') is-invalid @enderror" multiple="multiple" data-placeholder="Select an option *" data-allow-clear="true">
                                        <option value="0" disabled>Default Tags </option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" @if (isset($service)) @foreach($service->categories as $serviceCategory) {{ $serviceCategory->id == $category->id ? 'selected' : '' }} @endforeach @endif>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('categories')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">                                    
                                    <label for="">Select Tags</label>
                                    <select name="tags[]" class="form-control select @error('tags') is-invalid @enderror" multiple="multiple" data-placeholder="Select an option *" data-allow-clear="true">
                                        <option value="0" disabled>Default Tags </option>
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}"  @if (isset($service)) @foreach($service->tags as $serviceTag) {{ $serviceTag->id == $tag->id ? 'selected' : '' }} @endforeach @endif>{{ $tag->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('tags')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Featured Image (Only Image are allowed) <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="file" class="dropify @error('featured_image') is-invalid @enderror" data-default-file="{{ isset($service) ? asset('/media/service/'.$service->featured_image) : '' }}" name="featured_image" />
                                    @error('featured_image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">                                    
                                    <label for="">Select Filter Profile</label>
                                    <select name="filter_profiles[]" id="filter_profile" class="form-control select @error('filter_profiles') is-invalid @enderror" data-placeholder="Select a Filter *" data-allow-clear="true">
                                        @foreach($filter_profiles as $filter_profile)
                                            <option value="{{ $filter_profile->id }}" @if (isset($service)) @foreach($service->filterProfiles as $filterProfileService) {{ $filterProfileService->id == $service->id ? 'selected' : '' }} @endforeach @endif>{{ $filter_profile->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('filter_profiles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    
                                    <input type="checkbox" name="status" value="1" class="custom-switch" id="status" @isset($service) {{ $service->status ? 'checked' : ''  }} @endisset />
                                    <label for="status">Status</label>
                                    
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('userFrom')"><i class="fas fa-redo"></i></button>

                                @isset($service)
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Update</button>
                                @else
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</button>
                                @endisset
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Filter Option</h5>

                                <div id="serviceFilter">
                                    
                                </div>
                            </div>
                        </div>
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
        menubar: false
    });
    
    $('#title').change(function(e){
        $.get('{{ route('service.checkSlug')}}',
            { 'title': $(this).val() },
            function(data){
                $('#slug').val(data.slug);
            }
        );
    });

    $('#filter_profile').on('change',function(e){
        
        var filter_profile_id = e.target.value;

        // ajax
        $.get('/service/filter?filter_profile_id=' + filter_profile_id, function(data){
            $('#serviceFilter').empty();
            $.each(data,function(index, filterGroupObj){
                $('#serviceFilter').append('<div class="row"><div class="col-md-2"><label for="">'+filterGroupObj.group_name+'</label></div><div class="col-md-8"><div class="form-group"><input type="checkbox" name="status" value="'+filterGroupObj.id+'" class="custom-switch" id="status" /><label for="status">'+filterGroupObj.filter_name+'</label></div></div></div>');
            });
        });
    });

</script>
@endpush