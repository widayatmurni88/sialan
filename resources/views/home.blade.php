@extends('baseLayout')
@section('content')
<h2>Selamat datang <a href="{{route('profile', Auth::user()->id)}}"> {{ Auth::user()->name}}</a></h2>
<a href="{{ route('getHariLibur', '2020')}}">Setup Hari Libur</a>
<br>
<a href="{{ route('menageAcounts')}}">Menejemen Akun</a>
<br>
<a href="{{ route('userlevel')}}">user level</a>
<a href="{{ route('logout')}}">Logout</a>

{{ dd(Auth::user())}}
@endsection