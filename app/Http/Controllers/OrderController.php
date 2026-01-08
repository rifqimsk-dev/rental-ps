<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodTransaction;
use App\Models\Zone;
use App\Models\Playstation;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Data Orderan';
        $playstation = Playstation::select('id','type','hourly_rate')->get();
        $zone = Zone::select('id','name','status')->get();
        $food = Food::select('id','name','stock','price')->get();
        $transaction = Transaction::select('id','customer_name','playstation_id','hourly_rate','total_hours','total_price','status','created_at')
                                  ->with('playstation')
                                  ->whereIn('status',['running','finished'])
                                  ->orderBy('id', 'desc')
                                  ->get();
        $food_transaction = FoodTransaction::with('details')->orderBy('created_at', 'desc')->get();
        return view('order.index', compact('title','transaction','playstation','zone','food','food_transaction'));
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
