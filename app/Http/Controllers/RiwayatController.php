<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Zone;
use App\Models\Playstation;
use App\Models\Transaction;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $title = 'Riwayat Orderan';
        $playstation = Playstation::select('id','type','hourly_rate')->get();
        $zone = Zone::select('id','name','status')->get();
        $food = Food::select('id','name','stock','price')->get();
        $transaction = Transaction::select('id','customer_name','playstation_id','zone_id','hourly_rate','total_hours','total_price','status','created_at')
                                  ->with(['playstation','zone'])
                                  ->whereIn('status',['cancelled','finished'])
                                  ->orderBy('id', 'desc')
                                  ->get();
        return view('riwayat.index', compact('title','transaction','playstation','zone','food'));
    }
}
