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
          <h1>Dashboard</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
          <!-- Default box -->
          <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <div class="widget-user-image">
                  <img class="img-circle elevation-1" src="{{ asset('imgs/profiles/' . session()->get('profil_photo')) }}" alt="User">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><b>{{ session()->get('name') }}</b></h3>
                <h6 class="widget-user-desc">{{ 'Jabatan' }}</h6>
              </div>
              <div class="card-body bg-info pt-0">
                <div class="card mb-0">
                  <div class="card-body text-dark">
                    <div class="row border-bottom pb-3">
                      <div class="col-6"><b>Jadwal Kerja</b></div>
                      <div class="col-6 text-right">Senin, 20-12-2020</div>
                    </div>
                    <div class="group-item row pt-3 pb-3">
                      <div class="col-12 text-center"><h3 class="mb-0"><b>08:00 - 16:00</b></h3></div>
                    </div>
                    <div class="group-item row pt-2 pb-2 border-bottom">
                      <div class="col-12">
                        ALamat Kantor
                      </div>
                    </div>

                    <div class="group-item row pt-3">
                      <div class="col-12">
                        <form action="{{ route('absensi')}}" method="post" id="fabsen">
                          {{ csrf_field() }}
                          <input type="hidden" name="nid" value="{{ session()->get('nid')}}">
                          <input type="hidden" name="pangkat_id" value="{{ session()->get('id_pangkat')}}">
                          <input type="hidden" name="instansi_id" value="{{ session()->get('id_instansi')}}">
                          <button type="submit" class="btn btn-lg btn-primary btn-block"><i class="fa fa-check-circle-o mr-2"></i> Check In</button>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- /.widget-user -->
          <!-- /.card -->
        </div>
        <div class="col-md-7">
          <!-- Default box -->
          <div class="card card-primary card-outline">
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