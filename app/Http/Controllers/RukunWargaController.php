<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Kelurahan;
use App\RukunWarga;

class RukunWargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'rw_list' => RukunWarga::all(),
        ];
        return view('master-data.rukun-warga',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rukun_warga = new RukunWarga;
        $rukun_warga->kelurahan_id = $request->kelurahan;
        $rukun_warga->name = $request->name;
        $rukun_warga->save();

        // $num = $request->jumlah_rw;
        // $numlength = strlen((string)$num);

        // for($i=1;$i<=$num;$i++){
        //     $rukun_warga = new RukunWarga;
        //     $rukun_warga->kelurahan_id = $kelurahan->id;
        //     $rukun_warga->name = str_pad($i, $numlength, '0', STR_PAD_LEFT);
        //     $rukun_warga->save();
        // }

        return redirect()->route('view.rw')->with('message',[
            'title' => "Success!",
            'text' => "Data rukun warga berhasil ditambahkan!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return RukunWarga::with('kelurahan.kecamatan')->findOrfail($id);
        // $data = Kelurahan::findOrfail($id);
        // $rw = RukunWarga::where('kelurahan_id',$data->id)->count();
        // return ['result' => $data,'jumlah_rw' => $rw];
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
        $rukun_warga = RukunWarga::findOrfail($id);

        $rukun_warga->kelurahan_id = $request->kelurahan;
        $rukun_warga->name = $request->name;
        $rukun_warga->save();

        // $delete_rw = $kelurahan->rukun_warga()->forceDelete();

        // $num = $request->jumlah_rw;
        // $numlength = strlen((string)$num);

        // for($i=1;$i<=$num;$i++){
        //     $rukun_warga = new RukunWarga;
        //     $rukun_warga->kelurahan_id = $kelurahan->id;
        //     $rukun_warga->name = str_pad($i, $numlength, '0', STR_PAD_LEFT);
        //     $rukun_warga->save();
        // }

        return redirect()->route('view.rw')->with('message',[
            'title' => "Success!",
            'text' => "Data rukun warga berhasil diubah!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rukun_warga = RukunWarga::findOrfail($id);
        $delete_rt = $rukun_warga->rukun_tetangga()->delete();
        $rukun_warga->delete();

        return redirect()->route('view.rw')->with('message',[
            'title' => "Success!",
            'text' => "Data rukun warga berhasil dihapus!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }
}
