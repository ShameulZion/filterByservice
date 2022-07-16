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
                <div>{{ __((isset($sliderItem) ? 'Edit' : 'Create New') . ' Slide') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.slider.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to Slider List') }}
                    </a>
                    <a class="btn-shadow btn btn-danger" href="{{ route('admin.slider.slide-list',$slider->id) }}">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Slid List') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form role="form" id="NewsFrom" method="POST" action="{{ isset($sliderItem) ? route('admin.slider.item.slide-update',['id'=>$slider->id,'itemId'=>$sliderItem->id]) : route('admin.slider.item.slide-store',$slider->id) }}" enctype="multipart/form-data">
                @csrf
                @if (isset($sliderItem))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Slide Info</h5>
                                <div class="form-group">
                                    <label for="">Title <small class="text-danger"><strong>*</strong></small></label>
                                    <input type="text" name="title" value="{{ $sliderItem->title ?? old('title')  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Button Text <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="text" name="buttonText" value="{{ $sliderItem->buttonText ?? old('buttonText')  }}" class="form-control @error('buttonText') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Designation" >
                                        @error('buttonText')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Button Url</label>
                                        <input type="text" name="buttonUrl" value="{{ $sliderItem->buttonUrl ?? old('buttonUrl')  }}" class="form-control @error('buttonUrl') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Facebook Url" >
                                        @error('buttonUrl')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="0" @isset($sliderItem) @if($sliderItem->status = 0) selected  @endif @endisset>Disable</option>
                                        <option value="1" @isset($sliderItem) @if($sliderItem->status = 1) selected  @endif @endisset>Enable</option>
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
                                    <input type="file" class="dropify @error('image') is-invalid @enderror" name="image"  data-default-file="{{ isset($sliderItem) ? $sliderItem->getFirstMediaUrl('image') : old('image')  }}" />
                                    @error('image')
                                        <span class="text-danger font-12" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('NewsFrom')"><i class="fas fa-redo"></i></button>

                                @isset($sliderItem)
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
<script>
    $(document).ready(function(){
	    var maxField = 20; //Input fields increment limitation
	    var addButton = $('.add_button'); //Add button selector
	    var wrapper = $('tbody'); //Input field wrapper
	    var fieldHTML = '<tr><td><input type="text" name="title[]" value="{{ $banner->title ?? old('title')  }}" class="form-control @error('title') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Title" >@error('title')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td><input type="text" name="url[]" value="{{ $banner->url ?? old('url')  }}" class="form-control @error('url') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter URL" >@error('url')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td><input type="file" class="dropify @error('image') is-invalid @enderror" name="image[]"  data-default-file="{{ isset($banner) ? $banner->getFirstMediaUrl('image') : old('image')  }}" width="100" />@error('image')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td><input type="text" name="sort_order[]" value="{{ $testimonial->sort_order ?? old('sort_order')  }}" class="form-control @error('sort_order') is-invalid @enderror" field-attributes="required autofocus" placeholder="Sort Order" >@error('sort_order')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror</td><td><button type="button" class="btn btn-danger remove_button"><i class="fa fa-trash"></i></button></td></tr>'; //New input field html 
	    var x = 1; //Initial field counter is 1
	    $(addButton).click(function(){ //Once add button is clicked
	        if(x < maxField){ //Check maximum number of input fields
	            x++; //Increment field counter
	            $(wrapper).append(fieldHTML); // Add field html
	        }
	    });
	    $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
	        e.preventDefault();
	        $(this).parents('tr').remove(); //Remove field html
	        x--; //Decrement field counter
	    });
	});
</script>
@endpush