@php
    const bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $curbulan = date('m', strtotime(now()))-1;
    $curtahun = date('Y', strtotime(now()));
@endphp

@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'laporankehadiran'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Kehadiran dan Kegiatan Pegawai</h1>
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
              <h3 class="card-title"><i class="fa fa-tasks mr-3"></i> Laporan Kehadiran</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <form action="{{ route('kinerjapegawaiall')}}" method="post">
                {{ csrf_field() }}

                <div class="form-group row mb-0">
                  <div class="col-md-4">
                    <div class="row">
                      <div class="col-sm-6 mt-2 mb-2">
                        <select name="bulan" id="bulan" class="form-control">
                          @for ($i = 0; $i < count(bulan); $i++)
                          <option value="{{ $i+1 }}" {{ ($curbulan == $i) ? 'selected' : '' }}>{{ bulan[$i]}}</option>
                          @endfor
                        </select>
                      </div>
                      <div class="col-sm-6 mt-2 mb-2">
                        <select name="tahun" id="" class="form-control">
                          @for ($i = 0; $i < 5; $i++)
                          <option value="{{ $i+2020 }}" {{ ($curtahun == $i+2020) ? 'selected' : '' }}>{{ $i+2020}}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6 mb-2 mt-2">
                    <select name="instansi" id="" class="form-control {{$errors->has('instansi') ? 'selected' : ''}}">
                      <option value="">---</option>
                      @if ($instansi !=null)
                        @foreach ($instansi as $item)
                          <option value="{{ $item->id}}" {{ ($curinstansi == $item->id ) ? 'selected' : ''}} >{{ $item->nama_ins }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="col-md-1 mt-2 mb-2">
                    <button type="submit" class="btn btn-secondary btn-round"><i class="fa fa-search"></i></button>
                  </div>
                </div>

              </form>

              <div class="table-responsive" style="height: 400px;">
                
                <table class="table table-bordered table-hover text-nowrap">

                    <thead>
                      <tr>
                        <th rowspan="2" class="align-middle text-center">NO</th>
                        <th rowspan="2" class="align-middle text-center">NAMA <br> PANGKAT/GOL <br> NIP</th>
                        <th colspan="{{ cal_days_in_month(CAL_GREGORIAN, $absen['periode_bln'], $absen['periode_thn']) }}" class="align-middle text-center">TANGGAL</th>
                        <th rowspan="2" class="align-middle text-center">JML <br> HADIR</th>
                      </tr>
                      <tr>
                        @for ($i = 0; $i < cal_days_in_month(CAL_GREGORIAN, $absen['periode_bln'], $absen['periode_thn']); $i++)
                          <th class="align-middle text-center">{{$i+1}}</th>
                        @endfor
                      </tr>
                    </thead>
  
                    <tbody>

                      @if ($absen['kehadiran'] == null)
                          
                          <tr>
                            <td colspan="{{ cal_days_in_month(CAL_GREGORIAN, $absen['periode_bln'], $absen['periode_thn']) + 3 }}" class="text-center"> .: Data kosong :.</td>
                          </tr>

                      @else
                        
                        @php
                          $no=1;
                        @endphp

                        @foreach ($absen['kehadiran'] as $item)

                          <tr>
                            <td class="text-center">{{ $no++ }}</td>
                            <td style="line-height: 1">
                              <b>{{ $item['nama']}}</b>
                              <br>
                              <small>{{ $item['pangkat']}}</small><br>
                              <small>{{ $item['nid']}}</small>
                            </td>

                            @php
                              $index = 0 ;
                            @endphp
                            @for ($i = 0; $i < cal_days_in_month(CAL_GREGORIAN, $absen['periode_bln'], $absen['periode_thn']); $i++)
                             
                              @if ($index < count($item['hadir']))
                                @if (date('Y-m-d', strtotime($item['hadir'][$index][0])) == date('Y-m-d', strtotime($i+1 .'-'.$absen['periode_bln'].'-'.$absen['periode_thn'])))
                                  <td>&#10004;</td>
                                  @php
                                    $index++
                                  @endphp
                                @else
                                  <td>-</td>
                                @endif
                                
                              @else
                                <td>-</td>
                              @endif

                            @endfor

                            <td class="text-center">{{count($item['hadir'])}}</td>
                          </tr>

                        @endforeach
                      @endif


                    </tbody>
                      
                </table>

              </div>

              <div class="row mt-4">
                <div class="col-12">
                  <a href= "
                  @if ($curinstansi != null)
                    {{ route('printlaporan', [$curinstansi, $absen['periode_bln'], $absen['periode_thn']]) }}
                  @endif
                  "
                  class="btn btn-primary btn-round pull-right" target="_blank"><i class="fa fa-print mr-3"></i>Cetak</a>
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
 
@endpush