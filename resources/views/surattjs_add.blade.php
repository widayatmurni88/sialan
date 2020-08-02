@php
  const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];    
@endphp

@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'surattjs'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pernyataan Tanggung Jawab</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-file mr-3"></i><b>Tambah Pernyataan</b></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">

                  @if ($errors->has('surattjs'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ $errors->first('surattjs') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif

                  @if (Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif

                  <form action=" {{ route('postPernyataan') }}" method="post" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <div class="form-group row">
                      <label for="periode" class="form-label col-md-3">Periode</label>
                      <div class="col-md-9">
                        <div class="form-inline" id="periode">
                          
                          <select name="bulan" id="bulan" class="form-control {{ $errors->has('bulan') ? 'is-invalid' : ''}}" required>
                            @for ($i = 1; $i < 12; $i++)
                              <option value="{{ $i }}" >{{ bulan[$i-1]}}</option>
                            @endfor
                          </select>

                          <select name="tahun" id="tahun" class="form-control {{ $errors->has('tahun') ? 'is-invalid' : ''}}" required>
                            @for ($i = 0; $i < 4; $i++)
                              <option value="{{ $i+2020}}" {{ ($i+2020 == $periode) ? 'selected' : '' }}>{{ $i+2020}}</option>
                            @endfor 
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-9 offset-3">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input"  name="surattjs" id="surattjs" required>
                            <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-md-9 offset-3">
                        <div id="img_preview"></div>
                      </div>
                    </div>

                    <div class="form-group row">
                      <div class="col-12">
                        <a href="{{ route('getPernyataanBy', $periode) }}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                        <button type="submit" class="btn btn-success btn-round float-right"><i class="fa fa-save mr-3"></i>Simpan</button>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@push('bodyResource')
<script>
  $("#surattjs").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>
@endpush