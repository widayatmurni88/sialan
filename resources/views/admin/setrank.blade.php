@extends('admin.layout.base')

@section('content')
@include('admin.layout.nav')
@include('admin.layout.sidebar', ['menu' => 'pangkat'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Setting Pangkat</h1>
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
          <div class="card card-rimary card-outline">
            <div class="card-header">
              <h3 class="card-title"><b>Daftar Pangkat</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                
                <div class="col-sm-6">
                  cari
                </div>
                
                <div class="col-sm-6">
                  <a href="#" class="btn btn-primary btn-round pull-right"><i class="fa fa-plus mr-3"></i>Tambah Pangkat</a>
                </div>

                <div class="col-12">
                  <div class="table-responsive">
                    
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