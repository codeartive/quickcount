<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Partai;
use App\CalonLegislatif;
use App\Voting;
use App\VotingDetail;

class PartaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'partai_list' => Partai::all(),
        ];
        return view('master-data.partai',$data);
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
        $partai = new Partai;
        $partai->name = $request->name;
        $partai->save();

        return redirect()->route('view.partai')->with('message',[
            'title' => "Success!",
            'text' => "Data partai berhasil ditambahkan!",
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
        return Partai::findOrfail($id);
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
        $partai = Partai::findOrfail($id);
        $partai->name = $request->name;
        $partai->save();

        return redirect()->route('view.partai')->with('message',[
            'title' => "Success!",
            'text' => "Data partai berhasil diubah!",
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
        $partai = Partai::findOrfail($id);
        $calon_legislatif = CalonLegislatif::where('partai_id',$id)->get();
        foreach ($calon_legislatif as $caleg) {
            $voting_id = VotingDetail::where('calon_legislatif_id',$caleg->id)->get()->pluck('voting_id');
            $delete_voting_detail = $caleg->voting_detail()->delete();
            $delete_voting = Voting::whereIn('id',$voting_id)->delete();
        }
        
        $delete_caleg = $partai->calon_legislatif()->delete();
        $partai->delete();

        return redirect()->route('view.partai')->with('message',[
            'title' => "Success!",
            'text' => "Data partai berhasil dihapus!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }
}
