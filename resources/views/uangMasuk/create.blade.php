@extends('layouts.templates')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('uangmasuk.index') }}">Uang Masuk</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
     
        
        <form action="{{ route('uangmasuk.store') }}" method="post" id="myform">
          @csrf
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3>Tambah Data ~ Uang Masuk</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="sumber">Sumber Uang</label>
                        <input type="text" name="sumber" id="sumber" class="form-control" autofocus value="{{ old('sumber') }}">
                        @error('sumber')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nominal">Nominal Uang</label>
                        <div class="input-group">
                            <div class="input-group-prepend"><span class="input-group-text">
                              <span class="c-icon" style="margin-top:-8px">
                                RP
                              </span></span></div>
                              <input class="form-control" id="nominalinput" type="text" value="{{ old('nominal') }}">
                              <input class="form-control" id="nominal" type="hidden" name="nominal" value="{{ old('nominal') }}">
                              
                          </div>
                          @error('nominal')
                                      <span class="text-danger text-error" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                              @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="tanggal">Tanggal Masuk</label>
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
                        <a href="{{ route('uangmasuk.index') }}" class="btn btn-danger">
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