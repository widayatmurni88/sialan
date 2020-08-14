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
            <div class="card">
              
              <div class="card-header p-3 bg-info">
                
                <div class="pt-5 pb-3">
                  <div id="jam" style="font-weight: bold; font-size: 38px; text-align: center; line-height: 2rem">
                    00:00:00
                  </div>
                  <div id="tgl" style="text-align: center">
                    {{ get_hari_from_day(date('D', strtotime(now()))).', '. date('d-m-Y', strtotime(now()))}}
                  </div>
                </div>

                @if (session()->get('status'))
                  <div class="callout callout-success text-dark">
                    <i class="fa fa-check mr-3"></i>{{ session()->get('message') }}
                  </div>
                @endif
                <div class="card mb-0">
                  <div class="card-body">
  
                    <div class="group-item row mt-4">
                      <small class="text-danger">
                        <ul>
                          <li>Absen dimulai pada jam 07:30:00</li>
                          <li>Selesai kegiatan mulai jam 16:00:00</li>
                          <li>Rincian kegietan dapat diisi setelah anda pulang</li>
                        </ul>
                      </small>
                    </div>
  
                    <div class="group-item row pt-3">

                        @php
                          if ( date('His', strtotime(now())) >= date('His', strtotime(jammasuk)) ){
                            $waktumasuk = true;
                          }else{
                            $waktumasuk = false;
                          }
                          
                          if ( date('His', strtotime(now())) >= date('His', strtotime(jampulang))){
                            $waktupulang = true;
                          }else{
                            $waktupulang = false;
                          }
                        @endphp


                        <div class="col-md-12 col-lg-6">
                          
                          <form action="{{ route('absensi')}}" method="post" id="fabsen">
                            
                            {{ csrf_field() }}
                            <input type="hidden" name="nid" value="{{ session()->get('nid')}}">
                            <input type="hidden" name="pangkat_id" value="{{ session()->get('id_pangkat')}}">
                            <input type="hidden" name="instansi_id" value="{{ session()->get('id_instansi')}}">

                            <button type="submit" id="btn_absen" class="btn {{ !$waktumasuk ? 'btn-outline-secondary' : 'btn-primary' }} btn-block btn-round mt-1 mr-1" {{ !$waktumasuk ? 'disabled' : ''}}><i class="fa fa-check mr-2"></i>Masuk</button>

                          </form>

                        </div>

                        <div class="col-md-12 col-lg-6">

                          <form action="{{ route('absen_pulang') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id_absen" value="{{ ($idabsen!=null) ? $idabsen : '' }}">
                            <button type="submit" id="btn_absen" class="btn {{ ((!$waktupulang)|| ($idabsen==null))? 'btn-outline-secondary' : 'btn-success'}} btn-block btn-round mt-1" {{ !$waktupulang ? 'disabled' : '' }}><i class="fa fa-sign-out mr-2"></i>Pulang</button>
                          </form>

                        </div>
                    </div>

                  </div>
                </div>

              </div>
              <div class="card-body bg-light">
                <h6><i class="fa fa-rocket mr-2"></i><strong>Resume Absen</strong></h6>
                
                <ul class="nav flex-column ml-4">
                  <li class="nav-item pb-1 pt-1 border-0">
                    Waktu Masuk <span class="float-right badge bg-primary">
                      {{ ($absen != null) ? date('H:i:s',strtotime($absen->waktu_masuk)) : '00:00:00' }}
                    </span>
                  </li>
                  <li class="nav-item pb-1 pt-1 border-0">
                    Waktu Pulang <span class="float-right badge bg-success">
                      @php
                          if ($absen!=null){
                            if($absen->waktu_keluar != null){
                              echo date('H:i:s',strtotime($absen->waktu_keluar));
                            }else{
                              echo '00:00:00';
                            }
                          }else{
                            echo '00:00:00';
                          }
                      @endphp
                    </span>
                  </li>
                </ul>

              </div>
            </div>
            <!-- /.widget-user -->
          <!-- /.card -->
        </div>

        <div class="col-md-7">
          <!-- Default box -->
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-tasks mr-3"></i><b>Daftar Kegiatan Harian</b></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

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

              @if ($absen!=null)
                  @if ($absen->waktu_keluar != null)
                      <!--cek daftar kegiatan-->
                      @if (count($kegiatan) > 0)

                        <ul class="todo-list">
                          @php
                              $i=1;
                          @endphp
                          @foreach ($kegiatan as $item)
                            <li>
                              <span class="handle"><b>{{$i++}}.</b></span>
                              <span class="text">{{ $item->title}}</span>
                              <div class="tools">
                                <a href ="{{ route('previewkegiatan', $item->id)}}" ><i class="fa fa-eye"></i></a>

                                <a href ="{{ route('editkegiatanharian', $item->id)}}"><i class="fa fa-pencil"></i></a>
                                    
                                <a href="" data-href="{{ route('deleteKegiatan', $item->id) }}" data-toggle="modal" data-target="#confirm-delete" data-iden="{{ $item->title }}"><i class="fa fa-trash"></i></a>
                              </div>
                            </li>
                          @endforeach
          
                        </ul>
                
                      @else
                        <p class="text-center"><span class="badge badge-danger">Anda belum mengisi daftar kegiatan</span></p>
                      @endif


                  @else
                      <p class="text-center"><span class="badge badge-danger">Kegiatan dapat diisi setelah jam kerja berakhir</span></p>
                  @endif
              @else
                <p class="text-center text-danger"><span class="badge badge-danger">Kegiatan dapat diisi setelah mengisi absen & jam kerja berakhir</span></p>
              @endif
              
            </div>
            <div class="card-footer">
              @if ($absen != null)
                  @if ($absen->waktu_keluar != null)
                    <a href="{{route('addKegiatanHarian', $idabsen)}}" class="btn btn-round btn-primary pull-right"><i class="fa fa-plus mr-3"></i>Tambah Kegiatan</a> 
                  @else
                    <a href="#" class="btn btn-round btn-outline-secondary pull-right disabled"><i class="fa fa-plus mr-3"></i>Tambah Kegiatan</a>  
                  @endif
              @else
                <a href="#" class="btn btn-round btn-outline-secondary pull-right disabled"><i class="fa fa-plus mr-3"></i>Tambah Kegiatan</a>  
              @endif

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

    const jam = document.querySelector('#jam');
    var serverTime = <?php echo time() * 1000; ?>; //this would come from the server
    var localTime = +Date.now();
    var timeDiff = serverTime - localTime;

    setInterval(function () {
        var realtime = +Date.now() + timeDiff;
        var date = new Date(realtime);
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();
        var formattedTime = ("0" + hours).slice(-2) + ':' + ("0" + minutes).slice(-2) + ':' + ("0"+ seconds).slice(-2);
        jam.innerHTML = formattedTime;
    }, 1000);




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