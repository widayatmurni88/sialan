@extends('baseLayout')
@section('content')
<h2>Selamat datang <a href="{{route('profile', Auth::user()->bio_nid)}}"> {{ Auth::user()->bio_nid}}</a></h2>
<a href="{{ route('getHariLibur', '2020')}}">Setup Hari Libur</a>
<br>
<a href="{{ route('menageAcounts')}}">Menejemen Akun</a>
<br>
<a href="{{ route('logout')}}">Logout</a>

{{ dd(Auth::user())}}
@endsection
