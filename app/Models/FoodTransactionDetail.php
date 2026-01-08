<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTransactionDetail extends Model
{
    use HasFactory;

    protected $table = 'food_transaction_details';
    protected $fillable = ['food_transaction_id','food_name','price','qty'];

    public function transaction()
    {
        return $this->belongsTo(FoodTransaction::class, 'food_transaction_id');
    }
}
