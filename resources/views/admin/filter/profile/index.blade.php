@extends('layouts.admin.master')

@section('title','Filter Profile')

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
                <div>{{ __('All Filter Profile') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('filterProfile.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Create Filter Profile') }}
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
                            <th>Name</th>
                            <th class="text-center">Created time</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($filterProfiles as $key=>$filter_profile)
                                <tr>
                                    <td>{{ $filter_profile->title }}</td>
                                    <td class="text-center">{{ $filter_profile->created_at->toDateString() }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('filterProfile.edit',$filter_profile->id) }}"><i
                                                class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $filter_profile->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $filter_profile->id }}"
                                              action="{{ route('filterProfile.destroy',$filter_profile->id) }}" method="POST"
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