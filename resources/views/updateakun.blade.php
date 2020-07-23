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
          <h1>Akun</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-4">
          <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img src="{{ asset('imgs/profiles/'.$photo) }}" id="photo_preview" class="profile-user-img img-fluid w-100" alt="Profile image">
              </div>
              <form action="{{ route('uploadFoto')}}" method="post" enctype="multipart/form-data" class="form-horizontal mt-3">
                {{ csrf_field() }}
                  <input type="file" name="photo" id="photo">
                  <button type="submit" id="upload" class="btn btn-sm btn-outline-primary btn-round btn-block mt-3" disabled><i class="fa fa-upload mr-3"></i>Upload</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-8">

          <!--Card Profil-->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-user mr-3"></i><b>Perbaharui Akun</b></h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                  @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                  @endforeach
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              @if ($message = session()->get('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  {{ $message }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              <!-- form -->
              <form action="{{ route('postChangeAkun')}}" method="post" class="form-horizontal">

                {{ csrf_field() }}

                <div class="form-group row">
                  <label for="email" class="col-form-label col-md-3">Email</label>
                  <div class="col-md-9">
                    <input type="email" name="email" id="email" class="form-control" value="{{ $email }}" required readonly>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="pwd" class="col-form-label col-md-3">Password</label>
                  <div class="col-md-9">
                    <input type="password" name="password" id="pwd" class="form-control" value="" placeholder="Password" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="pwd" class="col-form-label col-md-3">Password Konfirmasi</label>
                  <div class="col-md-9">
                    <input type="password" name="password_confirmation" id="pwd" class="form-control" value="" placeholder="Konfirmasi Password" required>
                  </div>
                </div>

                <div class="form-group row mt-4">
                  <div class="col-12">
                    <button type="submit" class="btn btn-success btn-round pull-right"><i class="fa fa-save mr-3"></i>Perbaharui</button>
                  </div>
                </div>

              </form>
              <!-- end form -->
            </div>
          </div>
          <!--End Card Profil-->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection

@push('bodyResource')
  <script src="{{ asset('adminlte/plugins/custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script>
    $(document).ready(function () {
      bsCustomFileInput.init();
    });

    (()=>{
      let event = document.querySelector('#photo');
      let photo = document.querySelector('#photo_preview');

      event.addEventListener('change', (e)=>{
        let files = e.target.files;

        // FileReader support
        if (FileReader && files && files.length) {
            var fr = new FileReader();
            fr.onload = function () {
                photo.src = fr.result;
            }
            fr.readAsDataURL(files[0]);
            document.querySelector('#upload').disabled = false;
        }
      });
    })();
  </script>
@endpush
