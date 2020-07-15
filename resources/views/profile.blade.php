@extends('baseLayout')
@section('content')
<h1>Profile akun</h1>
@foreach ($data as $item)
  <input type="text" name="id" id="id" value="{{$item->id}}" readonly>
  <input type="text" name="name" id="name" value="{{$item->nama}}">
  <input type="email" name="email" id="email" value="{{$item->email}}">
  <table>
    <tr>
    @for ($i = 1; $i < cal_days_in_month(CAL_GREGORIAN, 1, 2020); $i++)
      <td>{{ date('D', strtotime('2020-01-01')) }}</td>
    @endfor
    </tr>
  </table>
@endforeach
@endsection

@push('bodyResource')
  <script src="{{ asset('js/profile.js')}}"></script>
@endpush
