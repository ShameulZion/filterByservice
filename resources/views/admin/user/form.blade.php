@extends('layouts.admin.master')

@section('title','Users')

@push('css')

@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ __((isset($user) ? 'Edit' : 'Create New') . ' User') }}</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.user.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="userFrom" method="POST" action="{{ isset($user) ? route('admin.user.update',$user->id) : route('admin.user.store') }}" enctype="multipart/form-data">
                @csrf
                @if (isset($user))
                    @method('PUT')
                @endif
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">User Info</h5>

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ $user->name ?? ''  }}" class="form-control @error('name') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="email" name="email" value="{{ $user->email ?? ''  }}" class="form-control @error('email') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Email" >
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password" placeholder="******" class="form-control @error('password') is-invalid @enderror" field-attributes="required autofocus" />
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Password</label>
                                    <input type="password" name="password_confirmation" placeholder="******" class="form-control @error('password_confirmation') is-invalid @enderror" field-attributes="required autofocus" />
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-4">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Select Role and Status</h5>

                                <div class="form-group">
                                    <label for="">Select Role</label>
                                    <select name="role" id="" class="form-control @error('role') is-invalid @enderror">
                                        <option value="0" selected disabled>Select Role</option>
                                        @foreach($roles as $key=>$role)
                                            <option value="{{ $role->id }}" @if (isset($user)) {{  $user->role_id == $role->id ? 'selected' : 'null'  }}  @endif >{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Avatar (Only Image are allowed)</label>  
                                    <input type="file" class="dropify @error('dropify') is-invalid @enderror" name="avatar"  data-default-file="{{ isset($user) ? asset('/media/user/'.$user->avatar) : ''  }}" />
                                    @error('avatar')
                                        <span class="text-danger font-12" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Status</label>
                                    <input type="checkbox" name="status" class="custom-switch" value="1" {{ isset($user->status) ? 'checked' : 'null'  }}>
                                </div>

                                <button type="button" class="btn btn-danger"  on-click="resetForm('userFrom')"><i class="fas fa-redo"></i></button>

                                @isset($user)
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Update</button>
                                @else
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create</button>
                                @endisset
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')

@endpush