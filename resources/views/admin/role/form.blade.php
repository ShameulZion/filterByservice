@extends('layouts.admin.master')

@section('title','Roles')

<style>
    .tree {
        margin: 0;
        width: 80%;
    }

    .tree ul {
        margin: 0;
        padding: 0;
        border-left: 1px dashed #dfdfdf;
    }


    .tree li {
        padding: 12px 18px;
        cursor: pointer;
        vertical-align: middle;
        background: #fff;
    }

.tree li:first-child {
  border-radius: 3px 3px 0 0;
}

.tree li:last-child {
  border-radius: 0 0 3px 3px;
}

.tree .active,
.active li {
  background: #efefef;
}

.tree label {
  cursor: pointer;
}

.tree input[type=checkbox] {
  margin: -2px 6px 0 0px;
}

.has > label {
  color: #000;
}

.tree .total {
  color: #e13300;
}
</style>
@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ isset($role) ? 'Edit' : 'Create New' }} Role</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.role.index') }}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-arrow-circle-left fa-w-20"></i>
                        </span>
                        Back to list
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <form id="roleFrom" role="form" method="POST" action="{{ isset($role) ? route('admin.role.update',$role->id) : route('admin.role.store') }}">
                    @csrf
                    @if (isset($role))
                        @method('PUT')
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">Manage Roles</h5>
                        <label for="">Role Name</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $role->name ?? old('name')  }}" placeholder="Enter role name" field-attributes="required autofocus">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <div class="text-left mt-4">
                            <h5 class="card-title d-flex align-items-center m-0">
                                <strong>Manage permissions for role</strong>                            
                                @error('permissions')
                                <p class="p-2">
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                </p>
                                @enderror
                                <div class="form-group m-0 ml-2">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="select-all">
                                        <label class="custom-control-label" for="select-all">Select All</label>
                                    </div>
                                </div>
                            </h5>
                        </div>
                        
                        <div class="treeview">
                            <ul class="tree">
                                @foreach($modules as $key => $module)
                                    <li class="has">
                                        <input type="checkbox" />
                                        <label>{{ $module->name }} <!-- <span class="total">()</span> --></label>
                                        <ul style="@if (isset($role)) display:block @else display:none @endif">
                                            @foreach($module->permissions as $key=>$permission)
                                                <li class="has">
                                                    <input type="checkbox" id="permission-{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]"
                                                    @if(isset($role))
                                                        @foreach($role->permissions as $rPermission)
                                                        {{ $permission->id == $rPermission->id ? 'checked' : '' }}
                                                        @endforeach
                                                    @endif
                                                    >
                                                    <label for="id="permission-{{ $permission->id }}">{{ $permission->name }} <!-- <span class="total">()</span> --></label>
                                                    <!-- <ul>
                                                        <li>
                                                            <input type="checkbox" name="subject[]" value="Analytical Biochemistry">
                                                            <label>Analytical Biochemistry</label>
                                                        </li>
                                                    </ul> -->
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <button type="button" class="btn btn-danger" onClick="resetForm('roleFrom')">
                            <i class="fas fa-redo"></i>
                            <span>Reset</span>
                        </button>

                        <button type="submit" class="btn btn-primary">
                            @isset($role)
                                <i class="fas fa-arrow-circle-up"></i>
                                <span>Update</span>
                            @else
                                <i class="fas fa-plus-circle"></i>
                                <span>Create</span>
                            @endisset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });

        $(document).on('click', '.tree label', function(e) {
            $(this).next('ul').fadeToggle();
            e.stopPropagation();
        });

        $(document).on('change', '.tree input[type=checkbox]', function(e) {
            $(this).siblings('ul').find("input[type='checkbox']").prop('checked', this.checked);
            $(this).parentsUntil('.tree').children("input[type='checkbox']").prop('checked', this.checked);
            e.stopPropagation();
        });

        $(document).on('click', 'button', function(e) {
            switch ($(this).text()) {
                case 'Collepsed':
                    $('.tree ul').fadeOut();
                    break;
                case 'Expanded':
                    $('.tree ul').fadeIn();
                    break;
                case 'Checked All':
                    $(".tree input[type='checkbox']").prop('checked', true);
                    break;
                case 'Unchek All':
                    $(".tree input[type='checkbox']").prop('checked', false);
                    break;
                default:
            }
        });
    </script>
@endpush