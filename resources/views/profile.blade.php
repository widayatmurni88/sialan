@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'profil'])

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Profile</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              test
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-user mr-3"></i>Profile</h3>
            </div>
            <div class="card-body">
              <!-- form -->
              <form class="form-horizontal" action="" method="post">

                <div class="form-group row">
                  <label for="nid" class="col-form-label col-md-3">No Identitas</label>
                  <div class="col-md-9">
                    <input type="text" name="nid" id="nid" class="form-control" value="{{ $profil_data->id }}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="name" class="col-form-label col-md-3">Nama Lengkap</label>
                  <div class="col-md-9">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $profil_data->name}}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tmpt_lahir" class="col-form-label col-md-3">Tempat Lahir</label>
                  <div class="col-md-9">
                    <input type="text" name="tmpt_lahir" id="tmpt_lahir" class="form-control" value="{{ $profil_data->place_bd}}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="tgl_lahir" class="col-form-label col-md-3">Tanggal Lahir</label>
                  <div class="col-md-9">
                    <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" value="{{ $profil_data->date_bd}}">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="jkel" class="col-form-label col-md-3">Jenis Kelamin</label>
                  <div class="col-md-9">
                    <div class="form-group">
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="laki" name="customRadio" checked>
                          <label for="laki" class="custom-control-label font-weight-normal">Laki-Laki</label>
                        </div>
                        <div class="custom-control custom-radio">
                          <input class="custom-control-input" type="radio" id="perempuan" name="customRadio">
                          <label for="perempuan" class="custom-control-label font-weight-normal">Perempuan</label>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="pangkat" class="col-form-label col-md-3">Pangkat</label>
                  <div class="col-md-9">
                    <select name="pangkat" id="pangkat" class="form-control">
                      @foreach ($ranks as $rank)
                        <option value="{{$rank->id}}">{{$rank->rank}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>

                <div class="form-group row mt-5">
                  <div class="offset-3 col-md-9">
                    <button type="submit" class="btn btn-success btn-round pull-right"><i class="fa fa-save mr-3"></i>Update</button>
                  </div>
                </div>

              </form>
              <!-- end form -->
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
