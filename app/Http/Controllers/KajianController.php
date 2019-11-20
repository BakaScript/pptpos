<?php

namespace App\Http\Controllers;

use App\Models\Kajian;
use Illuminate\Http\Request;
use PDF ;

class KajianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kajian = Kajian::latest()->paginate(10) ;

        return view('kajian.index', compact('kajian')) ;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kajian.create') ;
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
            'tempat' => 'required',
            'tema' => 'required',
            'ustadz' => 'required',
            'tanggal' => 'required',
            'jamaah' => 'required|integer'
        ]) ;
        
        Kajian::create([
            'tempat' => $request['tempat'],
            'tema' => $request['tema'],
            'ustadz' => $request['ustadz'],
            'jumlah_jamaah' => $request['jamaah'],
            'tanggal_kajian' => $request['tanggal']
        ]) ;

        return redirect()->route('kajian.index') ;
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kajian = Kajian::find($id) ;

        return view('kajian.edit', compact('kajian')) ;
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
        $kajian = Kajian::find($id) ;

        $this->validate($request, [
            'tempat' => 'required',
            'tema' => 'required',
            'ustadz' => 'required',
            'tanggal' => 'required',
            'jamaah' => 'required|integer'
        ]) ;
        
        Kajian::create([
            'tempat' => $request['tempat'],
            'tema' => $request['tema'],
            'ustadz' => $request['ustadz'],
            'jumlah_jamaah' => $request['jamaah'],
            'tanggal_kajian' => $request['tanggal']
        ]) ;

        return redirect()->route('kajian.index') ;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kajian = Kajian::find($id) ;

        if($kajian->delete()) {
            $response['message'] = 'data telah dihapus!' ;
        } else {
            $response['message'] = 'data gagal dihapus!' ;
        }

        return json_encode($response) ;
    }

    public function print() 
    {
        return view('kajian.print') ;
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

        $kajian = Kajian::whereBetween('tanggal_kajian',[
            $request['tanggal_dari'], 
            $request['tanggal_sampai']
        ])->orderBy('tanggal_kajian', 'asc')->get() ;

        $pdf = PDF::loadview('kajian.pdf', compact('kajian', 'tgl_dari', 'tgl_sampai')) ;

        if( $request['mode'] == 'stream' ) {
            return $pdf->stream() ;
        } else {
            $tgl_dari = str_replace('-', '_', $tgl_dari) ;
            $tgl_sampai = str_replace('-', '_', $tgl_sampai) ;
            return $pdf->download('ppt_laporan_kajian_' . $tgl_dari . '_sampai_' . $tgl_sampai . '.pdf') ;
        }


    }
}
