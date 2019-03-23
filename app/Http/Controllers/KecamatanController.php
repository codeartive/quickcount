<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kecamatan;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kecamatan_list' => Kecamatan::all(),
        ];
        return view('master-data.kecamatan',$data);
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
        $kecamatan = new Kecamatan;
        $kecamatan->name = $request->name;
        $kecamatan->save();

        return redirect()->route('view.kecamatan')->with('message',[
            'title' => "Success!",
            'text' => "Data kecamatan berhasil ditambahkan!",
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
        return Kecamatan::findOrfail($id);
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
        $kecamatan = Kecamatan::findOrfail($id);
        $kecamatan->name = $request->name;
        $kecamatan->save();

        return redirect()->route('view.kecamatan')->with('message',[
            'title' => "Success!",
            'text' => "Data kecamatan berhasil diubah!",
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
        $kecamatan = Kecamatan::findOrfail($id)->delete();

        return redirect()->route('view.kecamatan')->with('message',[
            'title' => "Success!",
            'text' => "Data kecamatan berhasil dihapus!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }
}
