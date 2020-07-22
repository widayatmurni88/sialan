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
          <!-- Default box -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><b>Tambah Pangkat Kepegawaian</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body pb-0">
              <form action="{{ route ('postPangkat')}}" method="post" class="form-horizontal">

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

                {{ csrf_field() }}
                
                <div class="form-group row mt-3 mb-5">
                  <label for="pangkat" class="col-form-label col-md-3">Pangkat Kepegawaian</label>
                  <div class="col-md-9">
                    <input type="text" name="pangkat" id="pangkat" class="form-control {{ $errors->has('pangkat') ? 'is-invalid' : ''}}" placeholder="Pangkat Kepegawaian" value="{{ old('pangkat')}}" autofocus>
                    @if ($errors->has('pangkat'))
                      <div class="invalid-feedback">
                        {{ $errors->first('pangkat')}}
                      </div>
                    @endif
                  </div>
                </div>

                <hr>
                <div class="form-group row mt-3">
                  <div class="col-12">
                    <a href="{{ route('setPangkat')}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                    <button type="submit" class="btn btn-success btn-round pull-right"><i class="fa fa-save mr-3"></i>Simpan</button>
                  </div>
                </div>

              </form>
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

@push('bodyresource')
<script  type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    var rec = $(e.relatedTarget).data('iden');
    $(this).find('#record').text(rec);
  });
</script>    
@endpush