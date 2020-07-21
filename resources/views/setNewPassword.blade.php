@extends('layout.baseGuest')
@section('content')
<div class="container pt-4">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fa fa-lock mr-3"></i><b>Atur Password Baru</b>
          </h3>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">

              @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              <form action="{{ route('setNewPassword') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                  <label for="pwd" class="form-label col-md-3 text-md-right">Password Baru</label>
                  <div class="col-md-9">
                    <input type="hidden" name="email" value="{{$email}}" readonly>
                    <input type="password" name="password" id="pwd" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}">
                    @if ($errors->has('password'))
                      <div class="invalid-feedback">
                        {{ $errors->first('password')}}
                      </div>
                    @endif
                  </div>
                </div>

                <div class="form-group row">
                  <label for="repwd" class="form-label col-md-3 text-md-right">Konfirmasi Password Baru</label>
                  <div class="col-md-9">
                    <input type="password" name="password_confirmation" id="repwd" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}">
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <div class="col-md-12 text-center">
                    @if ($message = Session::get('success'))
                      <a href="{{ route('login')}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Login</a>
                    @endif
                    <button type="submit" class="btn btn-success btn-round"><i class="fa fa-save mr-3"></i>Simpan</button>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection