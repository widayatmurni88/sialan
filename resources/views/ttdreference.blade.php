@extends('layout.base')

@section('content')
@include('layout.nav')
@include('layout.sidebar', ['menu' => 'ttdreference'])
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Refensi Penanda Tangan</h1>
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
              <h3 class="card-title"><b>Referensi Penanda Tangan</b></h3>
            </div>
            <div class="card-body">
              
              <div class="row">

                <div class="col-md-6">
                  <form action="{{ route('simpanreference') }}" method="post">
                    {{ csrf_field() }}

                  <div class="form-group">
                    <label for="title" class="form-label">Atas Nama</label>
                    <input type="text" name="title" id="title" class="form-control {{ $errors->has('title') ? 'is-invalid' : ''}}" placeholder="Kepala Universitas ABC" required autofocus>
                  </div>

                  <div class="form-group">
                    <label for="person" class="form-label">Nama Pejabat</label>
                    <select name="person" id="person" class="form-control {{ $errors->has('person') ? 'is-invalid' : ''}}" required>
                      <option value="">---</option>
                      @foreach ($persons as $item)
                        <option value="{{ $item->id}}">{{ $item->name }}</option>
                      @endforeach
                    </select>
                  </div>

                </div>

                <div class="col-md-6">
                  <div class="card bg-secondary">
                    <div class="card-body text-center">
                      @if ($kepala != null)
                        {{$kepala->title}}
                        <br><br><br><br>
                        {{ $kepala->name}}
                        <br>
                        {{ $kepala->pangkat}}
                      @endif
                    </div>
                  </div>
                </div>

                <div class="col-12 mt-4">
                  <button type="submit" class="btn btn-success btn-round float-right"><i class="fa fa-save mr-3"></i>Terapkan</button>
                </div>
              </form>
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