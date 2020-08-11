<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Absen</title>
  <!--Resource-->
  <style>
    *{
      margin:8px;
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }
    body{
      font-family:Arial, Helvetica, sans-serif;
      font-size: .7rem;
    }
    table{
      width: 100%;
      border-collapse: collapse;
      white-space: nowrap;
    }
    table, th, td {
      border: 1px solid black;
    }
    th, td{
      width: 15px;
    }
    .text-center{
      text-align: center; 
    }
    .tgl{
    }
    .wrap-box {
        padding-top: 40px;
        position: relative;
        width: 100%;
        font-size: 0.8rem;
      } 

    .box {
        position: absolute;
        top: 10px;
        right: 0;
        width: 400px;
        height: 30px;
        text-align: center;
      }

    .page-break {
      page-break-after: always;
      margin: -8px;
      overflow: hidden;
    } 
    

  </style>
  
</head>
<body>
  @php
    $jmlHari = cal_days_in_month(CAL_GREGORIAN, $data['periode_bln'], $data['periode_thn']);
    $periode = '01-'.$data['periode_bln'].'-'.$data['periode_thn'];
    const bulan = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEEMBER']
  @endphp

  <h3 class="text-center">LAPORAN KEHADIRAN PEGAWAI BULAN {{ bulan[intval(date('m', strtotime($periode))) - 1 ] }} TA. {{ date('Y', strtotime($periode)) }} </h3>
  <p>NAMA INSTANSI : {{ $data['instansi'] }}</p>
  
  
  <table>
    <thead>
      <tr>
        <th rowspan="2" class="text-center" style="width: 20px">NO</th>
        <th rowspan="2" class="text-center">NAMA <br> PANGKAT/GOL <br> NIP</th>
        <th colspan="{{ $jmlHari }}" class="text-center">TANGGAL</th>
        <th rowspan="2" class="text-center" style="width: 20px">JML <br> HADIR</th>
      </tr>
      <tr>
        @for ($i = 0; $i < $jmlHari; $i++)
          <th class="tgl">{{$i+1}}</th>
        @endfor
      </tr>
    </thead>
    <tbody>
      @if ($data['kehadiran'] == null)
      
        <tr>
          <td colspan="{{ $jmlHari + 3 }}" class="text-center"> 
            .: Data kosong :.
          </td>
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

          @for ($i = 0; $i < $jmlHari; $i++)
          
            @if ($index < count($item['hadir']))
              @if (date('Y-m-d', strtotime($item['hadir'][$index][0])) == date('Y-m-d', strtotime($i+1 .'-'.$data['periode_bln'].'-'.$data['periode_thn'])))

                <td class="text-center">&#10004;</td>
                
                @php
                $index++
                @endphp
                
              @else
              <td class="text-center">-</td>
              @endif
              
            @else
            <td class="text-center">-</td>
            @endif
          @endfor
            <td class="text-center">{{count($item['hadir'])}}</td>
        </tr>

        @endforeach
        @endif

    </tbody>
  </table>

  <div class="wrap-box">
    <div class="box">
      {{$kepala->title}}
      <br><br><br><br><br>
      {{ $kepala->name}} <br>
      {{ $kepala->pangkat.' NIP '. $kepala->id}}
    </div>
  </div>

  {{-- @if ($data['surattj']!=null)
  <div class="page-break">
    <img src="{{ public_path('docs/pernyataan/'.$data['surattj'])}}" style="">
  </div>
  @endif --}}
  
</body>
</html>