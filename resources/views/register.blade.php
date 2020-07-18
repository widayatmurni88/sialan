@extends('baseLayout')
@section('content')
<div class="container mt-2">
  <div class="row">
    <div class="col-md-10 mx-auto">
      <div class="card">
        <div class="card-header">
          <b class="card-title">
            <span><i class="fa fa-user mr-2"></i></span>
            Registrasi User
          </b>
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

          <form class="form-horizontal" action="{{ route('postregister')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group row">
              <label for="nidn" class="control-label col-md-3">NIDN</label>
              <div class="col-md-9">
                <input type="text" name="nidn" id="nidn" class="form-control {{ $errors->has('nidn') ? 'is-invalid' : '' }}" value="{{ old('nidn')}}" required autofocus>
                @if ($errors->has('nidn'))
                  <div class="invalid-feedback">
                    {{ $errors->first('nidn')}}
                  </div>
                @endif
              </div>
            </div>
            
            <div class="form-group row">
              <label for="name" class="control-label col-md-3">Nama Lengkap</label>
              <div class="col-md-9">
                <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" required>
                @if ($errors->has('name'))
                  <div class="invalid-feedback">
                    {{ $errors->first('name')}}
                  </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="control-label col-md-3">Email</label>
              <div class="col-md-9">
                <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" required>
                @if ($errors->has('email'))
                  <div class="invalid-feedback">
                    {{ $errors->first('email')}}
                  </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="control-label col-md-3">Password</label>
              <div class="col-md-9">
                <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" required>
                @if ($errors->has('password'))
                  <div class="invalid-feedback">
                    {{ $errors->first('password')}}
                  </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="control-label col-md-3">Password Konfirmasi</label>
              <div class="col-md-9">
                <input type="password" name="password_confirmation" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}">
                @if ($errors->has('password'))
                  <div class="invalid-feedback">
                    {{ $errors->first('password')}}
                  </div>
                @endif
              </div>
            </div>
            
            <div class="form-group row mt-5">
              <div class="col-md-12 text-md-center">
                <a href="{{ route('login')}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                <button type="submit" class="btn btn-primary btn-round"><i class="fa fa-send mr-3"></i><b>Registrasi</b></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection