@extends('layouts.admin.master')

@section('title','Page')

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
                <div>{{ __('All Page') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.page.create') }}" class="btn-shadow btn btn-info">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        {{ __('News Page') }}
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
                            <th class="text-left">Title</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($pages as $page)
                                <tr>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="80" height="80" src="{{ isset($page) ? $page->getFirstMediaUrl('image') : ''  }}" alt="{{ $page->title }}">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $page->title }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        @if ($page->status)
                                            <div class="badge badge-success">Enable</div>
                                        @else
                                            <div class="badge badge-danger">Disable</div>
                                        @endif
                                    </td>
                                    <td class="text-left">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.page.edit',$page->id) }}"><i
                                                class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $page->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $page->id }}"
                                              action="{{ route('admin.page.destroy',$page->id) }}" method="POST"
                                              style="display: none;">
                                            @csrf()
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @if(count($page->childs))
                                    @foreach($page->childs as $child)
                                        <tr>
                                            <td>
                                                <div class="widget-content p-0">
                                                    <div class="widget-content-wrapper">
                                                        <div class="widget-content-left mr-3">
                                                            <div class="widget-content-left">
                                                                <img width="80" height="80" src="{{ isset($page) ? $child->getFirstMediaUrl('image') : ''  }}" alt="{{ $page->title }}">
                                                            </div>
                                                        </div>
                                                        <div class="widget-content-left flex2">
                                                            <div class="widget-heading">{{ $page->title }} > {{ $child->title }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-left">
                                                @if ($child->status)
                                                    <div class="badge badge-success">Enable</div>
                                                @else
                                                    <div class="badge badge-danger">Disable</div>
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                <a class="btn btn-info btn-sm" href="{{ route('admin.page.edit',$child->id) }}"><i
                                                        class="fas fa-edit"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="deleteData({{ $child->id }})">
                                                    <i class="fas fa-trash-alt"></i>
                                                    <span>Delete</span>
                                                </button>
                                                <form id="delete-form-{{ $child->id }}"
                                                    action="{{ route('admin.page.destroy',$child->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf()
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
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