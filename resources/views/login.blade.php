@extends('baseLayout')
@section('content')
  <div class="login-page">
    <div class="login-box">
      <div class="card w-100">
        <div class="card-body">
          <div class="w-100 mb-4">
            <img src="{{ asset('imgs/fingerprint.png')}}" alt="LOGIN" class="d-block mx-auto mb-3" style="height:65px">
          </div>
          <hr>
          @if ($errors->any())
            <div class="alert alert-danger" role="alert">
              
                @foreach ($errors->all() as $erItem)
                <li>{{ $erItem }}</li>
                @endforeach
              
            </div>      
          @endif
          
          @if (Session::get('msg')!='')
            <div class="alert alert-danger" role="alert">
              {{Session::get('msg')}}
            </div>
          @endif

          <form action="{{ route('cekLogin')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
              <label for="Username">Username/Email</label>
              <input type="text" name="Username" id="Username" class="form-control" placeholder="Username/Email" value="{{ old('Username')}}" autofocus>
            </div>

            <div class="form-group">
              <label for="Password">Password</label>
              <input type="password" name="Password" id="Password" class="form-control" placeholder="Password">
            </div>

            <br>
            <div class="form-group">
              <button type="submit" class="btn btn-block btn-primary btn-round"><i class="fa fa-unlock mr-3"></i>Login</button>
            </div>
          </form>
          <br>
          <div class="block">
            <a href="{{ route('forgotPwd') }}"><b>Lupa Password</b></a>
          </div>
          <div class="block">
            <a href="{{ route('register')}}"><b>Registrasi Pengguna Baru</b></a>
          </div>
        </div>
      </div>
      {{-- @if ($errors->any())
          {{$errors}}
      @endif
      <form action="{{ route('cekLogin')}}" method="post">
        {{ csrf_field() }}
        <label for="uname">Username</label>
        <input type="text" name="uname" id="uname" placeholder="Username / Email" value={{old('uname')}}>
        <br>
        <label for="pwd">Password</label>
        <input type="password" name="pwd" id="pwd" placeholder="Password">
        <br>
        <button type="submit">Login</button>
      </form>
      <br>
      <div class="mt-3">
        <a href="{{ route('register') }}">Registrasi</a>
      </div> --}}
    </div>
  </div>
@endsection