<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Playstation;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\InvoiceHelper;
use App\Models\FoodTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\FoodTransactionDetail;

class TransactionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'playstation_id' => 'required|numeric',
            'zone_id' => 'required|numeric',
            'start_time' => 'required|date_format:H:i',
            'total_hours' => 'required|numeric|min:0.5',
        ]);

        $get_playstation = Playstation::select('id','hourly_rate')
                                      ->findOrFail($request->playstation_id);

        $get_hourly_rate = $get_playstation->hourly_rate;
        $today = Carbon::today();
        $startTime = Carbon::createFromFormat(
            'Y-m-d H:i',
            $today->format('Y-m-d').' '.$request->start_time
        );
        $endTimeEstimated = $startTime->copy()
                                      ->addMinutes($request->total_hours * 60);

        $totalPrice = $request->total_hours * $get_hourly_rate;

        Transaction::create([
            'invoice_number'        => InvoiceHelper::generate(),
            'customer_name'         => $request->customer_name,
            'playstation_id'        => $request->playstation_id,
            'zone_id'               => $request->zone_id,
            'user_id'               => 1,
            'start_time'            => $startTime,
            'end_time_estimated'    => $endTimeEstimated,
            'hourly_rate'           => $get_hourly_rate,
            'total_hours'           => $request->total_hours,
            'total_price'           => $totalPrice,
        ]);

        return redirect('/')->with(
            'alert', 
            'Data berhasil simpan'
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required|exists:transactions,id',
            'additional_hours' => 'required|numeric|min:0.5',
        ]);

        $transaction = Transaction::findOrFail($request->transaction_id);

        $transaction->total_hours += $request->additional_hours;
        $transaction->end_time_estimated = Carbon::parse(
            $transaction->end_time_estimated
        )->addHours($request->additional_hours);
        $transaction->total_price = $transaction->total_hours * $transaction->hourly_rate;

        $transaction->save();

        return redirect('/')->with(
            'alert',
            'Berhasil menambahkan jam main'
        );
    }

    public function finished($id)
    {
        $transactionId = decrypt($id);

        $transaction = Transaction::findOrFail($transactionId);

        $transaction->status = 'finished';
        $transaction->end_time_actual = Carbon::now();

        $transaction->save();

        return redirect('/')->with(
            'alert',
            'Selesai bermain'
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function cancelled($id)
    {
        $transactionId = decrypt($id);

        $transaction = Transaction::findOrFail($transactionId);

        $transaction->status = 'cancelled';
        $transaction->end_time_actual = Carbon::now();

        $transaction->save();

        return redirect('/')->with(
            'alert',
            'Berhasil dibatalkan'
        );
    }

    public function food(Request $request)
    {
        $items = json_decode($request->items, true);

        if (!$items || !is_array($items)) {
            return back()->with('failed', 'Data order tidak valid');
        }

        DB::transaction(function () use ($items) {

            // 1️⃣ HITUNG TOTAL
            $total = 0;
            foreach ($items as $item) {
                $total += $item['price'] * $item['qty'];
            }

            // 2️⃣ INSERT KE TRANSAKSI (PARENT)
            $transaction = FoodTransaction::create([
                'user_id' => 1,
                'total_price'   => $total,
            ]);

            // 3️⃣ INSERT KE DETAIL (CHILD)
            foreach ($items as $item) {
                FoodTransactionDetail::create([
                    'food_transaction_id' => $transaction->id,
                    'food_name' => $item['name'],
                    'price'     => $item['price'],
                    'qty'       => $item['qty'],
                ]);
            }

        });

        return redirect()
            ->back()
            ->with('alert', 'Order berhasil disimpan');
    }
}
