@extends('layouts.templates')

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('kajian.index') }}">Kajian</a></li>
    <li class="breadcrumb-item active">Print</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">
            <div class="card">
                <div class="card-header">
                    <h2>Print Data ~ Kajian</h2>
                </div>

                <div class="card-body">
                    <form action="" method="post" id="printForm">
                        @csrf
                        <input type="hidden" name="mode" id="mode">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="tanggal_dari">Dari Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal_dari" name="tanggal_dari">
                                    @error('tanggal_dari')
                                        <span class="text-danger text-error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="tanggal_sampai">Sampai Tanggal</label>
                                        <input type="text" class="form-control" id="tanggal_sampai" name="tanggal_sampai">
                                        @error('tanggal_sampai')
                                            <span class="text-danger text-error" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            @error('error')
                                <span class="text-danger text-error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="button" onclick="pdf('download')" class="btn btn-warning text-white">
                            <i class="fa fa-download"></i> 
                            Download PDF
                        </button>
                        <button type="button" onclick="pdf('stream')" class="btn btn-primary">
                            <i class="fa fa-print"></i> 
                            Print PDF
                        </button>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function(){
            $('#tanggal_dari').flatpickr() ;
            $('#tanggal_sampai').flatpickr() ;
        }) ;

        function pdf(mode) 
        {
            $('#mode').val(mode) ;
            $('#printForm').attr('action', "{{ route('kajian.print.pdf') }}") ;
            $('#printForm').submit() ;
        }
    </script>
@endsection
