@extends('admin.layout.base')

@push('headResource')
  
@endpush

@section('content')
@include('admin.layout.nav')
@include('admin.layout.sidebar', ['menu' => 'libur'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tambah Hari Libur</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-plus mr-3"></i> Tambah Hari Libur</h3>
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
              
              <form action="{{ route('postharilibur')}}" method="post">

                {{ csrf_field() }}

                <div class="form-group row">
                  <label for="tgl" class="form-label col-md-3">Tanggal</label>
                  <div class="col-md-9">
                    <input type="date" name="tgl" id="tgl" class="form-control {{ $errors->has('tgl') ? 'is-invalid': ''}}" autofocus>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="desc" class="form-label col-md-3">Keterangan</label>
                  <div class="col-md-9">
                   <textarea name="desc" id="desc" cols="30" rows="2" class="form-control {{ $errors->has('desc') ? 'is-invalid': ''}}"></textarea>
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <div class="col-12">
                    <a href="{{ route('getharilibur', $thn)}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                    <button type="submit" class="btn btn-success btn-round float-right"><i class="fa fa-save mr-3"></i>Simpan</button>
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
