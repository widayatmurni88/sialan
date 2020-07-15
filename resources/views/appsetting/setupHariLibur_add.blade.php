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
            <b>Tambah Hari Libur</b>
          </div>
          <div class="card-body">
            <form action="{{ route('postHariLibur') }}" method="post">
              {{ csrf_field() }}
              <input type="hidden" name="tahun" value="{{ $thn }}">
              <div class="form-group row">
                <label for="tgl" class="col-md-2 text-md-right">Tanggal</label>
                <div class="col-md-10">
                  <input type="date" name="tgl" id="tgl" class="form-control {{ $errors->has('tgl') ? 'is-invalid' : ''}}" value="{{ old('tgl')}}">
                  @if ($errors->has('tgl'))
                      <div class="invalid-feedback">
                        {{ $errors->first('tgl') }}
                      </div>
                  @endif
                </div>
              </div>

              <div class="form-group row">
                <label for="desc" class="form-label col-md-2 text-md-right">Katerangan</label>
                <div class="col-md-10">
                  <textarea name="desc" id="" cols="30" rows="2" class="form-control {{ $errors->has('desc') ? 'is-invalid' : ''}}">{{old('desc')}}</textarea>
                  @if ($errors->has('desc'))
                      <div class="invalid-feedback">
                        {{ $errors->first('desc') }}
                      </div>
                  @endif
                </div>
              </div>
              
              <div class="form-group row mt-5">
                <div class="col-md-12 text-md-center">
                  <a href="{{ route('getHariLibur', $thn)}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                  <button class="btn btn-success btn-round"><i class="fa fa-save mr-3"></i> Simpan</button>
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
  <script type="text/javascript" src="{{ asset('js/appsetting.js')}}"></script>
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