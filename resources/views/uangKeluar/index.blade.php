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
    <li class="breadcrumb-item active">Uang Keluar</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">

            <h2>Data Uang Keluar</h2>

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('uangkeluar.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> <span class="ml-1">Tambah Data</span>
                    </a>
                    <a href="{{ route('uangkeluar.print') }}" class="btn btn-info ml-2">
                        <i class="fa fa-print"></i> <span class="ml-1">Laporan</span>
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-responsive-sm mt-2" id="mytable">
                        <thead class="bg-dark">
                            <tr>
                                <th width=10>No</th>
                                <th>Nominal</th>
                                <th>Keterangan</th>
                                <th>Tanggal Keluar</th>
                                <th width=50><i class="fa fa-code"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($uangkeluar as $no => $uang)
                                <tr>
                                    <td class="text-center">{{ ++$no }}</td>
                                    <td>Rp. {{ format_uang($uang->nominal) }}</td>
                                    <td>{{ $uang->keterangan }}</td>
                                    <td>{{ tanggal_indonesia($uang->tanggal_keluar, false) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('uangkeluar.edit', $uang->id) }}" class="btn btn-success btn-sm">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            
                                            <a onclick="deleteData({{ $uang->id }})" class="btn btn-danger btn-sm text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $uangkeluar->links() }}
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
                        "url" : 'uangkeluar/' + id,
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

                        $( "#mytable" ).load( "{{ route('uangkeluar.index') }} #mytable" )

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