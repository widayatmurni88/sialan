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
          <h1>Kegiatan Harian</h1>
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
              <h3 class="card-title"><b><i class="fa fa-tasks mr-3"></i>Preview Kegiatan</b></h3>
            </div>

            @if ($kegiatan != null)
            <div class="card-body p-0">

              <div class="mailbox-read-info">
                <h5>{{$kegiatan->ttl}}</h5>
                <h6><span class="mailbox-read-time">{{ date('D, d-m-Y H:i', strtotime($kegiatan->time)) }}</span> </h6>
              </div>

              @if (date('Ymd', strtotime($kegiatan->time)) == date('Ymd', strtotime(now())))
                <div class="mailbox-controls with-border text-center">
                  <a href="{{ route('editkegiatanharian', $kegiatan->id) }}" class="btn btn-sm btn-outline-info"><i class="fa fa-pencil"></i></a>
                  <a href="{{ route('deleteKegiatan',$kegiatan->id)}}" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                </div>
              @endif

              <div class="mailbox-read-message">
                {!! $kegiatan->desc !!}
              </div>
            </div>
            
            @if ($kegiatan->file != '')
            <div class="card-footer bg-white">
              <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                <li>
                  <span class="mailbox-attachment-icon"><i class="fa fa-file"></i></span>
                  <div class="mailbox-attachment-info">
                    <a href="{{ url(config('app.url') . '/docs/' . $kegiatan->file)}}" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>{{ $kegiatan->file }}</a>
                  </div>
                </li>
              </ul>
            </div>
            @endif
            
            @endif
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="{{ route('dashboard')}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
            </div>
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