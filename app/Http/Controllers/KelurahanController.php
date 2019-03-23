<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kelurahan;

class KelurahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'kelurahan_list' => Kelurahan::all(),
        ];
        return view('master-data.kelurahan',$data);
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
        $kelurahan = new Kelurahan;
        $kelurahan->name = $request->name;
        $kelurahan->save();

        return redirect()->route('view.kelurahan')->with('message',[
            'title' => "Success!",
            'text' => "Data kelurahan berhasil ditambahkan!",
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
        return Kelurahan::findOrfail($id);
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
        $kelurahan = Kelurahan::findOrfail($id);
        $kelurahan->name = $request->name;
        $kelurahan->save();

        return redirect()->route('view.kelurahan')->with('message',[
            'title' => "Success!",
            'text' => "Data kelurahan berhasil diubah!",
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
        $kelurahan = Kelurahan::findOrfail($id)->delete();

        return redirect()->route('view.kelurahan')->with('message',[
            'title' => "Success!",
            'text' => "Data kelurahan berhasil dihapus!",
            'icon' => "success",
            'button' => "OK",
        ]);
    }
}
