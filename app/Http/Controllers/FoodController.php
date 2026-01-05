<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Makanan & Minuman';
        $result = Food::select('id','name','stock','price')->get();
        return view('food.index', compact('title','result'));
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
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        Food::create($request->all());

        return redirect()->route('food.index')->with(
            'alert', 
            'Data berhasil simpan'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = 'Ubah / Hapus Data';
        $row = Food::findOrFail(decrypt($id));
        return view('food.edit', compact('title','row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $result = Food::findOrFail(decrypt($id));
        $validate = $request->validate([
            'name' => 'required',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
        ]);

        $result->update($validate);

        return redirect()->route('food.index')->with(
            'alert', 
            'Data berhasil diperbarui'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = Food::findOrFail(decrypt($id));
        $result->delete();

        return redirect()->route('food.index')->with(
            'alert', 
            'Data berhasil dihapus'
        );
    }
}
