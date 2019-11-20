<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('assets/favicon/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png')}}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest')}}">
    <link rel="mask-icon" href="{{ asset('assets/favicon/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <style>
        body {
            font-family: 'Raleway', sans-serif;
        }
        h1, h2, h3, p {
            color : rgba(0, 0, 0, 0.7) ;
            line-height: 27px ;
        }

        .border-bottom-1 {
            border-bottom: 2px solid rgba(0, 0, 0, 0.7) ;
            margin-top: 13px ;
        }

        .border-bottom-3 {
            border-bottom: 6px solid rgba(0, 0, 0, 0.7) ;
        }

        .body {
            margin-top : 10px ;
        }

        .table {
            border-color: red !important ;
        }

        thead, tbody , tr, th, td {
            border-color : rgba(0, 0, 0, 0.4) !important;
        }

        .ml--3 {
            margin-left : -3em ;
        }

    </style>
  </head>
  <body>

    <div class="wrapper mt-3">
            <div class="header">
                    <div class="float-left text-center" style="max-width:500px;margin-left:50px;padding-top:40px">
                        <h1>Para Pejuang Tauhid</h1>
                        <p>Laporan Kajian Per tanggal <b>{{ tanggal_indonesia($tgl_dari, false) }}</b> sampai <b>{{ tanggal_indonesia($tgl_sampai, false) }}</b></p>
                    </div>
                    <div class="float-right">
                        <img src="{{ asset('assets/img/ppt_header_hitam.png') }}" alt="">           
                    </div>
                    <div style="clear:both"></div>
            </div>

                <div class="border-bottom-3"></div>
            
                <br>
            <div class="body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tempat</th>
                                    <th>Tema</th>
                                    <th>Ustadz</th>
                                    <th>Jumlah Jamaah</th>
                                    <th>Tanggal Kajian</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kajian as $no => $k)
                                    <tr>
                                        <td>{{ ++$no }}</td>
                                        <td>{{ $k->tempat }}</td>
                                        <td>{{ $k->tema }}</td>
                                        <td>{{ $k->ustadz }}</td>
                                        <td>{{ tanggal_indonesia($uang->tanggal_kajian) }}</td>
                                        <td>{{ $k->jumlah_jamaah }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="5"><b>Total</b></td>
                                    <td><b>{{ $kajian->sum('jumlah_jamaah')}}</b></td>
                                </tr>
                            </tbody>
                        </table>
                
            </div>

            <div class="footer">
                <p>Di print oleh <b>{{ Auth::user()->name }}</b> pada <b>{{ tanggal_indonesia(date('Y-m-d')) }}</b></p>
            </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>