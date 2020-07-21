@extends('layout.baseGuest')
@section('content')
<div class="container pt-4">
  <div class="row">
    <div class="col-md-8 mx-auto">
      <div class="card card-primary card-outline">
        <div class="card-header">
          <span class="card-title"></span><b>Resset Password</b></span>
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

              @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  @foreach ($errors->all() as $er)
                    <li>{{ $er}}</li>
                  @endforeach
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              
              <form class="form-horizontal" action="{{ route('postForgotPassword') }}" method="post">
                {{ csrf_field() }}
                <div class="form-group row mt-3">
                  <label for="email" class="form-label col-md-3 text-md-right">Email</label>
                  <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <div class="col-md-12 text-center">
                    <a class="btn btn-outline-secondary btn-round" href="{{ route('login')}}"><i class="fa fa-chevron-circle-left mr-3"></i> Kembali</a>
                    <button type="submit" class="btn btn-primary btn-round"><i class="fa fa-refresh mr-3"></i>Send Request</button>
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
