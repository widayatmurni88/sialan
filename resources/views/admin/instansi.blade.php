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
          <!-- Modal delete dialog-->
          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content border-danger">
                    <div class="modal-header bg-danger">
                      <h4 class="modal-title"><b><i class="fa fa-exclamation-circle mr-2"></i> Konfrimasi</b></h4>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin akan menghapus "<span id="record"></span>" ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary btn-round" data-dismiss="modal"><i class="fa fa-remove mr-2"></i> Tidak</button>
                        <a class="btn btn-outline-danger btn-round btn-ok"><i class="fa fa-trash mr-3"></i>Ya</a>
                    </div>
                </div>
            </div>
          </div>
          <!-- End modal delete dialog-->
          <!-- Default box -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-th-list mr-3"></i><b>Daftar Instansi</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">

                <div class="col-md-4">
                <form action="" method="post" class="form-group">
                    {{ csrf_field() }}
                    <div class="input-group">
                      <input type="text" name="cari" id="cari" class="form-control" value="">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>

                <div class="col-md-8">
                  <a href="{{ route ('addinstansi')}}" class="btn btn-primary btn-round pull-right"><i class="fa fa-plus mr-3"></i>Tambah Instansi</a>
                </div>

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

                  <div class="table-responsive">
                    <table class="table table-hover table-act table-fixed">
                      <thead>
                        <tr>
                          <th scope="col" class="col-1">NO</th>
                          <th scope="col" class="col-5">NAMA INSTANSI</th>
                          <th scope="col" class="col-6">ALAMAT</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (count($instansi)>0)
                        @php
                            $i = 1;
                        @endphp
                          @foreach ($instansi as $item)
                              <tr>
                                <th scope="row" class="col-1">{{ $i++}}</th>
                                <td class="col-5">{{ $item->name }}</td>
                                <td class="col-6">
                                  <div class="wrap">
                                    {{ $item->addr}}
                                    <div class="btn-grub">
                                      <a href ="{{ route('editinstansi', $item->id)}}" class="btn btn-primary btn-sm btn-act btn_edit"><i class="fa fa-pencil"></i></a>
                                      <a href="" class="btn btn-danger btn-sm btn-act" data-href="{{ route('deleteinstansi', $item->id)}}" data-toggle="modal" data-target="#confirm-delete" data-iden="{{ $item->name}}"><i class="fa fa-trash"></i></a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                          @endforeach
                        @else
                          <tr>
                            <th scope="col" class="col-1"></th>
                            <td class="col-11 text-danger text-center">Data pangkat tidak ditemukan.</td>
                          </tr>
                        @endif
                      </tbody>
                    </table>
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

@push('bodyResource')
<script  type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    var rec = $(e.relatedTarget).data('iden');
    $(this).find('#record').text(rec);
   });
</script>
@endpush
