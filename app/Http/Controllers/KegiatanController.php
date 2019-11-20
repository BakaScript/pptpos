<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use PDF ;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = Kegiatan::latest()->paginate(10) ;
        return view('kegiatan.index', compact('kegiatan')) ;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kegiatan.create') ;
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
            'nama_kegiatan' => 'required',
            'deadline' => 'required',
            'status' => 'required',
        ]) ;

        Kegiatan::create([
            'nama_kegiatan' => $request['nama_kegiatan'],
            'estimasi_biaya' => $request['estimasi_biaya'],
            'deadline' => $request['deadline'],
            'status' => $request['status'],
            'tanggal_dilaksanakan' => $request['tanggal']
        ]) ;

        return redirect()->route('kegiatan.index') ;
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kegiatan = Kegiatan::find($id) ;

        return view('kegiatan.edit', compact('kegiatan')) ;
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
            'nama_kegiatan' => 'required',
            'deadline' => 'required',
            'status' => 'required',
        ]) ;

        $kegiatan = Kegiatan::find($id) ;

        $kegiatan->update([
            'nama_kegiatan' => $request['nama_kegiatan'],
            'estimasi_biaya' => $request['estimasi_biaya'],
            'deadline' => $request['deadline'],
            'status' => $request['status'],
            'tanggal_dilaksanakan' => $request['tanggal']
        ]) ;

        return redirect()->route('kegiatan.index') ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kegiatan = Kegiatan::find($id) ;

        if($kegiatan->delete()) {
            $response['message'] = 'data telah dihapus!' ;
        } else {
            $response['message'] = 'data gagal dihapus!' ;
        }

        return json_encode($response) ;
    }

    public function print() 
    {
        return view('kegiatan.print') ;
    }

    public function pdf(Request $request)
    {
        $this->validate($request, [
            'tanggal_dari' => 'required',
            'tanggal_sampai' => 'required',
            'status' => 'required'
        ]) ;

        $tgl_dari = strtotime($request['tanggal_dari']) ;
        $tgl_sampai = strtotime($request['tanggal_sampai']) ;

        if( $tgl_dari > $tgl_sampai ) {
            return redirect()->back()->withErrors(['error' => '<Dari tanggal> tidak boleh lebih dari <Sampai tanggal>']) ;
        }    

        $tgl_dari = $request['tanggal_dari'] ;
        $tgl_sampai = $request['tanggal_sampai'] ;

        if( $request['status'] == 'semua') {
            $kegiatan = Kegiatan::whereBetween('deadline',[
                $request['tanggal_dari'], 
                $request['tanggal_sampai']
            ])->orderBy('deadline', 'asc')->get() ;
        }  else {
            $kegiatan = Kegiatan::whereBetween('deadline',[
                $request['tanggal_dari'], 
                $request['tanggal_sampai']
            ])->where('status', $request['status'])->orderBy('deadline', 'asc')->get() ;
        }
        
        $status = $request['status'] ;
        

        $pdf = PDF::loadview('kegiatan.pdf', compact('kegiatan', 'status' , 'tgl_dari', 'tgl_sampai')) ;

        if( $request['mode'] == 'stream' ) {
            return $pdf->stream() ;
        } else {
            $tgl_dari = str_replace('-', '_', $tgl_dari) ;
            $tgl_sampai = str_replace('-', '_', $tgl_sampai) ;
            return $pdf->download('ppt_laporan_kajian_' . $tgl_dari . '_sampai_' . $tgl_sampai . '.pdf') ;
        }


    }
}
