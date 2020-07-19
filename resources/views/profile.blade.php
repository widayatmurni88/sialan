@extends('baseLayout')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <b class="card-title">Profil Akun</b>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">


              <div class="form-group row">
                <div class="col-md-12 text-center">
                  <a href="" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                  <button type="button" class="btn btn-primary btn-round"><i class="fa fa-save mr-3"></i>Update</button>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



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
  
@endpush
