@extends('layouts.admin.master')

@section('title','Slider')

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
                <div>{{ __('All Slider') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="#" class="btn-shadow btn btn-info" data-toggle="modal" data-target="#exampleModal">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Add Slider') }}
                    </a>
                    
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <form class="modal-content" method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Slider</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="">Slider Name</label>
                                        <input type="text" name="slider_name" class="form-control" >
                                    </div>

                                    <div class="form-group">
                                        <label for="">Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Enable</option>
                                            <option value="0">Disable</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-left">#</th>
                            <th class="text-left">Name</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($sliders as $key=>$slider)
                                <tr>
                                    <td class="text-left text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $slider->slider_name }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        @if ($slider->status)
                                            <div class="badge badge-success">Enable</div>
                                        @else
                                            <div class="badge badge-danger">Disable</div>
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.slider.slide-list',$slider->id) }}"><i
                                                class="fas fa-plus"></i>
                                            <span>Add Slider</span>
                                        </a>

                                        <a class="btn btn-info btn-sm" href="#" data-toggle="modal" data-target="#exampleModal-{{ $slider->id }}"><i
                                                class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        @if (isset($slider))
                                            <div class="modal fade" id="exampleModal-{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <form class="modal-content" method="POST" action="{{ route('admin.slider.store') }}" enctype="multipart/form-data">
                                                    @csrf
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Slider</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="">Slider Name</label>
                                                                <input type="text" name="slider_name" class="form-control" value="{{ $slider->slider_name ?? old('slider_name') }}">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="">Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="1" @isset($slider) @if($slider->status = 1) selected  @endif @endisset>Enable</option>
                                                                    <option value="0" @isset($slider) @if($slider->status = 0) selected  @endif @endisset>Disable</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif

                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $slider->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $slider->id }}"
                                              action="{{ route('admin.slider.destroy',$slider->id) }}" method="POST"
                                              style="display: none;">
                                            @csrf()
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            // Datatable
            $("#datatable").DataTable();
        });
    </script>
@endpush