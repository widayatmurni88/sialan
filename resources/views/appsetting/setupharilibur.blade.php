@extends('../baseLayout')

@section('content')
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog border-danger">
        <div class="modal-content">
            <div class="modal-header bg-danger">
              <h4><b><i class="fa fa-exclamation-circle mr-2"></i> Konfrimasi</b></h4>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus <span id="record"></span> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-round" data-dismiss="modal"><i class="fa fa-remove mr-2"></i> Batal</button>
                <a class="btn btn-outline-danger btn-round btn-ok"><i class="fa fa-trash mr-2"></i>Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12 mb-4">
      <h3 class="text-center mb-3"><b>Daftar Hari LIbur Nasional</b></h3>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="col-sm-3 mt-2">
          <form action="{{ route('getHariLiburByTahun') }}" method="post">
            {{ csrf_field() }}
            <div class="input-group">
              <select class="custom-select" name="tahun">
                <option value="2020" @if ($thn=='2020')
                    selected
                  @endif>2020
                </option>
                <option value="2021" @if ($thn=='2021')
                    selected
                  @endif>2021
                </option>
                <option value="2022" @if ($thn=='2022')
                    selected
                  @endif>2022
                </option>
                <option value="2023" @if ($thn=='2023')
                    selected
                  @endif>2023
                </option>
              </select>
              <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-sm-9 mt-2">
          <a href="{{ route('addHariLibur', $thn) }}" class="btn btn-success btn-round float-right"><i class="fa fa-plus mr-3"></i>Tambah Hari Libur</a>
        </div>
      </div>
    </div>
    <div class="col-md-12 mt-3">
      <div class="table-responsive">
        <table class="table table-hover table-act table-fixed">
          <thead>
            <tr>
              <th scope="col" class="col-1">NO</th>
              <th scope="col" class="col-4">TANGGAL</th>
              <th scope="col" class="col-7">KETERANGAN</th>
            </tr>
          </thead>
          <tbody>
            @php
              $i=1;  
            @endphp
            @foreach ($dataLibur as $item)
                <tr>
                  <th scope="row" class="col-1">{{ $i++ }}</th>
                  <td class="col-4">{{ date('d-m-Y', strtotime($item->tgl))}}</td>
                  <td class="col-7">
                    <div class="wrap">
                      {{ $item->ket}} 
                      <div class="btn-grub">
                        <a href ="{{ route('editHariLibur', [$thn, $item->id]) }}" class="btn btn-primary btn-sm btn-act btn_edit"><i class="fa fa-pencil"></i></a>

                        <a href="" class="btn btn-danger btn-sm btn-act" data-href="{{ route('deleteLibur',[$thn, $item->id])}}" data-toggle="modal" data-target="#confirm-delete" data-whatever="{{ $item->tgl}}"><i class="fa fa-trash"></i></a>
                      </div>
                    </div>
                  </td>
                </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection

@push('bodyResource')
<script  type="text/javascript" src="{{ asset('js/appsetting.js')}}"></script>
<script  type="text/javascript">
  $('#confirm-delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
  });
</script>
@endpush