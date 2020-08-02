@extends('admin.layout.base')

@section('content')
@include('admin.layout.nav')
@include('admin.layout.sidebar', ['menu' => 'manageakun'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manage Akun</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-primary card-outline">
            <div class="card-header border-0">
              <h3 class="card-title">Ini Halaman Manage Akun</h3>
            </div>
            <div class="card-body">
              <div class="row">

                <!--Modal delete-->
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
                <!--End Modal delete-->

                <div class="col-md-3">
                  <form action="" method="post">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Cari nama/email">
                      <div class="input-group-append">
                        <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-9">
                  <button class="btn btn-primary btn-round float-right"><i class="fa fa-plus mr-3"></i> Tambah User</button>
                </div>
              </div>

              <div class="mt-4">
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
              </div>

              <div class="table-responsive mt-4">
                  <table class="table table-hover table-md table-act table-fixed">
                    <thead>
                      <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-4">NAMA</th>
                        <th scope="col" class="col-5">EMAIL</th>
                        <th scope="col" class="col-2">JENIS AKUN</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($acounts as $item)
                        <tr>
                          <th scope="col" class="col-1">#</th>
                          <td class="col-4">{{ $item->name }}</td>
                          <td class="col-5">{{  $item->email}}</td>
                          <td class="col-2">
                            <div class="wrap">
                              {{ $item->lvl}} 
                              <div class="btn-grub">
                                <a href ="{{ route('getEditAkun', $item->akun_id)}}" class="btn btn-primary btn-sm btn-act btn_edit rounded-circle"><i class="fa fa-pencil"></i></a>
                                <a href="" class="btn btn-danger btn-sm btn-act rounded-circle" data-href="{{ route('deleteAkun', $item->akun_id)}}" data-toggle="modal" data-target="#confirm-delete" data-iden="{{ $item->name}}"><i class="fa fa-trash"></i></a>
                              </div>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
              </div>

            </div>
          </div>
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
