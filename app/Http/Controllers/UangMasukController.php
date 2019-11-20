<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UangMasuk ;
use PDF ;

class UangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $uangmasuk = UangMasuk::latest()->paginate(10);

        return view('uangMasuk.index', compact('uangmasuk')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('uangMasuk.create') ;
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
            'sumber' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required'
        ]) ;
        
        UangMasuk::create([
            'sumber' => $request['sumber'],
            'nominal' => $request['nominal'],
            'tanggal_masuk' => $request['tanggal']
        ]) ;

        return redirect()->route('uangmasuk.index') ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $uangmasuk = UangMasuk::find($id) ;

        return view('uangMasuk.edit', compact('uangmasuk')) ;
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
            'sumber' => 'required',
            'nominal' => 'required',
            'tanggal' => 'required'
        ]) ;

        $uangmasuk = UangMasuk::find($id) ;

        $uangmasuk->update([
            'sumber' => $request['sumber'],
            'nominal' => $request['nominal'],
            'tanggal_masuk' => $request['tanggal']
        ]) ;

        return redirect()->route('uangmasuk.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $uangmasuk = UangMasuk::find($id) ;

        if($uangmasuk->delete()) {
            $response['message'] = 'data telah dihapus!' ;
        } else {
            $response['message'] = 'data gagal dihapus!' ;
        }

        return json_encode($response) ;
    }

    public function print() 
    {
        return view('uangmasuk.print') ;
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

        $uangmasuk = UangMasuk::whereBetween('tanggal_masuk',[
            $request['tanggal_dari'], 
            $request['tanggal_sampai']
        ])->orderBy('tanggal_masuk', 'asc')->get() ;

        $pdf = PDF::loadview('uangMasuk.pdf', compact('uangmasuk', 'tgl_dari', 'tgl_sampai')) ;

        if( $request['mode'] == 'stream' ) {
            return $pdf->stream() ;
        } else {
            $tgl_dari = str_replace('-', '_', $tgl_dari) ;
            $tgl_sampai = str_replace('-', '_', $tgl_sampai) ;
            return $pdf->download('ppt_laporan_uangmasuk_' . $tgl_dari . '_sampai_' . $tgl_sampai . '.pdf') ;
        }


    }
}
