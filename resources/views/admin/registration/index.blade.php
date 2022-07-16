@extends('layouts.admin.master')

@section('title','Registration Form')

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
                <div>{{ __('All Registration') }}</div>
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
                            <th class="text-left">Company's Name</th>
                            <th class="text-left">Contact Person</th>
                            <th class="text-left">Mobile</th>
                            <th class="text-left">Email</th>
                            <th class="text-left">Country</th>
                            <th class="text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($registrations as $key=>$registration)
                                <tr>
                                    <td class="text-left text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $registration->companyName }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $registration->contactName }}</td>
                                    <td>{{ $registration->mobile }}</td>
                                    <td>{{ $registration->email }}</td>
                                    <td>{{ $registration->country }}</td>
                                    <td class="text-left">
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $registration->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $registration->id }}"
                                              action="{{ route('admin.registration.destroy',$registration->id) }}" method="POST"
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