@extends('layouts.templates')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('kajian.index') }}">Kajian</a></li>
    <li class="breadcrumb-item active">Tambah Data</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="fade-in">
     
        
        <form action="{{ route('kajian.store') }}" method="post" id="myform">
          @csrf
          <div class="row">
            <div class="col-12 col-md-6">
              <div class="card">
                <div class="card-header">
                  <h3>Tambah Data ~ Kajian</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="tempat">Tempat</label>
                        <input type="text" name="tempat" id="tempat" class="form-control" autofocus value="{{ old('tempat') }}">
                        @error('tempat')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="tema">Tema</label>
                        <input type="text" name="tema" id="tema" class="form-control" autofocus value="{{ old('tema') }}">
                        @error('tema')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="ustadz">Ustadz</label>
                        <input type="text" name="ustadz" id="ustadz" class="form-control" autofocus value="{{ old('ustadz') }}">
                        @error('ustadz')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="jamaah">Jumlah Jamaah</label>
                        <input type="text" name="jamaah" id="jamaah" class="form-control" autofocus value="{{ old('jamaah') }}">
                        @error('jamaah')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>
               
                    <div class="form-group">
                        <label for="tanggal">Tanggal Kajian</label>
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
          $('#nominalinput').autoNumeric('init');   
          $('#tanggal').flatpickr() ; 
      });
    </script>
@endsection