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
          <h1>Pengaturan Pangkat</h1>
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
                        Apakah anda yakin akan menghapus user "<span id="record"></span>" ?
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
              <h3 class="card-title"><i class="fa fa-th-list mr-3"></i><b>Daftar Pangkat</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <div class="row">

                <div class="col-md-4">
                <form action="{{ route('cariPangkat') }}" method="post" class="form-group">
                    {{ csrf_field() }}
                    <div class="input-group">
                      <input type="text" name="cari" id="cari" class="form-control" value="{{ old('cari')}}">
                      <span class="input-group-append">
                        <button type="submit" class="btn btn-info btn-flat"><i class="fa fa-search"></i></button>
                      </span>
                    </div>
                  </form>
                </div>

                <div class="col-md-8">
                  <a href="{{ route('tambahPangkat')}}" class="btn btn-primary btn-round pull-right"><i class="fa fa-plus mr-3"></i>Tambah Pangkat</a>
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
                          <th scope="col" class="col-1">#</th>
                          <th scope="col" class="col-11">PANGKAT KEPEGAWAIAN</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (count($ranks)>0)
                          @foreach ($ranks as $item)
                              <tr>
                                <th scope="row" class="col-1">#</th>
                                <td class="col-11">
                                  <div class="wrap">
                                    {{ $item->rank}}
                                    <div class="btn-grub">
                                      <a href ="{{ route('editPangkat', $item->id)}}" class="btn btn-primary btn-sm btn-act btn_edit"><i class="fa fa-pencil"></i></a>
                                      <a href="" class="btn btn-danger btn-sm btn-act" data-href="{{ route('deletePangkat', $item->id)}}" data-toggle="modal" data-target="#confirm-delete" data-iden="{{ $item->rank}}"><i class="fa fa-trash"></i></a>
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
