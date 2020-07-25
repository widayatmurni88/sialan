@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'dashboard'])

@push('headResource')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css')}}">
@endpush

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Kegiatan</h1>
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
          <div class="card card-primary card-outline">
            <div class="card-header">

              @if ($kegiatan != null)
              <h3 class="card-title"><b><i class="fa fa-pencil-square-o mr-2"></i> Edit Kegiatan {{ date('D, d-m-Y', strtotime($kegiatan->time)) }}</b></h3>
              @endif

            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">

                  @if ($kegiatan != null)

                    <form action="{{ route('posteditkegiatanharian')}}" method="post" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="form-group row">
                        <label for="title" class="col-form-label col-3">Judul kegiatan</label>
                        <div class="col-9">
                          <input type="hidden" name="id_absen" value="{{ $kegiatan->id}}">
                          <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" value="{{ $kegiatan->ttl}}" autofocus required>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="desc" class="col-form-label col-3">Deskripsi</label>
                        <div class="col-9">
                          <textarea name="desc" id="deskripsi" cols="30" rows="40" class="form-control">{{ $kegiatan->desc }}</textarea>
                          <small class="text-danger">Deskripsi kegiatan adalah opsional.</small>
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-9 offset-3">
                          <input type="file" name="dokumen" class="w-100" id="dokumen">
                          <small class="text-danger">File lampiran disini</small>
                        </div>
                      </div>

                      <div class="form-group row mt-4">
                        <div class="col-12">
                          <a href="{{ route('dashboard')}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                          <button type="submit" class="btn btn-success btn-round pull-right"><i class="fa fa-save mr-3"></i>Simpan</button>
                        </div>
                      </div>

                    </form>

                  @else
                    <div class="alert alert-danger" role="alert">
                      Kegiatan tidak ditemukan!.
                    </div>                      
                  @endif

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
  <script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js')}}"></script>
  <script>
  $(function () {
    //Add text editor
    $('#deskripsi').summernote()
  })
  </script>
@endpush