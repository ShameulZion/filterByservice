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
                <div>{{ __('All Category') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('category.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('Create Category') }}
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
                            <th>Category Name</th>
                            <th class="text-center">Category Slug</th>
                            <th class="text-center">Department Name</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $key=>$category)
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                @if(!empty($category->image))
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="80" height="80" src="{{ asset('/media/category/'.$category->image) }}" alt="{{ $category->title }}">
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $category->title }}</div>
                                                    <div class="widget-subheading opacity-7">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $category->slug }}</td>
                                    <td class="text-center">{{ $category->department->title }}</td>
                                    <td class="text-center">
                                        <a class="btn btn-info btn-sm" href="{{ route('category.edit',$category->id) }}"><i
                                                class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $category->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $category->id }}"
                                              action="{{ route('category.destroy',$category->id) }}" method="POST"
                                              style="display: none;">
                                            @csrf()
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @foreach($category->childs as $key=>$child)
                                    <tr>>
                                        <td>{{ $category->title }} > {{ $child->title }}</td>
                                        <td class="text-center">{{ $child->slug }}</td>
                                        <td class="text-center">
                                            <a class="btn btn-info btn-sm" href="{{ route('category.edit',$child->id) }}"><i
                                                    class="fas fa-edit"></i>
                                                <span>Edit</span>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="deleteData({{ $child->id }})">
                                                <i class="fas fa-trash-alt"></i>
                                                <span>Delete</span>
                                            </button>
                                            <form id="delete-form-{{ $child->id }}"
                                                action="{{ route('category.destroy',$child->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf()
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
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