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
            <div class="card-header">
              <h3 class="card-title">Pengaturan Akun</h3>
            </div>
            <div class="card-body">

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
              
              <form action="{{ route('updatelevel') }}" method="post">

                {{ csrf_field() }}
                
                <div class="form-group row">
                  <label class="label form-label col-md-3">Email</label>
                  <div class="col-md-9">
                    <input type="hidden" name="id" value="{{ $akun->id}}">
                    <input type="text" class="form-control" name="" value="{{ $akun->email}}" readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="label form-label col-md-3">Jenis Akun</label>
                  <div class="col-md-9">
                    <select class="form-control" name="level">
                      <option value="">---</option>
                      <option value="admin" {{ ($akun->level == 'admin') ? 'selected' : '' }}>Admin Pusat</option>
                      <option value="instansi" {{ ($akun->level == 'instansi') ? 'selected' : '' }}>Admin Instansi</option>
                      <option value="user" {{ ($akun->level == 'user') ? 'selected' : '' }}>User</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <div class="col-12">
                    <a href="{{ route('manageAkun') }}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                    <button type="submit" class="btn btn-success btn-round pull-right"><i class="fa fa-save mr-3"></i>Simpan</button>
                  </div>
                </div>
              
              </form>

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
