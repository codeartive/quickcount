<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CalonLegislatif;
use App\Voting;
use App\VotingDetail;

class CalonLegislatifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'caleg_list' => CalonLegislatif::all(),
        ];
        return view('master-data.calon-legislatif',$data);
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
        $caleg = new CalonLegislatif;
        $caleg->partai_id = $request->partai;
        $caleg->name = $request->name;
        $caleg->save();

        // $num = $request->jumlah_rw;
        // $numlength = strlen((string)$num);

        // for($i=1;$i<=$num;$i++){
        //     $rukun_warga = new RukunWarga;
        //     $rukun_warga->kelurahan_id = $kelurahan->id;
        //     $rukun_warga->name = str_pad($i, $numlength, '0', STR_PAD_LEFT);
        //     $rukun_warga->save();
        // }

        return redirect()->route('view.calon-legislatif')->with('message',[
            'title' => "Success!",
            'text' => "Data calon legislatif berhasil ditambahkan!",
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
        return CalonLegislatif::findOrfail($id);
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
        $caleg = CalonLegislatif::findOrfail($id);

        $caleg->partai_id = $request->partai;
        $caleg->name = $request->name;
        $caleg->save();

        // $delete_rw = $kelurahan->rukun_warga()->forceDelete();

        // $num = $request->jumlah_rw;
        // $numlength = strlen((string)$num);

        // for($i=1;$i<=$num;$i++){
        //     $rukun_warga = new RukunWarga;
        //     $rukun_warga->kelurahan_id = $kelurahan->id;
        //     $rukun_warga->name = str_pad($i, $numlength, '0', STR_PAD_LEFT);
        //     $rukun_warga->save();
        // }

        return redirect()->route('view.calon-legislatif')->with('message',[
            'title' => "Success!",
            'text' => "Data calon legislatif berhasil diubah!",
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
        $caleg = CalonLegislatif::findOrfail($id);
        $voting_id = VotingDetail::where('calon_legislatif_id',$id)->get()->pluck('voting_id');
        $delete_voting_detail = $caleg->voting_detail()->delete();
        $delete_voting = Voting::whereIn('id',$voting_id)->delete();
        $caleg->delete();

        return redirect()->route('view.calon-legislatif')->with('message',[
            'title' => "Success!",
            'text' => "Data calon legislatif berhasil dihapus!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }
}
