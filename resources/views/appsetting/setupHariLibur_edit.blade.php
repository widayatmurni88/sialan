@extends('baseLayout')
@push('headResource')
  <link rel="stylesheet" href="{{ asset('css/flatpickr.css')}}">
  <script src="{{ asset('js/flatpickr.js') }}"></script>
@endpush
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <b>Edit</b>
        </div>
        <div class="card-body">
          <form action="{{ route('postEditHariLibur', [$thn, $libur[0]->id])}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group row">
              <label for="tgl" class="form-label col-md-2 text-md-right">Tanggal</label>
              <div class="col-md-10">
                <input type="date" name="tgl" id="tgl" class="form-control {{ $errors->has('tgl') ? 'is-invalid' : ''}}" value="{{ $libur[0]->tgl}}">
                @if ($errors->has('tgl'))
                    <div class="invalid-feedback">
                      {{ $errors->first('tgl')}}
                    </div>
                @endif
              </div>
            </div>

            <div class="form-group row">
              <label for="desc" class="form-label col-md-2 text-md-right">Keterangan</label>
              <div class="col-md-10">
                <textarea name="desc" id="desc" cols="30" rows="2" class="form-control {{$errors->has('desc') ? 'is-invalid' : ''}}">{{ $libur[0]->ket}}</textarea>
                @if ($errors->has('desc'))
                    <div class="invalid-feedback">
                      {{ $errors->first('desc')}}
                    </div>
                @endif
              </div>
            </div>

            <div class="form-group row mt-5">
              <div class="col-md-12 text-center">
                <a href="{{ route('getHariLibur',$thn) }}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                <button type="submit" class="btn btn-success btn-round"><i class="fa fa-save mr-3"></i>Simpan</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('bodyResource')
  <script  type="text/javascript" src="{{ asset('js/appsetting.js')}}"></script>
  <script type="text/javascript">
    let tgl = document.querySelector('#tgl');
    let opts = {};

    opts.altInput = true;
    opts.altFormat = 'j F Y';
    opts.dateFormat = 'Y-m-d';
    opts.minDate = '{{ $thn }}-01'
    opts.maxDate = '{{ $thn }}-12-31'

        flatpickr(tgl, opts);
  </script>
@endpush