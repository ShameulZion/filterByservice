@extends('layouts.admin.master')

@section('title','Service')

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
                <div>{{ __('All Service') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('service.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Create Service') }}
                    </a>
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
                            <th>id</th>
                            <th>Title</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($services as $key=>$service)
                                <tr>
                                    <th>{{ $key+1 }}</th>
                                    <td>
                                    <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    @if(!empty($service->featured_image))
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img width="80" height="80" src="{{ asset('/media/service/'.$service->featured_image) }}" alt="{{ $service->title }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $service->title }}</div>
                                                    <!-- <div class="widget-subheading opacity-7">
                                                        @if ($service->role)
                                                            <span class="badge badge-info">{{ $service->role->name }}</span>
                                                        @else
                                                            <span class="badge badge-danger">No role found :(</span>
                                                        @endif
                                                    </div> -->
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $service->category->title }}</td>
                                    <td class="text-center">
                                        @if ($service->status)
                                            <span class="badge badge-info">Enabled</span>
                                        @else
                                            <span class="badge badge-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-warning btn-sm" href="{{ route('service.show',$service->id) }}"><i
                                                class="fas fa-eye"></i>
                                            <span>Show</span>
                                        </a>
                                        <a class="btn btn-info btn-sm" href="{{ route('service.edit',$service->id) }}"><i
                                                class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData({{ $service->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $service->id }}" action="{{ route('service.destroy',$service->id) }}" method="POST" style="display: none;">
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