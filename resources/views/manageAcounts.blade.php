@extends('baseLayout')

@section('content')
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog border-danger">
        <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4><b><i class="fa fa-exclamation-circle mr-2"></i> Konfrimasi</b></h4>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus <span id="record"></span> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-round" data-dismiss="modal"><i class="fa fa-remove mr-2"></i> Batal</button>
                <a class="btn btn-outline-danger btn-round btn-ok"><i class="fa fa-trash mr-2"></i>Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <b class="card-title"><i class="fa fa-user mr-3"></i> Manajemen Akun</b>
        </div>
        <div class="card-body">
          <div class="row">
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

          <table class="table table-hover table-act table-fixed mt-4">
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
                      {{ $item->id}} 
                      <div class="btn-grub">
                        <a href ="" class="btn btn-primary btn-sm btn-act btn_edit"><i class="fa fa-pencil"></i></a>
                        <a href="" class="btn btn-danger btn-sm btn-act" data-href="{{ route('deleteUser', $item->id)}}" data-toggle="modal" data-target="#confirm-delete" data-whatever=""><i class="fa fa-trash"></i></a>
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

@endsection

@push('bodyResource')
<script  type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });
</script>
@endpush