@extends('layouts.admin.master')

@section('title','Module')

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
                <div>{{ __('All Module') }}</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="table-responsive">
                    <table class="align-middle mb-0 table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="text-left">Module Name</th>
                            <th class="text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Banner</td>
                                <td>
                                    <a href="{{ route('admin.module.banner.index') }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Slideshow</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Exhibitors</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Speaker</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>Testimonials</td>
                                <td>
                                    <a href="" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush