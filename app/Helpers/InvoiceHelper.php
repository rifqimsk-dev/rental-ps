<?php

namespace App\Helpers;

use App\Models\Transaction;
use Carbon\Carbon;

class InvoiceHelper
{
    public static function generate()
    {
        $date = Carbon::now()->format('dmY');

        $lastInvoice = Transaction::whereDate('created_at', Carbon::today())
            ->orderBy('id', 'desc')
            ->first();

        if ($lastInvoice) {
            $lastNumber = (int) substr($lastInvoice->invoice_number, -5);
            $number = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $number = '00001';
        }

        return "INV/PS/{$date}/{$number}";
    }
}
