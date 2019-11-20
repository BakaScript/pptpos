@extends('layouts.templates')

@section('styles')
    <style>
    .btn:hover {
        cursor: pointer;
    }
    </style>
@endsection

@section('breadcrumbs')
    @parent
    <li class="breadcrumb-item active">Kegiatan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">

            <h2>Data Kajian</h2>

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('kegiatan.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> <span class="ml-1">Tambah Data</span>
                    </a>
                    <a href="{{ route('kegiatan.print') }}" class="btn btn-info ml-2">
                        <i class="fa fa-print"></i> <span class="ml-1">Laporan</span>
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-responsive-sm mt-2" id="mytable">
                        <thead class="bg-dark">
                            <tr>
                                <th width=10>No</th>
                                <th>Nama Kegiatan</th>
                                <th>Estimasi Biaya</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Tanggal Dilaksanakan</th>
                                <th width=50><i class="fa fa-code"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kegiatan as $no => $k)
                                <tr>
                                    <td class="text-center">{{ ++$no }}</td>
                                    <td>{{ $k->nama_kegiatan }}</td>
                                    <td>Rp. {{ format_uang($k->estimasi_biaya) }}</td>
                                    <td>{{ tanggal_indonesia($k->deadline, false) }}</td>
                                    <td class="@if($k->status == 'rencana') text-danger @else text-success @endif">{{ $k->status }}
                                        @if ($k->status == 'rencana')
                                            <i class="fa fa-history"></i>
                                        @else
                                            <i class="fa fa-check"></i>
                                        @endif
                                    </td>
                                    <td>@if($k->tanggal_dilaksanakan){{ tanggal_indonesia($k->tanggal_dilaksanakan, false) }}@endif</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('kegiatan.edit', $k->id) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            
                                            <a onclick="deleteData({{ $k->id }})" class="btn btn-danger btn-sm text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $kegiatan->links() }}
                </div>
            </div>
         
                    

            
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        var table ;
        
        function deleteData(id) {
            Swal.fire({
                title : 'Apa anda yakin?',
                text  : 'data akan dihapus secara permanen!',
                icon : 'question',
                showCancelButton : true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText : 'Ya, Hapus data!',
                cancelButtonText : 'Batal',
                showLoaderOnConfirm: true,
                preConfirm : function() {
                return new Promise(function(resolve) {
                    $.ajax({
                        "url" : 'kegiatan/' + id,
                        "type" : "POST",
                        "data" : {
                            "_method" : "DELETE", 
                            "_token" : $('meta[name=csrf-token]').attr('content')
                        },
                        "dataType" : "JSON"
                    })

                    .done(function(response) {
                        Swal.fire({
                            title : 'Dihapus!', 
                            text : response.message,
                            icon : 'success'
                        }) ;

                        $( "#mytable" ).load( "{{ route('kegiatan.index') }} #mytable" )

                    })

                    .fail(function() {
                        Swal.fire('Oops...', 'Something went wrong with ajax!', 'error') ;
                    }) 
                }) ;
            },

            allowOutsideClick : false 
            })
        }
    </script>
@endsection