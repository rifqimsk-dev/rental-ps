<?php

namespace App\Http\Controllers;

use App\Models\Playstation;
use Illuminate\Http\Request;

class PlaystationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Playstation';
        $result = Playstation::select('id','code','type','status','hourly_rate')->get();
        return view('playstation.index', compact('title','result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:playstations,code',
            'type' => 'required',
            'serial_number' => 'nullable',
            'hourly_rate' => 'required|numeric',
            'notes' => 'nullable',
        ]);

        Playstation::create($request->all());

        return redirect()->route('playstation.index')->with(
            'alert', 
            'Data berhasil simpan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $title = 'Ubah / Hapus Data';
        $row = Playstation::findOrFail(decrypt($id));
        return view('playstation.edit', compact('title','row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = Playstation::findOrFail(decrypt($id));
        $validate = $request->validate([
            'code' => 'required|max:4|unique:playstations,code,'. $result->id,
            'type' => 'required|max:3',
            'serial_number' => 'nullable',
            'hourly_rate' => 'required|numeric',
            'notes' => 'nullable',
        ]);

        $result->update($validate);

        return redirect()->route('playstation.index')->with(
            'alert', 
            'Data berhasil diperbarui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Playstation::findOrFail(decrypt($id));
        $result->delete();

        return redirect()->route('playstation.index')->with(
            'alert', 
            'Data berhasil dihapus'
        );
    }
}
