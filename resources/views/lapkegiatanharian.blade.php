@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'lapgiatharian'])

@push('headResource')
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fullcalendar/main.css')}}">
  <script src="{{ asset('adminlte/plugins/fullcalendar/main.js')}}"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');
        
        //get data kehadiran
        let request = new XMLHttpRequest();
        let dataHadir = [];
        request.onreadystatechange = () => {
          if (this.readyState == 4 && this.status == 200) {
            dataHadir = request.responseText();
            console.log(dataHadir);
          }
        }
        request.open("GET",'http://localhost:8000/DailyActivity/getReportAbsenPerMonth/123', true);
        request.send();



        let calendar = new FullCalendar.Calendar(calendarEl, {

          headerToolbar: {
            left: '',
            center: 'title',
            right: ''
          },

          displayEventTime: false, // don't show the time column in list view
          selectable: true,
          height: 550,

          events : 'http://localhost:8000/DailyActivity/getReportAbsenPerMonth/123',

        });
        calendar.render();
      });

  </script>
@endpush

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Laporan Kegiatan Harian</h1>
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
            <div class="card-body">
              <div id="calendar"></div>
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