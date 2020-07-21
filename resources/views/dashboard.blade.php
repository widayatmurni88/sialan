@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-7">
          <!-- Default box -->
          <div class="card bg-gradient-primary">
            <div class="card-header border-0">
              <h3 class="card-title"><b>Kehadiran</b></h3>
            </div>
            <div class="card-body">
              Start creating your amazing application!
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-5">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Kegiatan hari ini</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              Start creating your amazing application!
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