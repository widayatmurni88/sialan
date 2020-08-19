@extends('admin.layout.base')

@section('content')
@include('admin.layout.nav')
@include('admin.layout.sidebar', ['menu' => 'myprofile'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profil Saya</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header border-0">
              <h3 class="card-title"><i class="fa fa-user mr-3"></i> Update Profile</h3>
            </div>
            <div class="card-body">

              @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              @if ($data != '')
                  
                <form action="{{ route('postupdatemyprofile')}}" method="post">

                  {{ csrf_field() }}

                  <div class="form-group row">
                    <label for="email" class="form-label col-md-3">Email</label>
                    <div class="col-md-9">
                      <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" value="{{ $data->email}}" autofocus>

                      @if ($errors->has('email'))
                        <div class="invalid-feedback">
                          {{ $errors->first('email')}}
                        </div>
                      @endif

                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="pwd" class="form-label col-md-3">Password</label>
                    <div class="col-md-9">
                      <input type="password" name="password" id="pwd" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}">
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="pwd" class="form-label col-md-3">Konfirm Password</label>
                    <div class="col-md-9">
                      <input type="password" name="password_confirmation" id="pwd" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}">
                    </div>
                  </div>

                  <div class="form-group row mt-4">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-success btn-round float-right"><i class="fa fa-save mr-3"></i>Update</button>
                    </div>
                  </div>
                  
                </form>

              @endif

              
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection
