@extends('layouts.admin.master')

@section('title','Tag')

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
                <div>{{ __((isset($tag) ? 'Edit' : 'Create New') . ' Tag') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('tag.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="userFrom" method="POST" action="{{ isset($tag) ? route('tag.update',$tag->id) : route('tag.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Tag Info</h5>

                                <div class="form-group">
                                    <label for="">Tag Name <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" id="title" name="title" value="{{ $tag->title ?? ''  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Tag Slug <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" id="slug" name="slug" value="{{ $tag->slug ?? ''  }}" class="form-control @error('slug') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter slug" >
                                    @error('slug')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="editor" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{ $tag->description ?? ''  }}</textarea>
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
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="" class="card-title">Status</label>
                                        <input type="checkbox" name="status" value="1" class="custom-switch" value="1" {{ isset($tag->status) ? 'checked' : ''  }} />
                                    </div>
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('userFrom')"><i class="fas fa-redo"></i></button>

                                @isset($tag)
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

    $('#title').change(function(e){
        $.get('{{ route('tag.checkSlug')}}',
            { 'title': $(this).val() },
            function(data){
                $('#slug').val(data.slug);
            }
        );
    })
</script>
@endpush