@extends('admin.layout.base')

@section('content')
@include('admin.layout.nav')
@include('admin.layout.sidebar', ['menu' => 'instansi'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pengaturan Instansi</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- Default box -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-building mr-3"></i><b>Tambah Instansi</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">

                <div class="col-12 mt-3">
                  @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  <form action="{{ route('postaddinstansi')}}" method="post" class="form-horizontal">

                    {{ csrf_field() }}

                    <div class="form-group row">
                      <label for="nama" class="col-form-label col-3">Nama Instansi</label>
                      <div class="col-9">
                        <input type="text" name="name" id="nama" class="form-control" value="{{ old('name')}}" required autofocus>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="alamat" class="col-form-label col-3">Alamat</label>
                      <div class="col-9">
                        <textarea name="address" id="alamat" cols="30" rows="2" class="form-control">{{ old('address') }}</textarea>
                      </div>
                    </div>

                    <div class="form-group row mt-4">
                      <div class="col-12">
                        <a href="{{ route('instansi') }}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                        <button type="submit" class="btn btn-success btn-round pull-right"><i class="fa fa-save mr-3"></i>Simpan</button>
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
@endpush
