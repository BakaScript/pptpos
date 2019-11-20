<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UangKeluar ;
use PDF ;

class UangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uangkeluar = UangKeluar::latest()->paginate(10) ;

        return view('uangKeluar.index', compact('uangkeluar')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uangKeluar.create') ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nominal' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required'
        ]) ;
        
        UangKeluar::create([
            'nominal' => $request['nominal'],
            'keterangan' => $request['keterangan'],
            'tanggal_keluar' => $request['tanggal']
        ]) ;

        return redirect()->route('uangkeluar.index') ;
    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uangkeluar = UangKeluar::find($id) ;

        return view('uangkeluar.edit', compact('uangkeluar')) ;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nominal' => 'required',
            'keterangan' => 'required',
            'tanggal' => 'required'
        ]) ;

        $uangkeluar = UangKeluar::find($id) ;

        $uangkeluar->update([
            'nominal' => $request['nominal'],
            'keterangan' => $request['keterangan'],
            'tanggal_keluar' => $request['tanggal']
        ]) ;

        return redirect()->route('uangkeluar.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uangkeluar = UangKeluar::find($id) ;

        if($uangkeluar->delete()) {
            $response['message'] = 'data telah dihapus!' ;
        } else {
            $response['message'] = 'data gagal dihapus!' ;
        }

        return json_encode($response) ;
    }

    public function print() 
    {
        return view('uangKeluar.print') ;
    }

    public function pdf(Request $request)
    {
        $this->validate($request, [
            'tanggal_dari' => 'required',
            'tanggal_sampai' => 'required'
        ]) ;

        $tgl_dari = strtotime($request['tanggal_dari']) ;
        $tgl_sampai = strtotime($request['tanggal_sampai']) ;

        if( $tgl_dari > $tgl_sampai ) {
            return redirect()->back()->withErrors(['error' => '<Dari tanggal> tidak boleh lebih dari <Sampai tanggal>']) ;
        }    

        $tgl_dari = $request['tanggal_dari'] ;
        $tgl_sampai = $request['tanggal_sampai'] ;

        $uangkeluar = UangKeluar::whereBetween('tanggal_keluar',[
            $request['tanggal_dari'], 
            $request['tanggal_sampai']
        ])->orderBy('tanggal_keluar', 'asc')->get() ;

        $pdf = PDF::loadview('uangKeluar.pdf', compact('uangkeluar', 'tgl_dari', 'tgl_sampai')) ;

        if( $request['mode'] == 'stream' ) {
            return $pdf->stream() ;
        } else {
            $tgl_dari = str_replace('-', '_', $tgl_dari) ;
            $tgl_sampai = str_replace('-', '_', $tgl_sampai) ;
            return $pdf->download('ppt_laporan_uangkeluar_' . $tgl_dari . '_sampai_' . $tgl_sampai . '.pdf') ;
        }


    }
}
