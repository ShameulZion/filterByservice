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
                <div>{{ __((isset($banner) ? 'Edit' : 'Create New') . ' Slide') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.banner.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        {{ __('Back to Slider List') }}
                    </a>
                    <a class="btn btn-info btn-sm" href="{{ route('admin.banner.item.create-banner',$banner->id) }}">
                        <i class="fas fa-plus"></i>
                        <span>Add Slide</span>
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
                            <th class="text-left">#</th>
                            <th class="text-left">Title</th>
                            <th class="text-left">Status</th>
                            <th class="text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($items as $key=>$item)
                                <tr>
                                    <td class="text-left text-muted">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-3">
                                                    <div class="widget-content-left">
                                                        <img width="80" height="80" src="{{ isset($item) ? $item->getFirstMediaUrl('image') : ''  }}" alt="{{ $item->title }}">
                                                    </div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">{{ $item->title }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left">
                                        <div class="widget-heading">{{ $item->sort_order }}</div>
                                    </td>
                                    <td class="text-left">
                                        <a class="btn btn-info btn-sm" href="{{ route('admin.banner.item.edit-banner',['id'=>$banner->id,'itemId'=>$item->id]) }}"><i
                                                class="fas fa-edit"></i>
                                            <span>Edit</span>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm"
                                                onclick="deleteData({{ $item->id }})">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>Delete</span>
                                        </button>
                                        <form id="delete-form-{{ $item->id }}"
                                              action="{{ route('admin.banner.item.destroy-banner',['id'=>$banner->id,'itemId'=>$item->id]) }}" method="POST"
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
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    menubar: true
  });
</script>
@endpush