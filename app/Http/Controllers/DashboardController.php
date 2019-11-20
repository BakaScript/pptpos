<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;

use App\Models\UangMasuk ;
use App\Models\UangKeluar ;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $date_now = Carbon::now() ;

        // Main Chart
        $main = Kajian::latest()->limit(7)->get() ;

        $main_chart['tanggal'] = [] ;
        $main_chart['jamaah'] = [] ;
        $main_chart['count'] = 0 ;

        foreach($main as $m) {
            $main_chart['tanggal'][] = tanggal_indonesia($m->tanggal_kajian, false) ;
            $main_chart['jamaah'][] = $m->jumlah_jamaah ;
        }

        $main_chart['count'] = $main->count() ;


        $uangmasuk['count'] = UangMasuk::get()->count() ;
        $uangkeluar['count'] = UangKeluar::get()->count() ;
        $jamaah['count'] = Kajian::get()->count() ;

        $jamaah_kemarin = 0 ;
        $jamaah_sekarang = 0 ;
        $uangmasuk_bulankemarin = 0 ;
        $uangmasuk_bulansekarang = 0 ;
        $uangkeluar_bulankemarin = 0 ;
        $uangkeluar_bulansekarang = 0 ;
        $uangmasuk['persen'] = 0 ;
        $uangkeluar['persen'] = 0 ;
        $jamaah['persen'] = 0 ;
        $uangmasuk['status'] = '' ;
        $uangkeluar['status'] = '' ;
        $jamaah['status'] = '' ;

        $otherPage = 'parapejuangtauhid';
        $response = file_get_contents("https://www.instagram.com/$otherPage/?__a=1");
        if ($response !== false) {
            $data = json_decode($response, true);
            if ($data !== null) {
                $instagram['bio'] = $data['graphql']['user']['biography'];
                $instagram['follows'] = $data['graphql']['user']['edge_follow']['count'];
                $instagram['followedBy'] = $data['graphql']['user']['edge_followed_by']['count'];
            }
        }

        $uangmasuk_bulankemarin = UangMasuk::whereMonth('tanggal_masuk', ($date_now->month -1 ))->sum('nominal') ;
        $uangmasuk_bulansekarang = UangMasuk::whereMonth('tanggal_masuk', $date_now->month)->sum('nominal') ;
        $uangkeluar_bulankemarin = UangKeluar::whereMonth('tanggal_keluar', ($date_now->month - 1))->sum('nominal') ;
        $uangkeluar_bulansekarang = UangKeluar::whereMonth('tanggal_keluar', $date_now->month)->sum('nominal') ;
        


        if($jamaah['count'] != 0 ) {
            $jamaah_sekarang = Kajian::orderBy('tanggal_kajian', 'desc')->first()  ;

            if( $jamaah_sekarang->id > 0 ) {
                $jamaah_kemarin = Kajian::orderBy('tanggal_kajian', 'desc')->skip(1)->take(1)->first()->jumlah_jamaah ;
            }
    
            $jamaah_sekarang = $jamaah_sekarang->jumlah_jamaah ;

            if( $jamaah_kemarin < $jamaah_sekarang ) {
                $jamaah['persen'] = round($jamaah_sekarang * 100 / ( $jamaah_kemarin == 0 ? $jamaah_sekarang : $jamaah_kemarin)) ; 
                $jamaah['status'] = '<i class="fa fa-angle-double-up text-success"></i>' ;
            } else {
                $jamaah['persen'] = round(100 - (($jamaah_sekarang * 100) / ( $jamaah_kemarin == 0 ? $jamaah_sekarang : $jamaah_kemarin))) ; 
                $jamaah['status'] = '<i class="fa fa-angle-double-down text-danger"></i>' ;
                
            }
        }

       

        if($uangmasuk['count'] != 0) {
            if( $uangmasuk_bulankemarin < $uangmasuk_bulansekarang ) {
                $uangmasuk['persen'] = ( $uangmasuk_bulansekarang * 100 ) / ($uangmasuk_bulankemarin == 0 ?                        $uangmasuk_bulansekarang : $uangmasuk_bulankemarin) ;
                $uangmasuk['status'] = '<i class="fa fa-angle-double-up text-success"></i>' ;
            } else {
                $uangmasuk['persen'] = 100 - (( $uangmasuk_bulansekarang * 100 ) / ($uangmasuk_bulankemarin                        == 0 ?  $uangmasuk_bulansekarang : $uangmasuk_bulankemarin)) ;
                $uangmasuk['status'] = '<i class="fa fa-angle-double-down text-danger"></i>' ;
            }

            $uangmasuk['persen'] = round(floatval($uangmasuk['persen'])) ;

        }
       
        if($uangkeluar['count'] != 0) {
            if( $uangkeluar_bulankemarin < $uangkeluar_bulansekarang ) {
                $uangkeluar['persen'] = ( $uangkeluar_bulansekarang * 100 ) / ($uangkeluar_bulankemarin == 0 ?                        $uangkeluar_bulansekarang : $uangkeluar_bulankemarin) ;
                $uangkeluar['status'] = '<i class="fa fa-angle-double-up text-success"></i>' ;
            } else {
                $uangkeluar['persen'] = 100 - (( $uangkeluar_bulansekarang * 100 ) / ($uangkeluar_bulankemarin                        == 0 ?  $uangkeluar_bulansekarang : $uangkeluar_bulankemarin)) ;
                $uangkeluar['status'] = '<i class="fa fa-angle-double-down text-danger"></i>' ;
            }

            $uangkeluar['persen'] = round(floatval($uangkeluar['persen'])) ;

        }


        $uangmasuk['now'] = $uangmasuk_bulansekarang ;
        $uangkeluar['now'] = $uangkeluar_bulansekarang ;
        $jamaah['now'] = $jamaah_sekarang ;

      
        return view('admin.dashboard', compact('uangmasuk', 'uangkeluar', 'jamaah', 'instagram', 'main_chart')) ;
    }
}
