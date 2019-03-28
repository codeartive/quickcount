<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TPS;
use App\TPSCoverage;

class TPSController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'tps_list' => TPS::all(),
        ];
        return view('master-data.tps',$data);
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
        $tps = new TPS;
        // $tps->rukun_warga_id = $request->rw;
        $tps->name = $request->name;
        $tps->address = $request->address;
        $tps->saksi = $request->saksi;
        $tps->save();

        foreach ($request->rw as $value) {
            $tps_coverage = new TPSCoverage;
            $tps_coverage->tps_id = $tps->id;
            $tps_coverage->rukun_warga_id = $value;
            $tps_coverage->save();
        }

        // $num = $request->jumlah_rw;
        // $numlength = strlen((string)$num);

        // for($i=1;$i<=$num;$i++){
        //     $rukun_warga = new RukunWarga;
        //     $rukun_warga->kelurahan_id = $kelurahan->id;
        //     $rukun_warga->name = str_pad($i, $numlength, '0', STR_PAD_LEFT);
        //     $rukun_warga->save();
        // }

        return redirect()->route('view.tps')->with('message',[
            'title' => "Success!",
            'text' => "Data tps berhasil ditambahkan!",
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
        $data = TPS::findOrfail($id);
        $result['tps'] = $data;
        $result['rw'] = $data->rukun_warga->pluck('id');
        $result['kelurahan'] = $data->getRukunWarga()->kelurahan;
        $result['kecamatan'] = $data->getRukunWarga()->kelurahan->kecamatan;
        return $result;
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
        $tps = TPS::findOrfail($id);

        // $tps->rukun_warga_id = $request->kelurahan;
        $tps->name = $request->name;
        $tps->address = $request->address;
        $tps->saksi = $request->saksi;
        $tps->save();

        $delete_coverage = TPSCoverage::where('tps_id',$tps->id)->forceDelete();

        foreach ($request->rw as $value) {
            $tps_coverage = new TPSCoverage;
            $tps_coverage->tps_id = $tps->id;
            $tps_coverage->rukun_warga_id = $value;
            $tps_coverage->save();
        }

        // $delete_rw = $kelurahan->rukun_warga()->forceDelete();

        // $num = $request->jumlah_rw;
        // $numlength = strlen((string)$num);

        // for($i=1;$i<=$num;$i++){
        //     $rukun_warga = new RukunWarga;
        //     $rukun_warga->kelurahan_id = $kelurahan->id;
        //     $rukun_warga->name = str_pad($i, $numlength, '0', STR_PAD_LEFT);
        //     $rukun_warga->save();
        // }

        return redirect()->route('view.tps')->with('message',[
            'title' => "Success!",
            'text' => "Data tps berhasil diubah!",
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
        $tps = TPS::findOrfail($id);
        $delete_coverage = TPSCoverage::where('tps_id',$tps->id)->forceDelete();
        $delete_voting_detail = $tps->voting_detail()->delete();
        $delete_voting = $tps->voting()->delete();
        $tps->delete();

        return redirect()->route('view.tps')->with('message',[
            'title' => "Success!",
            'text' => "Data tps berhasil dihapus!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }
}
