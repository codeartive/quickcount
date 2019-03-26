<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TPS;
use App\CalonLegislatif;
use App\Voting;
use App\VotingDetail;

class VotingController extends Controller
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
            'caleg_list' => CalonLegislatif::all(),
        ];
        return view('master-data.voting',$data);
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
        $voting = new Voting;
        $voting->tps_id = $request->tps;
        if(isset($request->photo)){
            $uploadedFile = $request->file('photo')->store('public/files/voting');
            $getFileName=explode('/',$uploadedFile);
            $voting->photo = $getFileName[3];
        }
        $voting->save();

        foreach ($request->hasil as $key => $value) {
            $voting_detail = new VotingDetail;
            $voting_detail->voting_id = $voting->id;
            $voting_detail->calon_legislatif_id = $key;
            $voting_detail->value = $value;
            $voting_detail->save();
        }

        return redirect()->route('view.voting')->with('message',[
            'title' => "Success!",
            'text' => "Data voting berhasil ditambahkan!",
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
        // $data = TPS::findOrfail($id);
        // $result['tps'] = $data;
        // $result['rw'] = $data->rukun_warga->pluck('id');
        // $result['kelurahan'] = $data->getRukunWarga()->kelurahan;
        // $result['kecamatan'] = $data->getRukunWarga()->kelurahan->kecamatan;
        // return $result;
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
        // $tps = TPS::findOrfail($id);

        // $tps->rukun_warga_id = $request->kelurahan;
        // $tps->name = $request->name;
        // $tps->address = $request->address;
        // $tps->save();

        // $delete_coverage = TPSCoverage::where('tps_id',$tps->id)->forceDelete();

        // foreach ($request->rw as $value) {
        //     $tps_coverage = new TPSCoverage;
        //     $tps_coverage->tps_id = $tps->id;
        //     $tps_coverage->rukun_warga_id = $value;
        //     $tps_coverage->save();
        // }

        // return redirect()->route('view.voting')->with('message',[
        //     'title' => "Success!",
        //     'text' => "Data voting berhasil diubah!",
        //     'icon' => "success",
        //     'button' => "OK",
        // ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $tps = TPS::findOrfail($id);
        // $delete_coverage = TPSCoverage::where('tps_id',$tps->id)->forceDelete();
        // $delete_voting_detail = $tps->voting_detail()->delete();
        // $delete_voting = $tps->voting()->delete();
        // $tps->delete();

        // return redirect()->route('view.voting')->with('message',[
        //     'title' => "Success!",
        //     'text' => "Data voting berhasil dihapus!",
        //     'icon' => "success",
        //     'button' => "OK",
        // ]);
    }
}
