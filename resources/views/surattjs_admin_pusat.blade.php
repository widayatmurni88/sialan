@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'surattjs'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pernyataan Tanggung Jawab</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><i class="fa fa-file mr-3"></i><b>Daftar Pernyataan</b></h3>
            </div>
            <div class="card-body">
              
              <div class="row">

                <div class="col-md-12">

                  <form action="{{ route('getPernyataanPernyaanPerInstansi')}}" method="post">

                    {{ csrf_field() }}
                    
                    <div class="form-group row">

                      <div class="col-lg-3 col-sm-10">
                        <select name="tahun" id="tahun" class="form-control {{ $errors->has('tahun') ? 'is-invalid' : ''}}">
                          @for ($i = 0; $i < 5; $i++)
                            <option value="{{ $i + 2020 }}" {{ ($periode==($i+2020)) ? 'selected' : '' }}>{{ $i + 2020 }}</option>
                          @endfor
                        </select>
                      </div>

                      <div class="col-sm-6">
                        <select name="instansi" id="isntansi" class="form-control {{ $errors->has('tahun') ? 'is-invalid' : ''}}">
                          <option value="">---</option>
                          @foreach ($instansi as $item)
                              <option value="{{ $item->id }}" {{ ($cur_instansi == $item->id) ? 'selected' : ''}}>{{ $item->nama_ins }}</option>
                          @endforeach
                        </select>
                      </div>
                      
                      <div class="col-sm-2">
                        <button type="submit" class="btn btn-outline-secondary btn-round"><i class="fa fa-search"></i></button>
                      </div>

                    </div>

                  </form>
  
                </div>

                <div class="col-12">

                  @if (session()->get('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session()->get('success')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
  
                  @if (session()->get('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ session()->get('error')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
  
                  <div class="table-responsive mt-4">
                    <table class="table table-hover table-act table-fixed">
                      <thead>
                        <tr>
                          <th scope="col" class="col-1">NO</th>
                          <th scope="col" class="col-11">PERNYATAAN UNTUK PERIODE</th>
                        </tr>
                      </thead>
                      <tbody style="height: 300px">
                      
                      @if ($data != null)

                      @if (count($data)>0)
                        @php
                        $i=1;
                        @endphp
                        @foreach ($data as $item)
                        
                          <tr>
                            <th scope="col" class="col-1">{{ $i++}}</th>
                            <td class="col-11">
                              <div class="wrap">
                                {{ date('F Y', strtotime($item->periode)) }}
                                <div class="btn-grub">
                                  <a href ="{{ asset('docs/pernyataan/'.$item->link) }}" class="btn btn-info btn-sm btn-act rounded-circle"><i class="fa fa-eye" target="_blank"></i></a>

                                  <a href ="{{ route('printSurattj', $item->link) }}" class="btn btn-success btn-sm btn-act rounded-circle"><i class="fa fa-print" target="_blank"></i></a>

  
                                  {{-- <a href ="{{ route('editPernyataan', [date('Y', strtotime($item->periode)), $item->id]) }}" class="btn btn-primary btn-sm btn-act btn_edit rounded-circle"><i class="fa fa-pencil"></i></a>
                                  
                                  <a href="" class="btn btn-danger btn-sm btn-act rounded-circle" data-href="{{ route('deletePernyataan', $item->id)}}" data-toggle="modal" data-target="#confirm-delete" data-iden="{{ date('F Y', strtotime($item->periode)) }}"><i class="fa fa-trash"></i></a> --}}
                                </div>
                              </div>
                            </td>
                          </tr>
  
                        @endforeach
                      
                      @else
                      <tr>
                        <td colspan="2" class="col-12 text-danger text-center"> .: Data Tidak Ditemukan :.</td>
                      </tr>
                      @endif
  
                      @else

                        <tr>
                          <td colspan="2" class="col-12 text-danger text-center"> .: Data Tidak Ditemukan :.</td>
                        </tr>

                      @endif
  
                      </tbody>
                    </table>
                  </div>
                  
                </div>


              </div>

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