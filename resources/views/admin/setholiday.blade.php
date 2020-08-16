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

              <!-- Modal delete dialog-->
              <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content border-danger">
                        <div class="modal-header bg-danger">
                          <h4 class="modal-title"><b><i class="fa fa-exclamation-circle mr-2"></i> Konfrimasi</b></h4>
                        </div>
                        <div class="modal-body">
                            Apakah anda yakin akan menghapus libur tanggal "<span id="record"></span>" ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary btn-round" data-dismiss="modal"><i class="fa fa-remove mr-2"></i> Tidak</button>
                            <a class="btn btn-outline-danger btn-round btn-ok"><i class="fa fa-trash mr-3"></i>Ya</a>
                        </div>
                    </div>
                </div>
              </div>
              <!-- End modal delete dialog-->

              <div class="row">
                <div class="col-md-6">
                  
                  <form action="{{ route('postsearchharilibur') }}" method="post">
                    
                    {{ csrf_field() }}

                    <div class="row">
                      <div class="col-md-7">

                        <div class="form-group">
                          <select name="bln" id="bln" class="form-control">
                            <option value="">---</option>
                            @for ($i = 0; $i < count(bulan); $i++)
                                <option value="{{ $i+1 }}" {{ ($bln==$i+1) ? 'selected' : ''}}>{{bulan[$i]}}</option>
                            @endfor
                          </select>
                        </div>

                      </div>
                      <div class="col-md-4">

                        <div class="form-group">
                          <select name="thn" id="thn" class="form-control">
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
                  
                  </form>

                </div>

                <div class="col-md-6">
                  <a href="{{ route('tambahlibur', $thn)}}" class="btn btn-primary btn-round float-right"><i class="fa fa-plus mr-3"></i>Tambah Libur</a>
                </div>

                <div class="col-12 mt-3">

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
                        @if (count($dataLibur))
                          @php
                              $i=1;
                          @endphp
                          @foreach ($dataLibur as $item)
                              <tr>
                                <th scope="row" class="col-1">{{ $i++ }}</th>
                                <td class="col-3">{{ date('d-m-Y', strtotime($item->tgl))}}</td>
                                <td class="col-8">
                                  <div class="wrap">
                                    {{ $item->ket}}
                                    <div class="btn-grub">
                                      {{-- <a href ="" class="btn btn-primary btn-sm btn-act rounded-circle btn_edit"><i class="fa fa-pencil"></i></a> --}}
                                      <a href="" class="btn btn-danger btn-sm  rounded-circle  btn-act" data-href="{{ route('deleteharilibur', $item->id)}}" data-toggle="modal" data-target="#confirm-delete" data-iden="{{ date('d-m-Y', strtotime($item->tgl))}}"><i class="fa fa-trash"></i></a>
                                    </div>
                                  </div>
                                </td>
                              </tr>
                          @endforeach

                        @else
                          <tr>
                            <th scope="col" class="col-1"></th>
                            <td class="col-11 text-danger text-center">Data libur tidak ditemukan.</td>
                          </tr>
                        @endif
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
