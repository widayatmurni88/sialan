@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'dashboard'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Kegiatan Harian</h1>
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
              <h3 class="card-title"><b>Kegiatan Hari {{ date('D, d-m-Y', strtotime(now())) }}</b></h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-12">

                  <div class="form-group row">
                    <label for="title" class="col-form-label col-3">Judul kegiatan</label>
                    <div class="col-9">
                      <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" value="{{ old('title')}}" autofocus required>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="desc" class="col-form-label col-3">Deskripsi</label>
                    <div class="col-9">
                      <textarea name="desc" id="desc" cols="30" rows="10" class="form-control">{{ old('desc')}}</textarea>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-9 offset-3">
                      <input type="file" name="doc" id="doc">
                    </div>
                  </div>

                  <div class="form-group row mt-4">
                    <div class="col-12">
                      <button type="submit" class="btn btn-success btn-round pull-right"><i class="fa fa-save mr-3"></i>Simpan</button>
                    </div>
                  </div>

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