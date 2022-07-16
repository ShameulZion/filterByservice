@extends('layouts.admin.master')

@section('title','News')

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
                <div>Send Mail</div>
            </div>
            <div class="page-title-actions">
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.contact.index') }}" class="btn-shadow btn btn-danger">
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
            <form role="form" id="NewsFrom" method="POST" action="{{ route('admin.contact.update',$contact->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Contact Info</h5>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Name <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="text" name="name" value="{{ $contact->name ?? old('name')  }}" class="form-control @error('name') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Name" >
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Email <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="email" name="email" value="{{ $contact->email ?? old('email')  }}" class="form-control @error('email') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Email" >
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-6">
                                        <label for="">Phone <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="text" name="phone" value="{{ $contact->phone ?? old('namephone')  }}" class="form-control @error('phone') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Phone" >
                                        @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label for="">Subject <small class="text-danger"><strong>*</strong></small></label>
                                        <input type="subject" name="subject" value="{{ $contact->subject ?? old('subject')  }}" class="form-control @error('subject') is-invalid @enderror" field-attributes="required autofocus" placeholder="Enter Subject" >
                                        @error('subject')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="">Enquiry</label>
                                    <textarea name="enquiry" id="editor" placeholder="enquiry" class="form-control @error('enquiry') is-invalid @enderror">{{ $contact->enquiry ?? old('enquiry')  }}</textarea>
                                    @error('enquiry')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="">Reply</label>
                                    <textarea name="reply" id="editor1" placeholder="Reply" class="form-control @error('reply') is-invalid @enderror">{{ $contact->reply ?? old('reply')  }}</textarea>
                                    @error('reply')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-arrow-circle-up"></i> Reply</button>
                                </div>
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
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: true
  });
  tinymce.init({
    selector: 'textarea#editor1',
    menubar: true
  });
</script>
@endpush