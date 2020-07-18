@extends('../baseLayout')

@push('headResource')
    
@endpush

@section('content')

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header bg-danger">
              <h4 class="modal-title"><b><i class="fa fa-exclamation-circle mr-2"></i> Konfrimasi</b></h4>
            </div>
            <div class="modal-body">
                Apakah anda yakin akan menghapus user "<span id="record"></span>" ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary btn-round" data-dismiss="modal"><i class="fa fa-remove mr-2"></i> Tidak</button>
                <a class="btn btn-outline-danger btn-round btn-ok"><i class="fa fa-trash mr-3"></i>Ya</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
          <b class="card-title">User Level</b>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12 text-center">
              <h3>Daftar User Level</h3>
            </div>
            <div class="col-md-12 mt-4">
              <a href="{{ route('tambahlevel')}}" class="btn btn-primary btn-round float-right"><i class="fa fa-plus mr-3"></i>Tambah Level</a>
            </div>
            <div class="col-md-12 mt-4">
              <div class="table-responsive">
                <table class="table table-hover table-act table-fixed">
                  <thead>
                    <tr>
                      <th scope="col" class="col-1">#</th>
                      <th scope="col" class="col-11">LEVEL AKSES</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($level)>0)
                      @foreach ($level as $item)
                          <tr>
                            <th scope="row" class="col-1">#</th>
                            <td class="col-11">
                              <div class="wrap">
                                {{ $item->level}} 
                                <div class="btn-grub">
                                  <a href ="{{ route('editlevel', $item->id) }}" class="btn btn-primary btn-sm btn-act btn_edit"><i class="fa fa-pencil"></i></a>

                                  <a href="" class="btn btn-danger btn-sm btn-act" data-href="" data-toggle="modal" data-target="#confirm-delete" data-whatever="{{ $item->level}}"><i class="fa fa-trash"></i></a>
                                </div>
                              </div>
                            </td>
                          </tr>
                      @endforeach
                    @else
                      <tr>
                        <th scope="col" class="col-1"></th>
                        <td class="col-11 text-danger text-center">Data user level tidak ditemukan.</td>
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