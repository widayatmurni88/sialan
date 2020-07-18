@extends('../baseLayout')

@push('headResource')
    
@endpush

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12 mx-auto">
      <div class="card">
        <div class="card-header">
          <b class="card-title">Tambah User Level</b>
        </div>
        <div class="card-body pt-5">

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

          <form action="{{ route('postTambahLevel')}}" method="post">
            {{ csrf_field() }}
            <div class="form-group row">
              <label for="level" class="col-md-3 form-label text-right">Lavel User Akses</label>
              <div class="col-md-9">
                <input type="text" name="level" id="level" class="form-control {{ $errors->has('level') ? 'is-invalid' : ''}}" placeholder="Nama Level Akses" value="{{ old('level')}}">
                @if ($errors->has('level'))
                  <div class="invalid-feedback">
                    {{ $errors->first('level')}}
                  </div>
                @endif
              </div>
            </div>

            <div class="form-group row mt-5">
              <div class="col-md-12 text-center">
                <a href="{{ route('userlevel')}}" class="btn btn-outline-secondary btn-round"><i class="fa fa-chevron-circle-left mr-3"></i>Kembali</a>
                <button type="submit" class="btn btn-success btn-round"><i class="fa fa-save mr-3"></i>Simpan</button>
              </div>
            </div>

          </form>

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