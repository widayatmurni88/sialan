@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'dashboard'])
@push('headResource')
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css')}}">
@endpush
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">
          <!-- Default box -->
          <!-- Widget: user widget style 2 -->
            <div class="card card-widget widget-user-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-info">
                <div class="widget-user-image">
                  <img class="img-circle elevation-1" src="{{ asset('imgs/profiles/' . session()->get('profil_photo')) }}" alt="User">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username"><b>{{ session()->get('name') }}</b></h3>
                <h6 class="widget-user-desc">{{ 'Jabatan' }}</h6>
              </div>
              <div class="card-body bg-info pt-0">
                @if (session()->get('status'))
                  <div class="callout callout-success text-dark">
                    <i class="fa fa-check mr-3"></i>{{ session()->get('message') }}
                  </div>
                @endif
                <div class="card mb-0">
                  <div class="card-body text-dark">
                    <div class="row border-bottom pb-3">
                      <div class="col-6"><b>Jadwal Kerja</b></div>
                      <div class="col-6 text-right">Senin, 20-12-2020</div>
                    </div>
                    <div class="group-item row pt-3 pb-3">
                      <div class="col-12 text-center"><h3 class="mb-0"><b>08:00 - 16:00</b></h3></div>
                    </div>
                    <div class="group-item row pt-2 pb-2 border-bottom">
                      <div class="col-12">
                        ALamat Kantor
                      </div>
                    </div>

                    <div class="group-item row pt-3">
                      <div class="col-12">
                        <form action="{{ route('absensi')}}" method="post" id="fabsen">
                          {{ csrf_field() }}
                          <input type="hidden" name="nid" value="{{ session()->get('nid')}}">
                          <input type="hidden" name="pangkat_id" value="{{ session()->get('id_pangkat')}}">
                          <input type="hidden" name="instansi_id" value="{{ session()->get('id_instansi')}}">
                          <button type="submit" id="btn_absen" class="btn btn-lg btn-primary btn-block"><i class="fa fa-check-circle-o mr-2"></i> Check In</button>
                        </form>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- /.widget-user -->
          <!-- /.card -->
        </div>
        <div class="col-md-7">
          <!-- Default box -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-tasks mr-3"></i> Kegiatan hari ini</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body pt-0">
              <div class="row">
                <div class="col-12">

                  {{-- Modal Delete --}}
                  <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content border-danger">
                              <div class="modal-header bg-danger">
                                <h4 class="modal-title"><b><i class="fa fa-exclamation-circle mr-2"></i> Konfrimasi</b></h4>
                              </div>
                              <div class="modal-body">
                                  Apakah anda yakin akan menghapus "<span id="record"></span>" ?
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-outline-secondary btn-round" data-dismiss="modal"><i class="fa fa-remove mr-2"></i> Tidak</button>
                                  <a class="btn btn-outline-danger btn-round btn-ok"><i class="fa fa-trash mr-3"></i>Ya</a>
                              </div>
                          </div>
                      </div>
                  </div>
                  {{-- End Modal delete --}}

                  {{-- notif hapus data --}}
                  @if (session()->get('ksuccess'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                      {{ session()->get('ksuccess')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  @if (session()->get('kerror'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                      {{ session()->get('kerror')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
                  {{-- end notif --}}

                  <div class="table-responsive">
                    <table class="table table-hover table-act table-fixed">
                      <thead>
                        <tr>
                          <th scope="col" class="col-1">NO</th>
                          <th scope="col" class="col-11">NAMA KEGIATAN</th>
                        </tr>
                      </thead>
                      <tbody style="height: 200px">

                        @if (count($kegiatan) > 0)
                          @foreach ($kegiatan as $item)
                            <tr>
                              <th scope="col" class="col-1">#</th>
                              <td class="col-11">
                                <div class="wrap">
                                  {{$item->title}}
                                  <div class="btn-grub">
                                    <a href ="" class="btn btn-info btn-sm btn-act"><i class="fa fa-eye"></i></a>
                                    <a href ="" class="btn btn-primary btn-sm btn-act btn_edit"><i class="fa fa-pencil"></i></a>
                                    <a href="" class="btn btn-danger btn-sm btn-act" data-href="{{ route('deleteKegiatan', $item->id) }}" data-toggle="modal" data-target="#confirm-delete" data-iden="{{ $item->title }}"><i class="fa fa-trash"></i></a>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          @endforeach
                        @else
                            <tr>
                              <th scope="col" class="col-1"></th>
                              <td class="col-11 text-center text-danger">.: Data masih kosong :.</td>
                            </tr>
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-footer">
                <a href="{{route('addKegiatanHarian', $idabsen)}}" class="btn btn-round pull-right {{ ($idabsen == 'null' ) ? 'btn-outline-secondary disabled' : 'btn-primary' }}"><i class="fa fa-plus mr-3"></i>Tambah Kegiatan</a>
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

@push('bodyResource')
  <!-- Toastr -->
  <script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
  <script>
    //delete modal
    $('#confirm-delete').on('show.bs.modal', function(e) {
      $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
      var rec = $(e.relatedTarget).data('iden');
      $(this).find('#record').text(rec);
    });

    //absen submit
    // const form = document.querySelector('#fabsen');
    // form.addEventListener('submit', (e)=>{
    //   e.preventDefault();
    //   toastr.success('Rencana mau pake javascript tapi malas');
    // });

    // absen.addEventListener('click', (e)=>{
    //   e.preventDefault();
    //   toastr.success('Lorem ipsum dolor sit amet, consetetur sadipscing elitr.');
    // });
  </script>
@endpush