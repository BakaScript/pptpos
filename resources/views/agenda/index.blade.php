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
    <li class="breadcrumb-item active">Agenda</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="fade-in">

            <h2>Data Agenda</h2>

            <div class="card">
                <div class="card-header">
                    <a href="{{ route('agenda.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle"></i> <span class="ml-1">Tambah Data</span>
                    </a>
                    <a href="{{ route('agenda.print') }}" class="btn btn-info ml-2">
                        <i class="fa fa-print"></i> <span class="ml-1">Laporan</span>
                    </a>
                </div>

                <div class="card-body">
                    <table class="table table-bordered table-responsive-sm mt-2" id="mytable">
                        <thead class="bg-dark">
                            <tr>
                                <th width=10>No</th>
                                <th>Tempat</th>
                                <th>Tema</th>
                                <th>Ustadz</th>
                                <th>Jumlah Jamaah</th>
                                <th>Tanggal Kajian</th>
                                <th width=50><i class="fa fa-code"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agendas as $no => $k)
                                <tr>
                                    <td class="text-center">{{ ++$no }}</td>
                                    <td>{{ $k->tempat }}</td>
                                    <td>{{ $k->tema }}</td>
                                    <td>{{ $k->ustadz }}</td>
                                    <td>{{ $k->jumlah_jamaah }}</td>
                                    <td>{{ tanggal_indonesia($k->tanggal_agenda, false) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('agenda.edit', $k->id) }}" class="btn btn-success btn-sm">
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
                        "url" : 'agenda/' + id,
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

                        $( "#mytable" ).load( "{{ route('agenda.index') }} #mytable" )

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