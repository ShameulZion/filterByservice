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
                <div>{{ __((isset($filter) ? 'Edit' : 'Create New') . ' Filter') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('filter.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="userFrom" method="POST" action="{{ isset($filter) ? route('filter.update',$filter->id) : route('filter.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($filter))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Filter Info</h5>

                                <div class="form-group">
                                    <label for="">Label</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Label" name="title" value="{{ $filter->title ?? old('title') }}">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div> 

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Filter Group Name</label>
                                        <input type="text" class="form-control @error('group_name') is-invalid @enderror" id="group_name" placeholder="Filter Group Name" name="group_name" value="{{ $filter->group_name ?? old('group_name') }}">
                                        @error('group_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Sort Order</label>
                                        <input type="text" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" placeholder="Sort Order" name="sort_order" value="{{ $filter->sort_order ?? old('sort_order') }}">
                                        @error('sort_order')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Filter Profile</h5>
                                <div class="form-group">                                    
                                    <label for="">Filter Profile</label>
                                    <select name="filterProfiles[]" class="form-control select @error('filterProfiles') is-invalid @enderror" multiple="multiple" data-placeholder="Select an option *" data-allow-clear="true">
                                        <option value="0" disabled>Default Tags </option>
                                        @foreach($filterProfiles as $filter_profile)
                                            <option value="{{ $filter_profile->id }}" @if (isset($filter)) @foreach($filter->filterProfiles as $filterProfile) {{ $filterProfile->id == $filter_profile->id ? 'selected' : '' }} @endforeach @endif>{{ $filter_profile->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('filterProfiles')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('userFrom')"><i class="fas fa-redo"></i></button>
                                @if (isset($filter))
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Update</button>
                                @else
                                    <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Create</button>
                                @endif
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="align-middle mb-0 table table-hover">
                                        <thead>
                                            <tr>
                                                <td>Filter Name</td>
                                                <td>Sort Order</td>
                                                <td>
                                                    <a class="btn btn-primary text-white add_filter_row"><i class="fa fa-plus-circle"></i></a>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (isset($filter))
                                                @foreach($filter->filterGroups as $filterGroup)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="filter_name[]" value="{{ $filterGroup->filter_name }}" placeholder="Filter Name" class="form-control @error('filter_name') is-invalid @enderror">
                                                        @error('filter_name')
                                                            <p class="p-2">
                                                                <span class="text-danger" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            </p>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input type="text" name="order[]" placeholder="Sort Order" value="{{ $filterGroup->order }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <a class="btn btn-danger text-white remove_filter_row"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
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
        menubar: true
    });

    $(document).ready(function(){
	    var addButton = $('.add_filter_row'); //Add button selector
	    var wrapper = $('tbody'); //Input field wrapper
	    var fieldHTML = '<tr><td><input type="text" name="filter_name[]" placeholder="Filter Name" class="form-control @error('filter_name') is-invalid @enderror">@error('filter_name')<p class="p-2"><span class="text-danger" role="alert"><strong>{{ $message }}</strong></span></p>@enderror</td><td><input type="text" name="order[]" placeholder="Sort Order" class="form-control"></td><td><a class="btn btn-danger text-white remove_filter_row"><i class="fa fa-trash"></i></a></td></tr>';
	    
	    $(addButton).click(function(){
            $(wrapper).append(fieldHTML);
	    });
	    $(wrapper).on('click', '.remove_filter_row', function(e){
	        e.preventDefault();
	        $(this).parents('tr').remove();
	    });
	});
</script>
@endpush