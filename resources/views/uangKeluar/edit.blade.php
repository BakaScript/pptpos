@extends('layouts.templates')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('uangkeluar.index') }}">Uang Keluar</a></li>
    <li class="breadcrumb-item active">Edit Data</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
     
        
        <form action="{{ route('uangkeluar.update', $uangkeluar->id) }}" method="post" id="myform">
          @csrf
          @method('PATCH')
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3>Edit Data ~ Uang Keluar</h3>
                </div>
                <div class="card-body">
                   
                    <div class="form-group">
                        <label for="nominal">Nominal Uang</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">
                              <span class="c-icon" style="margin-top:-8px">
                                RP
                              </span></span></div>
                              <input class="form-control" id="nominalinput" type="text" value="{{ $uangkeluar->nominal }}">
                              <input class="form-control" id="nominal" type="hidden" name="nominal" value="{{ $uangkeluar->nominal }}">
                              
                          </div>
                          @error('nominal')
                                      <span class="text-danger text-error" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                              @enderror
                    </div>

                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <textarea name="keterangan" id="keterangan" class="form-control" style="resize:none">{{ $uangkeluar->keterangan }}</textarea>
                        @error('keterangan')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="tanggal">Tanggal Keluar</label>
                        <input type="text" name="tanggal" id="tanggal" class="form-control" value="{{ $uangkeluar->tanggal_keluar }}">
                        @error('tanggal')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                      </div>
                </div>
                <div class="card-footer">
                    <div class="form-group text-right">
                        <a href="{{ route('uangkeluar.index') }}" class="btn btn-danger">
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
          $('#nominalinput').autoNumeric('init');   
          $('#tanggal').flatpickr() ; 
      });

      $('#nominalinput').on('focusout', function(){
        $('#nominal').val($('#nominalinput').autoNumeric('get')) ;
      }) ;

      $('#nominalinput').on('focusin', function(){
        $('#nominalinput').val($('#nominal').val()) ;
      }) ;
    </script>
@endsection