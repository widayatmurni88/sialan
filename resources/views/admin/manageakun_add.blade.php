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
              <h3 class="card-title"><i class="fa fa-user mr-3"></i> Tambah Akun</h3>
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

              <form class="form-horizontal" action="{{ route('postadduserakun')}}" method="post">
                {{ csrf_field() }}
                <div class="form-group row">
                  <label for="nidn" class="control-label col-md-3">NIDN / NIP</label>
                  <div class="col-md-9">
                    <input type="text" name="nidn" id="nidn" class="form-control {{ $errors->has('nidn') ? 'is-invalid' : '' }}" value="{{ old('nidn')}}" placeholder="NIDN / NIP / ID Lainnya" required autofocus>
                    @if ($errors->has('nidn'))
                      <div class="invalid-feedback">
                        {{ $errors->first('nidn')}}
                      </div>
                    @endif
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="name" class="control-label col-md-3">Nama Lengkap</label>
                  <div class="col-md-9">
                    <input type="text" name="name" id="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Nama anda : ex: Joko Widodo" required>
                    @if ($errors->has('name'))
                      <div class="invalid-feedback">
                        {{ $errors->first('name')}}
                      </div>
                    @endif
                  </div>
                </div>
    
                <div class="form-group row">
                  <label for="email" class="control-label col-md-3">Email</label>
                  <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="alamatemail@mail.com" required>
                    @if ($errors->has('email'))
                      <div class="invalid-feedback">
                        {{ $errors->first('email')}}
                      </div>
                    @endif
                  </div>
                </div>
    
                <div class="form-group row">
                  <label for="password" class="control-label col-md-3">Password</label>
                  <div class="col-md-9">
                    <input type="password" name="password" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password" required>
                    @if ($errors->has('password'))
                      <div class="invalid-feedback">
                        {{ $errors->first('password')}}
                      </div>
                    @endif
                  </div>
                </div>
    
                <div class="form-group row">
                  <label for="password" class="control-label col-md-3">Password Konfirmasi</label>
                  <div class="col-md-9">
                    <input type="password" name="password_confirmation" id="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : ''}}" placeholder="Password Konfirmasi">
                    @if ($errors->has('password'))
                      <div class="invalid-feedback">
                        {{ $errors->first('password')}}
                      </div>
                    @endif
                  </div>
                </div>
                
                <div class="form-group row mt-5">
                  <div class="col-md-12">
                    <a href="{{ route('manageAkun')}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                    <button type="submit" class="btn btn-primary btn-round float-right"><i class="fa fa-send mr-3"></i><b>Registrasi</b></button>
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
