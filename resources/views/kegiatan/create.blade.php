@extends('layouts.templates')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Kegiatan</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
     
        
        <form action="{{ route('kegiatan.store') }}" method="post" id="myform">
          @csrf
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3>Tambah Data ~ Kegiatan</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="nama_kegiatan">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" autofocus value="{{ old('nama_kegiatan') }}">
                        @error('nama_kegiatan')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="estimasi_biaya">Estimasi Biaya</label>
                        <input type="text" name="estimasi_biaya_input" id="estimasi_biaya_input" class="form-control" autofocus value="{{ old('estimasi_biaya_input') }}">
                        <input type="hidden" name="estimasi_biaya" id="estimasi_biaya" class="form-control" autofocus value="{{ old('estimasi_biaya') }}">
                        @error('estimasi_biaya')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="deadline">Tanggal Deadline</label>
                        <input type="text" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}">
                        @error('deadline')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <div>
                            <input type="radio" name="status" id="rencana" value="rencana" checked>
                            <label for="rencana">Rencana</label>
                            <input type="radio" name="status" id="dilaksanakan" value="dilaksanakan">
                            <label for="dilaksanakan">Dilaksanakan</label>
                        </div>
                        {{-- <input type="text" name="status" id="status" class="form-control" autofocus value="{{ old('status') }}"> --}}
                        @error('status')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group" id="section_tanggal_dilaksanakan">
                        <label for="tanggal">Tanggal Dilaksanakan</label>
                        <input type="text" name="tanggal" id="tanggal" class="form-control" value="{{ old('tanggal') }}">
                        @error('tanggal')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="form-group text-right">
                        <a href="{{ route('kajian.index') }}" class="btn btn-danger">
                          <i class="fa fa-arrow-left"></i>
                          &nbsp;
                          <span class="text-white">Kembali</span>
                        </a>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-save"></i>
                          &nbsp; 
                          <span>Simpan</span>
                        </button>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </form>
    </div>
  </div>
@endsection

@section('scripts')
    <script>
      $(function($) {
          $('#estimasi_biaya_input').autoNumeric('init');   
          $('#deadline').flatpickr() ; 
          $('#tanggal').flatpickr() ; 
          $('#section_tanggal_dilaksanakan').css('display', 'none') ;
      });

      $('#estimasi_biaya_input').on('focusout', function(){
        $('#estimasi_biaya').val($('#estimasi_biaya_input').autoNumeric('get')) ;
      }) ;

      $('#estimasi_biaya_input').on('focusin', function(){
        $('#estimasi_biaya_input').val($('#estimasi_biaya').val()) ;
      }) ;

      $('#dilaksanakan').click(function(){
          if($('#dilaksanakan:checked')) {
            $('#section_tanggal_dilaksanakan').css('display', 'block') ;
          } 
      }) ;

      $('#rencana').click(function(){
          if($('#rencana:checked')) {
            $('#section_tanggal_dilaksanakan').css('display', 'none') ;
          } 
      })

    </script>
@endsection