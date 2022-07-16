@extends('layouts.admin.master')

@section('title','News')

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
                <div>{{ __((isset($news) ? 'Edit' : 'Create New') . ' News') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.news.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="NewsFrom" method="POST" action="{{ isset($news) ? route('admin.news.update',$news->id) : route('admin.news.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($news))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">News Info</h5>

                                <div class="form-group">
                                    <label for="">Title <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" name="title" value="{{ $news->title ?? old('title')  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Introduction Text</label>
                                    <textarea name="blurb" id="editor" placeholder="Introduction Text" class="form-control @error('blurb') is-invalid @enderror">{{ $news->blurb ?? old('blurb')  }}</textarea>
                                    @error('blurb')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Description</label>
                                    <textarea name="description" id="editor1" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{ $news->description ?? old('description')  }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Video URL</label>
                                    <input type="url" name="video_url" value="{{ $news->video_url ?? old('video_url')  }}" class="form-control @error('video_url') is-invalid @enderror" field-attributes="required autofocus" placeholder="Video URL" >
                                    @error('video_url')
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
                                    <label for="">Featured Image (Only Image are allowed)</label>
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"  data-default-file="{{ isset($news) ? $news->getFirstMediaUrl('image') : old('image')  }}" />
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label for="">Meta Title <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" name="meta_title" value="{{ $news->meta_title ?? old('meta_title')  }}" class="form-control @error('meta_title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Meta Title" >
                                    @error('meta_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Description</small></label>
                                    <textarea name="meta_description" placeholder="Meta Description" class="form-control @error('meta_description') is-invalid @enderror">{{ $news->meta_description ?? old('meta_description')  }}</textarea>
                                    @error('meta_description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Meta Keywords</small></label>
                                    <input type="text" name="meta_keyword" value="{{ $news->meta_keyword ?? old('meta_keyword')  }}" class="form-control @error('meta_keyword') is-invalid @enderror" field-attributes="required autofocus" placeholder="Meta Keywords" >
                                    @error('meta_keyword')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="1" @isset($news) @if($news->status = 1) selected  @endif @endisset>Enable</option>
                                        <option value="0" @isset($news) @if($news->status = 0) selected  @endif @endisset>Disable</option>
                                    </select>
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('NewsFrom')"><i class="fas fa-redo"></i></button>

                                @isset($news)
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
    menubar: true
  });
  tinymce.init({
    selector: 'textarea#editor1',
    menubar: true
  });
</script>
@endpush