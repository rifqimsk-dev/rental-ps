<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Zone';
        $result = Zone::select('id','name','capacity','status')->get();
        return view('zone.index', compact('title','result'));
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
            'name' => 'required',
            'capacity' => 'required',
            'status' => 'required',
        ]);

        Zone::create($request->all());

        return redirect()->route('zone.index')->with(
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
        $row = Zone::findOrFail(decrypt($id));
        return view('zone.edit', compact('title','row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $result = Zone::findOrFail(decrypt($id));
        $validate = $request->validate([
            'name' => 'required',
            'capacity' => 'required',
            'status' => 'required',
        ]);

        $result->update($validate);

        return redirect()->route('zone.index')->with(
            'alert', 
            'Data berhasil diperbarui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = Zone::findOrFail(decrypt($id));
        $result->delete();

        return redirect()->route('zone.index')->with(
            'alert', 
            'Data berhasil dihapus'
        );
    }
}
