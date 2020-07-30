@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'kinerja'])
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
              <h3 class="card-title"><i class="fa fa-tasks mr-3"></i> Laporan Kehadiran {{ $data['instansi']}}</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">

              <form action="{{ route('kinerjapegawaiinstansi')}}" method="post">
                {{ csrf_field() }}
                
                <div class="form-group row">
                  <label for="bulan" class="col-form-label col-2 pt-2">Periode</label>
                  <div class="col-sm-3 pt-2">
                    <select name="bulan" id="bulan" class="form-control">
                      <option value="0" {{ ($data['periode_bln'] == 0) ? 'selected' : ''}}>---</option>
                      <option value="1" {{ ($data['periode_bln'] == 1) ? 'selected' : ''}}>Januari</option>
                      <option value="2" {{ ($data['periode_bln'] == 2) ? 'selected' : ''}}>Februari</option>
                      <option value="3" {{ ($data['periode_bln'] == 3) ? 'selected' : ''}}>Maret</option>
                      <option value="4" {{ ($data['periode_bln'] == 4) ? 'selected' : ''}}>April</option>
                      <option value="5" {{ ($data['periode_bln'] == 5) ? 'selected' : ''}}>Mei</option>
                      <option value="6" {{ ($data['periode_bln'] == 6) ? 'selected' : ''}}>Juni</option>
                      <option value="7" {{ ($data['periode_bln'] == 7) ? 'selected' : ''}}>Juli</option>
                      <option value="8" {{ ($data['periode_bln'] == 8) ? 'selected' : ''}}>Agustus</option>
                      <option value="9" {{ ($data['periode_bln'] == 9) ? 'selected' : ''}}>September</option>
                      <option value="10" {{ ($data['periode_bln'] == 10) ? 'selected' : ''}}>Oktober</option>
                      <option value="11" {{ ($data['periode_bln'] == 11) ? 'selected' : ''}}>November</option>
                      <option value="12" {{ ($data['periode_bln'] == 12) ? 'selected' : ''}}>Desember</option>
                    </select>
                  </div>
                  <div class="col-sm-2 pt-2">
                    <select name="tahun" id="tahun" class="form-control">
                      <option value="0">---</option>
                      <option value="2020" {{ ($data['periode_thn'] == 2020) ? 'selected' : ''}}>2020</option>
                      <option value="2021" {{ ($data['periode_thn'] == 2021) ? 'selected' : ''}}>2021</option>
                      <option value="2022" {{ ($data['periode_thn'] == 2022) ? 'selected' : ''}}>2022</option>
                      <option value="2023" {{ ($data['periode_thn'] == 2023) ? 'selected' : ''}}>2023</option>
                      <option value="2024" {{ ($data['periode_thn'] == 2024) ? 'selected' : ''}}>2024</option>
                      <option value="2025" {{ ($data['periode_thn'] == 2025) ? 'selected' : ''}}>2025</option>
                    </select>
                  </div>
                  <div class="col-md-1 pt-2">
                    <button type="submit" class="btn btn-outline-primary btn-round"><i class="fa fa-search"></i></button>
                  </div>
                </div>

              </form>

              <div class="table-responsive" style="height: 400px;">
                
                <table class="table table-bordered table-hover text-nowrap">
  
                    <thead>
                      <tr>
                        <th rowspan="2" class="align-middle text-center">NO</th>
                        <th rowspan="2" class="align-middle text-center">NAMA <br> PANGKAT/GOL <br> NIP</th>
                        <th colspan="{{ cal_days_in_month(CAL_GREGORIAN, $data['periode_bln'], $data['periode_thn']) }}" class="align-middle text-center">TANGGAL</th>
                        <th rowspan="2" class="align-middle text-center">JML <br> HADIR</th>
                      </tr>
                      <tr>
                        @for ($i = 0; $i < cal_days_in_month(CAL_GREGORIAN, $data['periode_bln'], $data['periode_thn']); $i++)
                          <th class="align-middle text-center">{{$i+1}}</th>
                        @endfor
                      </tr>
                    </thead>
  
                    <tbody>

                      @if ($data['kehadiran'] == null)
                          
                          <tr>
                            <td colspan="{{ cal_days_in_month(CAL_GREGORIAN, $data['periode_bln'], $data['periode_thn']) + 3 }}" class="text-center"> .: Data kosong :.</td>
                          </tr>

                      @else
                        
                        @php
                          $no=1;
                        @endphp

                        @foreach ($data['kehadiran'] as $item)

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
                            @for ($i = 0; $i < cal_days_in_month(CAL_GREGORIAN, $data['periode_bln'], $data['periode_thn']); $i++)
                             
                              @if ($index < count($item['hadir']))
                                @if (date('Y-m-d', strtotime($item['hadir'][$index][0])) == date('Y-m-d', strtotime($i+1 .'-'.$data['periode_bln'].'-'.$data['periode_thn'])))
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
                  <a href="{{ route('printlaporan', [$data['id_instansi'], $data['periode_bln'], $data['periode_thn']])}}" class="btn btn-primary btn-round pull-right" target="_blank"><i class="fa fa-print mr-3"></i>Cetak</a>
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