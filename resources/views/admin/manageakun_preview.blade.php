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
              <h3 class="card-title"><i class="fa fa-user mr-3"></i> Preview Akun</h3>
            </div>
            <div class="card-body">
              
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

              <div class="row">
                <div class="col-md-3">
                  
                  <div class="card">
                    <img src="{{ asset('imgs/profiles/' . $userakun->img) }}" alt="photo profil">
                  </div>

                </div>
                <div class="col-md-9">

                  @if ($msg = session()->get('rsuccess'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ $msg }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  @if ($msg = session()->get('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ $msg }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  
                  <form action="{{ route('updateakunuser', $userakun->uid)}}" method="post">
                  
                    {{ csrf_field() }}
                    
                    <div class="card">
                      <div class="card-body">

                        <input type="hidden" name="uid" value="{{$userakun->uid}}">

                        <div class="form-group row">
                          <label for="email" class="form-label col-md-3">Email</label>
                          <div class="col-md-9">
                            <input type="text" name="email" id="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : ''}}" value="{{ $userakun->uemail }}">

                            @if ($errors->has('email'))
                              <div class="invalid-feedback">
                                {{ $errors->first('email')}}
                              </div>
                            @endif

                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="level" class="form-label col-md-3">Level Akses</label>
                          <div class="col-md-9">
                            <select name="level" id="level" class="form-control {{ $errors->has('level') ? 'is-invalid' : ''}}">
                              <option value="">---</option>
                              <option value="admin" {{ ($userakun->ulevel == 'admin') ? 'selected' : ''}}>Admin Pusat</option>
                              <option value="instansi" {{ ($userakun->ulevel == 'instansi') ? 'selected' : ''}}>Admin Instansi</option>
                              <option value="user" {{ ($userakun->ulevel == 'user') ? 'selected' : ''}}>Pengguna</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="" class="form-label col-md-3">Reset Password</label>
                          <div class="col-md-9">
                            <a href="{{ route('resetuserpassword', $userakun->uid)}}" class="btn btn-outline-info btn-sm">Reset Password Standar</a>
                            <small class="text-danger">Password standar : 123456789</small>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="card">
                      <div class="card-body">

                        <div class="form-group row">
                          <label for="nid" class="form-label col-md-3">NO ID</label>
                          <div class="col-md-9">
                            <input type="text" name="nid" id="nid" class="form-control {{ $errors->has('nid') ? 'is-invalid' : ''}}" value="{{ $userakun->nid}}">

                            @if ($errors->has('nid'))
                              <div class="invalid-feedback">
                                {{ $errors->first('nid')}}
                              </div>
                            @endif

                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="nama" class="form-label col-md-3">Nama</label>
                          <div class="col-md-9">
                            <input type="text" name="nama" id="nama" class="form-control" value="{{ $userakun->nama}}">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="tlahir" class="form-label col-md-3">Tempat Lahir</label>
                          <div class="col-md-9">
                            <input type="text" name="tlahir" id="tlahir" class="form-control" value="{{ $userakun->tlahir}}">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="tgllahir" class="form-label col-md-3">Tanggal Lahir</label>
                          <div class="col-md-9">
                            <input type="date" name="tgllahir" id="tgllahir" class="form-control" value="{{ $userakun->tgllahir}}">
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="jkel" class="form-label col-md-3">Jenis Kelamin</label>
                          <div class="col-md-9">
                            <div class="form-group">
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="laki" name="jkel" value="1" {{ $userakun->jkel ? 'checked' : ''}}>
                                <label for="laki" class="custom-control-label font-weight-normal">Laki-Laki</label>
                              </div>
                              <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="perempuan" name="jkel" value="0" {{ !$userakun->jkel ? 'checked' : ''}}>
                                <label for="perempuan" class="custom-control-label font-weight-normal">Perempuan</label>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="pangkat" class="form-label col-md-3">Pangkat</label>
                          <div class="col-md-9">
                            <select name="pangkat" id="pangkat" class="form-control">
                              <option value="">---</option>
                              @foreach ($pangkat as $item)
                                <option value="{{ $item->id }}" {{ ($userakun->pangkat_id == $item->id ) ? 'selected' : ''}}>{{$item->pangkat}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="unit" class="form-label col-md-3">Unit Kerja</label>
                          <div class="col-md-9">
                            <select name="unit" id="unit" class="form-control">
                              <option value="">---</option>
                              @foreach ($instansi as $item)
                                <option value="{{ $item->id }}" {{ ($userakun->instansi_id == $item->id ) ? 'selected' : ''}}>{{$item->nama_ins}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                      </div>
                    </div>

                </div>
              </div>

              <div class="row mt-3">
                <div class="col-12">
                  <a href="{{ route('manageAkun') }}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                  <button type="submit" class="btn btn-success btn-round float-right"><i class="fa fa-save mr-2"></i> Simpan</button>
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
