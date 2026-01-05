<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_name',
        'playstation_id',
        'zone_id',
        'user_id',
        'start_time',
        'end_time_estimated',
        'end_time_actual',
        'hourly_rate',
        'total_hours',
        'additional_hours',
        'total_price',
        'status'
    ];

    public function playstation()
    {
        return $this->belongsTo(Playstation::class);
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
}
