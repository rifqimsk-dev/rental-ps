<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Zone;
use App\Models\Playstation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\InvoiceHelper;
use App\Models\Food;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Home';
        $playstation = Playstation::select('id','type','hourly_rate')->get();
        $zone = Zone::select('id','name','status')->get();
        $food = Food::select('id','name','stock','price')->get();
        $no_inv = InvoiceHelper::generate();
        $transactions = Transaction::select('id','customer_name','playstation_id','zone_id','total_hours','start_time','end_time_estimated','total_price','status')
                                  ->with(['playstation','zone'])
                                  ->where('status','running')
                                  ->orderBy('id', 'desc')
                                  ->get()
                                  ->map(function($transaction) {
                                    $transaction->end_time = Carbon::parse($transaction->start_time)
                                                                    ->addHours($transaction->total_hours)
                                                                    ->toDateTimeString();
                                    return $transaction;
                                  });

        return view('home.index', compact('title','playstation','zone','no_inv','transactions','food'));
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
