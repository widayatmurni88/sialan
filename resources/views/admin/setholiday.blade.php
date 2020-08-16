@extends('admin.layout.base')

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
          <h1>Pengaturan Hari Libur</h1>
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
              <h3 class="card-title"><i class="fa fa-tasks mr-3"></i> Daftar Hari Libur</h3>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  
                  <div class="row">
                    <div class="col-md-7">

                      <div class="form-group">
                        <select name="bulan" id="" class="form-control">
                          <option value="">---</option>
                          @for ($i = 0; $i < count(bulan); $i++)
                              <option value="{{ $i+1 }}">{{bulan[$i]}}</option>
                          @endfor
                        </select>
                      </div>

                    </div>
                    <div class="col-md-4">

                      <div class="form-group">
                        <select name="" id="" class="form-control">
                          @for ($i = 0; $i < 5; $i++)
                              <option value="{{ $i+2020}}" {{ ($thn == $i+2020) ? 'selected' : ''}}>{{$i+2020}}</option>
                          @endfor
                        </select>
                      </div>

                    </div>
                    <div class="col-md-1">
                      <button type="submit" class="btn btn-outline-info btn-round"><i class="fa fa-search"></i></button>
                    </div>
                  </div>

                </div>

                <div class="col-md-6">
                  <a href="{{ route('tambahlibur', $thn)}}" class="btn btn-primary btn-round float-right"><i class="fa fa-plus mr-3"></i>Tambah Libur</a>
                </div>

                <div class="col-12 mt-3">
                  <div class="table-responsive">
                    <table class="table table-hover table-act table-fixed">
                      <thead>
                        <tr>
                          <th scope="col" class="col-1">#</th>
                          <th scope="col" class="col-3">TANGGAL</th>
                          <th scope="col" class="col-8">DESKRIPSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                  </div>
                </div>

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
